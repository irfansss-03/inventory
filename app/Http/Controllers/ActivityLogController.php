<?php

namespace App\Http\Controllers;

use App\ActivityLogClearedNotification;
use App\AdminNotifier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::latest();

        // Filter by User
        if ($request->filled('user_id')) {
            $query->where('causer_id', $request->user_id);
        }

        // Filter by Date Range
        if ($request->filled('date_range')) {
            $range = $request->date_range;
            switch ($range) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'yesterday':
                    $query->whereDate('created_at', Carbon::yesterday());
                    break;
                case 'last_week':
                    $query->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
                    break;
                case 'last_month':
                    $query->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
                    break;
            }
        }

        $activities = $query->paginate(20)->withQueryString();

        // Get users who have activities to populate the filter dropdown
        $users = User::whereIn('id', Activity::select('causer_id')->distinct())->get();

        return view('activity-log.index', [
            'activities' => $activities,
            'users' => $users,
            'filters' => $request->only(['user_id', 'date_range']),
        ]);
    }

    public function clear(Request $request)
    {
        $request->validate([
            'date_range' => 'required|string',
        ]);

        $query = Activity::query();
        $range = $request->date_range;

        if ($range === 'all') {
            // Hapus semua log
            $query->delete();
            return redirect()->route('activity-log.index')->with('success', 'Semua log aktivitas telah dihapus.');
        }

        switch ($range) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'yesterday':
                $query->whereDate('created_at', Carbon::yesterday());
                break;
            case 'last_week':
                $query->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
                break;
            case 'last_month':
                $query->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
                break;
            default:
                return redirect()->route('activity-log.index')->with('error', 'Rentang waktu tidak valid.');
        }

        $count = $query->count();
        $query->delete();

        AdminNotifier::send(new ActivityLogClearedNotification($range, $count));

        return redirect()->route('activity-log.index')->with('success', "Berhasil menghapus {$count} log aktivitas.");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Karyawan extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nama',
        'jabatan',
        'tanggal_lahir',
        'tanggal_masuk',
        'foto',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['umur'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) => "Data karyawan {$this->nama} telah di-{$eventName}");
    }

    /**
     * Get the user's age.
     */
    protected function umur(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tanggal_lahir ? Carbon::parse($this->tanggal_lahir)->age : null,
        );
    }
}

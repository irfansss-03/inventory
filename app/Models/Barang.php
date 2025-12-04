<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Barang extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nama',
        'kategori',
        'stok',
        'harga',
        'deskripsi',
        'foto',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->setDescriptionForEvent(fn(string $eventName) => "Data barang {$this->nama} telah di-{$eventName}");
    }
}

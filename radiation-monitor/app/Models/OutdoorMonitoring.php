<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutdoorMonitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'time',
        'temperature',
        'humidity',
        'dose_rate'
    ];
}

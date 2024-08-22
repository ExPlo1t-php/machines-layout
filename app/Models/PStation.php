<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PStation extends Model
{
    protected $connection = 'pgsql';
    use HasFactory;
    public $timestamps = false;
    protected $table = 'station';
    protected $fillable = [
        'station_id',
        'ipaddress',
        'name',
    ];
}

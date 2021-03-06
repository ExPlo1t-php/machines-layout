<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'station_type';
    protected $fillable = [
        'name',
        'description',
        'icon',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ping extends Model
{
    use HasFactory;
    protected $table = 'ping';
    protected $fillable = [
        'name',
        'type',
        'ipAddr',
        'state',
    ];
}

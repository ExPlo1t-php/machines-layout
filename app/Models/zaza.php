<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zaza extends Model
{
    protected $connection = 'pgsql';
    use HasFactory;
    public $timestamps = false;
    protected $table = 'zaza';
    protected $fillable = [
        'id',
        'name',
        'description',
    ];
}

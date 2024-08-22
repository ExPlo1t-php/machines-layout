<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PLine extends Model
{
    protected $connection = 'pgsql';
    use HasFactory;
    public $timestamps = false;
    protected $table = 'line';
    protected $fillable = [
        'line_id',
        'name',
    ];
}

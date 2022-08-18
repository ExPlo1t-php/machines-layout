<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ports extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ports';
    protected $fillable = [
        'portNum',
        'switchId',
        'assigned',
        'assignedTo',

    ];
}

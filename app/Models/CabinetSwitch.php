<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinetSwitch extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $timestamps = false;
    protected $table = 'switch';
    protected $fillable = [
        'cabName',
        'switchName',
        'ipAddr',
        'portsNum',
        'state',
        'description',
    ];


}

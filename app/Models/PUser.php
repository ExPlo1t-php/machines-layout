<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PUser extends Model
{
    protected $connection = 'pgsql';
    use HasFactory;
    public $timestamps = false;
    protected $table = 'app_users';
    protected $fillable = [
        'email',
        'password',
        'role',
    ];
}

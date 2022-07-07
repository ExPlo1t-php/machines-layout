<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkCabinet extends Model
{
    use HasFactory;
    public $timestamps = false; 
    protected $table = 'network_cabinet';
    protected $fillable = [
        'name',
        'zone',
        'description',

    ];


    public function switches()
    {
        return $this->hasMany(CabinetSwitch::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $timestamps = false;
    protected $table = 'equipment';
    protected $fillable = [
        'type',
        'name',
        'SN',
        'supplier',
        'ipAddr',
        'state',
        'switch',
        'port',
        'decription',
        'station',
    ];

    public function station()
    {
        return $this->hasOne(Station::class);
    }
    public function type()
    {
        return $this->hasOne(EquipmentType::class);
    }
}

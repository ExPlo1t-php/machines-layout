<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'equipment';
    protected $fillable = [
        'type',
        'name',
        'SN',
        'supplier',
        'ipAddr',
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

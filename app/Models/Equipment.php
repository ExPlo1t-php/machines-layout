<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $table = 'equipment';
    protected $fillable = [
        'name',
        'SN',
        'supplier',
        'IpAddr',
        'port',
        'decription',

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

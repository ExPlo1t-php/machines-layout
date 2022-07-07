<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'equipment_type';
    protected $fillable = [
        'name',
        'description',
        'icon',
    ];
}

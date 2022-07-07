<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Switch_;

class Station extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'station';
    protected $fillable = [
        'type',
        'name',
        'SN',
        'supplier',
        'mainIpAddr',
        'switch',
        'port',
        'decription',
        'line',

    ];

    public function line()
    {
        return $this->hasOne(Line::class);
    }
    public function switch()
    {
        return $this->hasOne(CabinetSwitch::class);
    }
    public function type()
    {
        return $this->hasOne(StationType::class);
    }
}

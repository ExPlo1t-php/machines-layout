<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Switch_;

class Station extends Model
{
    use HasFactory;
    protected $table = 'station';
    protected $fillable = [
        'name',
        'SN',
        'supplier',
        'mainIpAddr',
        'port',
        'decription',

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

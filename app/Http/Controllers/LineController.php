<?php

namespace App\Http\Controllers;

use App\Models\CabinetSwitch;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Models\NetworkCabinet;
use App\Models\Station;
use Illuminate\Http\Request;

class LineController extends Controller
{
    public function lineInfo($type){
    $url = rawurldecode($type);
    // $line = Station::get()->where('line', '=', $url);
    $line = Station::get();

    $index = $line->keys();
    $switch = CabinetSwitch::get()->where('switchId', '=', $line[$index]->switch);
    // $cabinet = NetworkCabinet::get()->where('cabName', '=', $switch[0]->name);
    return view('pages.lineInfo', ['line'=>$line[$index], 'index'=>$index,  ]);
    // 'cabinet'=>$cabinet[0] 'switch'=>$switch,
    }
}

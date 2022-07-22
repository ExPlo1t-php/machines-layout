<?php

namespace App\Http\Controllers;

use App\Models\CabinetSwitch;
use App\Models\NetworkCabinet;
use App\Models\Station;
use Illuminate\Http\Request;

class StationsController extends Controller
{
    public function stationInfo($name){
        $station = Station::get()->where('name', '=', $name);
        $index = $station->keys()[0];
        $switch = CabinetSwitch::get()->where('switchId', '=', $station[$index]->switch);
        $cabinet = NetworkCabinet::get()->where('cabName', '=', $switch[0]->name);
        return view('pages.stationInfo', ['station'=>$station[$index], 'switch'=>$switch[0], 'cabinet'=>$cabinet[0]]);
    }
}

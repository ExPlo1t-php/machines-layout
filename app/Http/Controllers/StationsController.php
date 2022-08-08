<?php

namespace App\Http\Controllers;

use App\Models\CabinetSwitch;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Models\NetworkCabinet;
use App\Models\Station;
use Illuminate\Http\Request;

class StationsController extends Controller
{
    public function stationInfo($name){
        $station = Station::get()->where('name', '=', $name);
        $index = $station->keys()[0];
        $switch = CabinetSwitch::get()->where('switchId', '=', $station[$index]->switch);
        $cabinet = NetworkCabinet::get()->where('name', '=', $switch[$switch->keys()[0]]->cabName);
        $equipments = Equipment::get()->where('station', '=', $name);
            $eqtype = EquipmentType::get();
        return view('pages.stationInfo', ['index'=>$index, 'station'=>$station[$index], 'switch'=>$switch[$switch->keys()[0]], 'cabinet'=>$cabinet[$cabinet->keys()[0]],  'equipments'=>$equipments, 'eqtype'=>$eqtype]);
    }
}

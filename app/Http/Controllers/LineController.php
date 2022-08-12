<?php

namespace App\Http\Controllers;

use App\Models\CabinetSwitch;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Models\Line;
use App\Models\NetworkCabinet;
use App\Models\Station;
use Illuminate\Http\Request;
use Mockery\Undefined;

class LineController extends Controller
{
    public function lineInfo($type){
    $url = rawurldecode($type);
    $line = Line::get()->where('id', '=', $url);
    $stations = Station::get()->where('line', '=', $line[$line->keys()[0]]->name);
    $index = $stations->keys();

    if(isset($index[0])){
        // $switch = CabinetSwitch::get()->where('switchId', '=', $stations[$index]->switch);
        $switch = null;
        $cabinet = null;
        // $cabinet = NetworkCabinet::get()->where('cabName', '=', $switch[0]->name);
        return view('pages.lineInfo', ['stations'=>$stations, 'index'=>$index, 'switch'=>$switch, 'cabinet'=>$cabinet]);
    }else{
        $status = 'There\'s no stations in this line.';
        return view('pages.lineInfo', ['status'=>$status, 'index'=>$index, 'line'=>$stations]);
        }
    }
}

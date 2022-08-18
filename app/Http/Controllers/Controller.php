<?php

namespace App\Http\Controllers;

use App\Models\CabinetSwitch;
use App\Models\Line;
use App\Models\NetworkCabinet;
use App\Models\Ports;
use App\Models\Station;
use App\Models\StationType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  public function injection(){
    $stations = Station::get()->whereNull('line');
    $cabinets = NetworkCabinet::get()->where('zone', '=','line');
    $type = StationType::get();
    return view('pages.injection', ['stations'=>$stations, 'type'=>$type, 'cabinets'=>$cabinets]);
  }
  
  public function assembly(){
    $lines = Line::get();
    $cabinets = NetworkCabinet::get()->where('zone', '=','assembly');
    $switch = CabinetSwitch::get();
    $port = Ports::get();
    return view('pages.assembly', ['lines'=>$lines, 'cabinets'=>$cabinets, 'switch'=>$switch, 'port'=>$port]);
  }

  public function test(){
    $stations= Station::where('description')->paginate(7);
    return view('test', ['stations'=>$stations]);
  }
}


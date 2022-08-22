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
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  public function injection(){
    $stations = Station::get()->whereNull('line');
    $cabinets = NetworkCabinet::get()->where('zone', '=','injection');
    $type = StationType::get();
    $switch = CabinetSwitch::get();
    $port = Ports::get();
    return view('pages.injection', ['stations'=>$stations, 'type'=>$type, 'cabinets'=>$cabinets, 'switch'=>$switch, 'port'=>$port]);
  }
  
  public function assembly(){
    $lines = Line::get();
    $cabinets = NetworkCabinet::get()->where('zone', '=','assembly');
    $switch = CabinetSwitch::get();
    $port = Ports::get();
    return view('pages.assembly', ['lines'=>$lines, 'cabinets'=>$cabinets, 'switch'=>$switch, 'port'=>$port]);
  }
  
  public function test(){
    $lines = Line::get();
    $cabinets = NetworkCabinet::get()->where('zone', '=','assembly');
    $switch = CabinetSwitch::all();
    $port = Ports::get();
    return view('test', ['lines'=>$lines, 'cabinets'=>$cabinets, 'switch'=>$switch, 'port'=>$port]);
  }

  public function fetchFreePorts(Request $request){
    if($request->ajax())
    {
    $output="";
    // search criteria
    $ports= Ports::get()
    ->where('switchId','=',$request->switch)
    ->whereNull('assigned')
    ->whereNull('assignedTo');
    if($ports)
    {
      foreach ($ports as $port) {
      $output .= '<option value="'.$port->portNum.'">'.$port->portNum.'</option>';
    }
    return Response($output);
  }
       }
  }
}


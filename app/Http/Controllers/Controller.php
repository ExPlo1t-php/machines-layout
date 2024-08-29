<?php

namespace App\Http\Controllers;

use App\Models\CabinetSwitch;
use App\Models\Line;
use App\Models\NetworkCabinet;
use App\Models\Ports;
use App\Models\Ping;
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
    // fetches all the data needed for the injection view
    public function injection(){
      $stations = Station::get()->whereNull('line');
      $cabinets = NetworkCabinet::get()->where('zone', '=','injection');
    $type = StationType::get();
    $switch = CabinetSwitch::get();
    $port = Ports::get();
    $ping = Ping::get();
    return view('pages.injection', ['stations'=>$stations, 'type'=>$type, 'cabinets'=>$cabinets, 'switch'=>$switch, 'port'=>$port, 'ping'=>$ping]);
  }
  
  // fetches all the data needed for the assembly view
  public function assembly(){
    $lines = Line::get();
    $cabinets = NetworkCabinet::get()->where('zone', '=','assembly');
    $switch = CabinetSwitch::get();
    $port = Ports::get();
    $ping = Ping::where('type', '=', 'switch')->get();
    return view('pages.assembly', ['lines'=>$lines, 'cabinets'=>$cabinets, 'switch'=>$switch, 'port'=>$port, 'ping'=>$ping]);
  }

  // fetching the unused ports ([assigned col = null] and [assignedTo col = null])
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

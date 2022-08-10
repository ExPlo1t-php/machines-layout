<?php

namespace App\Http\Controllers;

use App\Models\CabinetSwitch;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Models\Line;
use App\Models\NetworkCabinet;
use App\Models\Station;
use App\Models\StationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{

    // network cabinet update ------------------------------------------
    public function showCabinet($name){
        $url = rawurldecode($name);
        // echo $url;
        $cabinet = NetworkCabinet::get()->where('name', '=', $url);
        // getting the goddamned index value 😠
        $index = $cabinet->keys()[0];

        return view('components.forms.cabinetUpdate', ['cabinet'=> $cabinet, 'index'=>$index]);
        
    }
    public function updateCabinet(Request $request, $name){
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $request->validate([
            'name' => 'required|max:20|unique:network_cabinet',
            'zone' => 'required|max:20',
            'description' => 'max:500',
         ]);
         // inserting validated data
         NetworkCabinet::where('name',$name)->update($input);
 
         return redirect('cabinet')->with('success','item changed successfully!');
    }
    // network cabinet update ------------------------------------------

    // cabinet switch update ------------------------------------------
    public function showSwitch($switchId){
        $url = rawurldecode($switchId);
        // echo $url;
        $switch = CabinetSwitch::get()->where('switchId', '=', $url);
        // getting the goddamned index value 😠
        $index = $switch->keys()[0];

        return view('components.forms.switchUpdate', ['switch'=> $switch, 'index'=>$index]);
        
    }
    public function updateSwitch(Request $request, $switchId){
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $request->validate([
            'cabName' => 'required|max:20',
            'ipAddr' => ['required', 'max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'portsNum' => 'required|max:2'
         ]);
         // inserting validated data
         CabinetSwitch::where('switchId',$switchId)->update($input);
 
         return redirect('switch')->with('success','item changed successfully!');
    }
    // cabinet switch update ------------------------------------------

    // assembly line update ------------------------------------------
    public function showLine($name){
        $url = rawurldecode($name);
        // echo $url;
        $line = Line::get()->where('name', '=', $url);
        // getting the goddamned index value 😠
        $index = $line->keys()[0];
        return view('components.forms.lineUpdate', ['line'=> $line, 'index'=>$index]);
        
    }
    public function updateLine(Request $request, $name){
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $request->validate([
            'name' => 'required|max:20|unique:line',
            'description' => 'max:500',
         ]);
         // inserting validated data
         Line::where('name',$name)->update($input);
 
         return redirect('lines')->with('success','item changed successfully!');;
    }
    // assembly line update ------------------------------------------

    // station update ------------------------------------------
    public function showStation($name){
        $url = rawurldecode($name);
        // echo $url;
        $station = Station::get()->where('name', '=', $url);
        // getting the goddamned index value 😠
        $index = $station->keys()[0];
        return view('components.forms.stationUpdate', ['station'=> $station, 'index'=>$index]);
        
    }
    public function updateStation(Request $request, $name){
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $request->validate([
            'type' => 'required|max:20',
            'name' => 'required|max:20',
            'supplier' => 'required|max:20',
            'mainIpAddr' => ['required', 'max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'ipAddr1' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'ipAddr2' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'ipAddr3' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'switch' => 'required|max:20',
            'port' => 'required|max:20',
            'line' => 'max:20',
            'description' => 'max:500',
         ]);
         // inserting validated data
         Station::where('name',$name)->update($input);
 
         return redirect('station')->with('success','item changed successfully!');;
    }
    // Station update ------------------------------------------

    // station type update ------------------------------------------
    public function showStationType($name){
        $url = rawurldecode($name);
        // echo $url;
        $type = StationType::get()->where('name', '=', $url);
        // getting the goddamned index value 😠
        $index = $type->keys()[0];
        return view('components.forms.stationTypeUpdate', ['type'=> $type, 'index'=>$index]);
        
    }
    public function updateStationType(Request $request, $name){
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $filename = $input['icon']->getClientOriginalName();
        
         // validating input data
         $request->validate([
             'name' => 'required|max:20|unique:station_type',
             'description' => 'max:500',
             'icon' => 'max:50',
         ]);
         
         // moving temporary image to the main folder and switching the request name
         // with the actual file name
         $input['icon']-> move(public_path('Image'), $filename);
         $input['icon']= $filename;
         // inserting validated data
         StationType::where('name',$name)->update($input);
 
         return redirect('stationType')->with('success','item changed successfully!');;
    }
    // Station type update ------------------------------------------
    
    // equipment update ------------------------------------------
    public function showEquipment($name){
        $url = rawurldecode($name);
        // echo $url;
        $equipment = Equipment::get()->where('name', '=', $url);
        // getting the goddamned index value 😠
        $index = $equipment->keys()[0];
        return view('components.forms.equipmentUpdate', ['equipment'=> $equipment, 'index'=>$index]);
        
    }
    public function updateEquipment(Request $request, $name){
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $request->validate([
            'type' => 'required|max:20',
            'name' => 'required|max:20',
            'supplier' => 'required|max:20',
            'ipAddr' => ['required', 'max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'station' => 'required|max:20',
            'port' => 'required|max:20',
            'description' => 'max:500',
         ]);
         // inserting validated data
         Equipment::where('name',$name)->update($input);
 
         return redirect('equipment')->with('success','item changed successfully!');;
    }
    // equipment update ------------------------------------------

    // station type update ------------------------------------------
    public function showEquipmentType($name){
        $url = rawurldecode($name);
        // echo $url;
        $type = EquipmentType::get()->where('name', '=', $url);
        // getting the goddamned index value 😠
        $index = $type->keys()[0];
        return view('components.forms.equipmentTypeUpdate', ['type'=> $type, 'index'=>$index]);
        
    }
    public function updateEquipmentType(Request $request, $name){
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $filename = $input['icon']->getClientOriginalName();
        
         // validating input data
         $request->validate([
             'name' => 'required|max:20|unique:station_type',
             'description' => 'max:500',
             'icon' => 'max:50',
         ]);
         
         // moving temporary image to the main folder and switching the request name
         // with the actual file name
         $input['icon']-> move(public_path('Image'), $filename);
         $input['icon']= $filename;
         // inserting validated data
         EquipmentType::where('name',$name)->update($input);
    
         return redirect('equipment-type')->with('success','item changed successfully!');;
    }
    // Station type update ------------------------------------------
}

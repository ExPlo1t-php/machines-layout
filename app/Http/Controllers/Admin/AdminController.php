<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// data models
use App\Models\CabinetSwitch;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Models\Line;
use App\Models\NetworkCabinet;
use App\Models\StationType;
use App\Models\Station;
// data models

use Illuminate\Http\Request;

class AdminController extends Controller
{

    // show form components ------------------------------------
    // network cabinet
    public function showCab(){
        return view('components.forms.cabinet');
    }
    // network switch
    public function showSw(){
        return view('components.forms.switch');
    }
    // Assembly lines
    public function showLn(){
        $line='';
        return view('components.forms.line')->with('line', $line);
    }
    // station
    public function showStation(){
        return view('components.forms.station');
    }
    // station type
    public function showStationType(){
        return view('components.forms.stationType');
    }
    // equipment
    public function showEquipment(){
        return view('components.forms.equipment');
    }
    // equipment type
    public function showEquipmentType(){
        return view('components.forms.equipmentType');
    }


    // add form's data -----------------------------------

    // cabinet-------------------------------------------
    public function addCabinet(Request $request){
        // fetching input data
        $input = $request->all();
        // validating input data
        $request->validate([
           'name' => 'required|max:20|unique:network_cabinet',
            'zone' => 'required|max:20',
            'description' => 'max:500',
        ]);
        // inserting validated data
        NetworkCabinet::create($input);
        
        return redirect('dashboard');
        
    }
    // cabinet-------------------------------------------

    // switch--------------------------------------------
    public function addSwitch(Request $request){
        // fetching input data
        $input = $request->all();
        // validating input data
        $request->validate([
           'cabName' => 'required|max:20',
            'ipAddr' => ['required', 'max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'portsNum' => 'required|max:2'
        ]);
        // inserting validated data
        CabinetSwitch::create($input);

        return redirect('dashboard');

    }
    // switch--------------------------------------------

    // Assembly Line--------------------------------------------
    public function addLine(Request $request){
        // fetching input data
        $input = $request->all();
        // validating input data
        $request->validate([
           'name' => 'required|max:20|unique:line',
           'description' => 'max:500',
        ]);
        // inserting validated data
        Line::create($input);

        return redirect('dashboard');

    }
    // Assembly line--------------------------------------------

    // Station type--------------------------------------------
    public function addStationType(Request $request){
        // fetching input data
        $input = $request->all();

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
        StationType::create($input);

        return redirect('dashboard');

    }
    // Station type--------------------------------------------

    // equipment type--------------------------------------------
    public function addEquipmentType(Request $request){
        // fetching input data
        $input = $request->all();

        $filename = $input['icon']->getClientOriginalName();
        
        
        // validating input data
        $request->validate([
            'name' => 'required|max:20|unique:equipment_type',
            'description' => 'max:500',
            'icon' => 'max:50',
        ]);
        
        // moving temporary image to the main folder and switching the request name
        // with the actual file name
        $input['icon']-> move(public_path('Image'), $filename);
        $input['icon']= $filename;
        // inserting validated data
        EquipmentType::create($input);

        return redirect('dashboard');

    }
    // equipment type--------------------------------------------

    // add station--------------------------------------------
    public function addStation(Request $request){
        // fetching input data
        $input = $request->all();

        
        
        // validating input data
        $request->validate([
            'type' => 'required|max:20',
            'name' => 'required|max:20',
            'SN' => 'required|max:20|unique:station',
            'supplier' => 'required|max:20',
            'mainIpAddr' => ['required', 'max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'ipAddr1' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'ipAddr2' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'ipAddr3' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'mainIpAddr' => ['required', 'max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'mainIpAddr' => ['required', 'max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'switch' => 'required|max:20',
            'port' => 'required|max:20',
            'line' => 'required|max:20',
            'description' => 'max:500',
        ]);
        
        // inserting validated data
        Station::create($input);

        return redirect('dashboard');

    }
    // add station--------------------------------------------

    // add station--------------------------------------------
    public function addEquipment(Request $request){
        // fetching input data
        $input = $request->all();

        
        
        // validating input data
        $request->validate([
            'type' => 'required|max:20',
            'name' => 'required|max:20',
            'SN' => 'required|max:20|unique:station',
            'supplier' => 'required|max:20',
            'ipAddr' => ['required', 'max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i'],
            'port' => 'required|max:20',
            'station' => 'required|max:20',
            'description' => 'max:500',
        ]);
        
        // inserting validated data
        Equipment::create($input);

        return redirect('dashboard');

    }
    // add station--------------------------------------------

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// data models
use App\Models\CabinetSwitch;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Models\Line;
use App\Models\NetworkCabinet;
use App\Models\Ports;
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
    public function showSpecificEquipment($SN){
        $url = urldecode($SN);
        $station = Station::get()->where('SN', '=', $url);
        $index = $station->keys()[0];
        return view('components.forms.equipment', ['st'=>$station[$index]]);
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
        
        return redirect('cabinet');
        
    }
    // cabinet-------------------------------------------

    // switch--------------------------------------------
    public function addSwitch(Request $request){
        // fetching input data
        $input = $request->all();
        // validating input data
        $request->validate([
           'cabName' => 'required|max:20',
           'switchNumber'=>'required|max:5',
            'ipAddr' => ['required', 'max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i', 'unique:switch'],
            'portsNum' => 'required|max:2'
        ]);
        // inserting validated data
        CabinetSwitch::create($input);
        $switchId = CabinetSwitch::get()->where('ipAddr','=',$request->ipAddr);
        $i = 1;
        while($i<=$request->portsNum){
            Ports::insert([
                'portNum'=>$i, 'switchId'=>$switchId[$switchId->keys()[0]]->id,
            ]);
            $i++;
        }
        return redirect('switch');

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

        return redirect('lines');

    }
    // Assembly line--------------------------------------------

    // Station type--------------------------------------------
    public function addStationType(Request $request){
        // fetching input data
        $input = $request->all();

        
        
        // validating input data
        $request->validate([
            'name' => 'required|max:20|unique:station_type',
            'description' => 'max:500',
            'icon' => 'required|max:50',
        ]);
        
        $filename = $input['icon']->getClientOriginalName();
        // moving temporary image to the main folder and switching the request name
        // with the actual file name
        $input['icon']-> move(public_path('/assets/images/machines/'), $filename);
        $input['icon']= $filename;
        // inserting validated data
        StationType::create($input);

        return redirect('station-type');

    }
    // Station type--------------------------------------------

    // equipment type--------------------------------------------
    public function addEquipmentType(Request $request){
        // fetching input data
        $input = $request->all();

        
        
        // validating input data
        $request->validate([
            'name' => 'required|max:20|unique:equipment_type',
            'description' => 'max:500',
            'icon' => 'required|max:50',
        ]);
        
        $filename = $input['icon']->getClientOriginalName();
        // moving temporary image to the main folder and switching the request name
        // with the actual file name
        $input['icon']-> move(public_path('assets/images/equipments/'), $filename);
        $input['icon']= $filename;
        // inserting validated data
        EquipmentType::create($input);

        return redirect('equipment-type');

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
            'mainIpAddr' => ['required', 'max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i', 'unique:station'],
            'ipAddr1' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i', 'unique:station'],
            'ipAddr2' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i', 'unique:station'],
            'ipAddr3' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i', 'unique:station'],
            'switch' => 'required|max:20',
            'port' => 'required|max:20',
            'line' => 'max:20',
            'description' => 'max:500',
        ]);
                // alter the ports:assigned and ports:assignedTo values
                Ports::where('portNum', $request->port)->where('switchId', $request->switch)
                ->update([
                       'assigned' => 1,
                       'assignedTo' => $request->name,
                ]);
                // alter the ports:assigned and ports:assignedTo values
        // inserting validated data
        Station::create($input);

        return redirect('station');

    }
    // add station--------------------------------------------

    // add equipment--------------------------------------------
    public function addEquipment(Request $request){
        // fetching input data
        $input = $request->all();

        
        
        // validating input data
        $request->validate([
            'type' => 'required|max:20',
            'name' => 'required|max:20|unique:equipment',
            'SN' => 'required|max:20|unique:equipment',
            'supplier' => 'required|max:20',
            'ipAddr' => ['required', 'max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i', 'unique:equipment'],
            'port' => 'required|max:20',
            'station' => 'required|max:20',
            'description' => 'max:500',
        ]);
        // alter the ports:assigned and ports:assignedTo values
        Ports::where('portNum', $request->port)->where('switchId', $request->switch)
        ->update([
                'assigned' => 1,
                'assignedTo' => $request->name,
        ]);
        // inserting validated data
        Equipment::create($input);
        
        
        return redirect('equipment');
    }
    public function addSpecificEquipment(Request $request, $SN){
        // fetching input data
        $input = $request->all();

        
        
        // validating input data
        $request->validate([
            'type' => 'required|max:20',
            'name' => 'required|max:20',
            'SN' => 'required|max:20|unique:station',
            'supplier' => 'required|max:20',
            'ipAddr' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i', 'unique:equipment'],
            'port' => 'max:20',
            'station' => 'required|max:20',
            'description' => 'max:500',
        ]);
        // // alter the ports:assigned and ports:assignedTo values
        // Ports::where('portNum', $request->port)->where('switchId', $portNum)
        // ->update([
        //        'assigned' => 1,
        //        'assignedTo' => $request->name,
        // ]);
        // // alter the ports:assigned and ports:assignedTo values
        // inserting validated data
        Equipment::create($input);
        return redirect('stationInfo/'.$SN);
    }
    // add equipment--------------------------------------------

}

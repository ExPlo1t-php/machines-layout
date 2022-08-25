<?php

namespace App\Http\Controllers;

use App\Models\CabinetSwitch;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Models\Line;
use App\Models\NetworkCabinet;
use App\Models\Ports;
use App\Models\Station;
use App\Models\StationType;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{

    // network cabinet update ------------------------------------------
    public function showCabinet($id){
        $url = urldecode($id);
        // echo $url;
        $cabinet = NetworkCabinet::get()->where('id', '=', $url);
        $index = $cabinet->keys()[0];

        return view('components.forms.cabinetUpdate', ['cabinet'=> $cabinet, 'index'=>$index]);
        
    }
    public function updateCabinet(Request $request, $id){
        $url = urldecode($id);
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $request->validate([
            'name' => ['required','max:20', Rule::unique('network_cabinet')->ignore($id)],
            'zone' => 'required|max:20',
            'description' => 'max:500',
         ]);
         // inserting validated data
         NetworkCabinet::where('id',$url)->update($input);
 
         return redirect('cabinet')->with('success','Item changed successfully!');
    }
    // network cabinet update ------------------------------------------

    // cabinet switch update ------------------------------------------
    public function showSwitch($id){
        $url = urldecode($id);
        // echo $url;
        $switch = CabinetSwitch::get()->where('id', '=', $url);
        $index = $switch->keys()[0];

        return view('components.forms.switchUpdate', ['switch'=> $switch, 'index'=>$index]);
        
    }
    public function updateSwitch(Request $request, $id){
        // ______________________________________⚠️DO NOT TOUCH THIS IT IS PERFECTLY WORKING⚠️_____________________________________________________________
        $dboldports = CabinetSwitch::get()->where('id',$id);
        $oldports = $dboldports[$dboldports->keys()[0]]->portsNum;
        $newports = $request->portsNum;
        $i = $oldports + 1;
        
        // ports function start------------------------------------------------------------------------------------------------
        //check if the new value of ports is bigger than the old 
        if($oldports <= $newports){
            // if the array returns empty(which means the switch has no ports)
            // check if the new value is equal or bigger
            if(Ports::get()->where('switchId','=',$id)->isEmpty()){
                // if its equal and the array empty he adds a number of ports , as long as the array is empty
                if($oldports == $newports){
                    // echo 'the array is empty+equality';
                    for ($i=1; $i <= $newports ; $i++) { 
                        Ports::insert([
                            'portNum'=>$i, 'switchId'=>$id,
                        ]);
                    }
                }else{
                    // echo 'the array is empty';
                    $i = 1;
                    while($i <= $newports){
                        Ports::insert([
                            'portNum'=>$i, 'switchId'=>$id,
                        ]);
                        $i++;
                    }
                }
            }else{
                if($oldports < $newports){
                    // echo 'the array is not empty and new >= old';
                    echo $oldports;
                    echo $newports;
                    for ($i=$oldports+1; $i <= $newports; $i++){
                            Ports::insert([
                                    'portNum'=>$i, 'switchId'=>$id,
                                ]);
                    }
                }
            }
        }elseif($oldports > $newports){
            // $j =$oldports - $newports;
            while($oldports>$newports){
                $ports = Ports::where('portNum','=', $oldports);
                $ports->delete();
                echo 'success2';
                $oldports--;
            }
        }
        // ______________________________________⚠️DO NOT TOUCH THIS IT IS PERFECTLY WORKING⚠️_____________________________________________________________
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $request->validate([
            'cabName' => ['required','max:20'],
            'switchName'=>'required|max:5',
            'ipAddr' => ['required', 'max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i', Rule::unique('switch')->ignore($id)],
            'portsNum' => 'required|max:2'
         ]);
         // inserting validated data
         CabinetSwitch::where('id',$id)->update($input);
 
         return redirect('switch')->with('success','Item changed successfully!');
    }
    // cabinet switch update ------------------------------------------

    // assembly line update ------------------------------------------
    public function showLine($id){
        $url = urldecode($id);
        // echo $url;
        $line = Line::get()->where('id', '=', $url);
        $index = $line->keys()[0];
        return view('components.forms.lineUpdate', ['line'=> $line, 'index'=>$index]);
        
    }
    public function updateLine(Request $request, $id){
        $url = urldecode($id);
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $request->validate([
            'name' => ['required','max:20', Rule::unique('line')->ignore($id)],
            'description' => 'max:500',
         ]);
         // inserting validated data
         Line::where('id',$url)->update($input);
 
         return redirect('lines')->with('success','Item changed successfully!');
    }
    // assembly line update ------------------------------------------

    // station update ------------------------------------------
    public function showStation($SN){
        $url = rawurldecode($SN);
        // echo $url;
        $station = Station::get()->where('SN', '=', $url);
        $index = $station->keys()[0];
        return view('components.forms.stationUpdate', ['station'=> $station, 'index'=>$index]);
        
    }
    public function updateStation(Request $request, $SN){
        $url = urldecode($SN);
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $request->validate([
            'type' => 'required|max:20',
            'name' => ['required','max:20',Rule::unique('station')->ignore($SN, 'SN')],
            'supplier' => 'required|max:20',
            'mainIpAddr' => ['required', 'max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i', Rule::unique('station')->ignore($url, 'SN')],
            'ipAddr1' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i', Rule::unique('station')->ignore($url, 'SN')],
            'ipAddr2' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i', Rule::unique('station')->ignore($url, 'SN')],
            'ipAddr3' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i', Rule::unique('station')->ignore($url, 'SN')],
            'switch' => 'required|max:20',
            'port' => 'required|max:20',
            'line' => 'max:20',
            'description' => 'max:500',
         ]);
                $station = Station::where('SN','=',$SN);
                $stations = $station->get()[0];
                // setting the assigned and assignedTo values to null on the port that was used by the station
                Ports::where('portNum', $stations->port)->where('switchId', $stations->switch)
                ->update([
                        'assigned' => NULL,
                        'assignedTo' =>NULL,
                ]);
                // alter the ports:assigned and ports:assignedTo values
                Ports::where('portNum', $request->port)->where('switchId', $request->switch)
                ->update([
                       'assigned' => 1,
                       'assignedTo' => $request->name,
                ]);
                // alter the ports:assigned and ports:assignedTo values
         // inserting validated data
         Station::where('SN',$url)->update($input);
 
         return redirect('station')->with('success','Item changed successfully!');
    }
    // Station update ------------------------------------------

    // station type update ------------------------------------------
    public function showStationType($id){
        $url = urldecode($id);
        // echo $url;
        $type = StationType::get()->where('id', '=', $url);
        $index = $type->keys()[0];
        return view('components.forms.stationTypeUpdate', ['type'=> $type, 'index'=>$index]);
        
    }
    public function updateStationType(Request $request, $id){
        $url = urldecode($id);
         // fetching input data
         $input = $request->except('_token', 'update');
         
         // validating input data
         $request->validate([
             'name' => ['required','max:20',Rule::unique('station_type')->ignore($url)],
             'description' => 'max:500',
             'icon' => 'max:50',
         ]);
    if($request->icon){
        // checking if there's an icon in the input   
         // validating input data
         $filename = $input['icon']->getClientOriginalName();
         // moving temporary image to the main folder and switching the request name
         // with the actual file name
         $input['icon']-> move(public_path('/assets/images/machines/'), $filename);
         $input['icon']= $filename;
    }
         // inserting validated data
         StationType::where('id',$url)->update($input);
         return redirect('station-type')->with('success','Item changed successfully!');
    }
    // Station type update ------------------------------------------
    
    // equipment update ------------------------------------------
    public function showEquipment($SN){
        $url = urldecode($SN);
        // echo $url;
        $equipment = Equipment::get()->where('SN', '=', $url);
        $index = $equipment->keys()[0];
        return view('components.forms.equipmentUpdate', ['equipment'=> $equipment, 'index'=>$index]);
        
    }
    public function updateEquipment(Request $request, $SN){
        $url = urldecode($SN);
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $request->validate([
            'type' => 'required|max:20',
            'name' => ['required','max:20',Rule::unique('equipment')->ignore($url, 'SN')],
            'supplier' => 'required|max:20',
            'ipAddr' => ['max:15', 'regex:/^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/i', Rule::unique('equipment')->ignore($url, 'SN')],
            'station' => 'required|max:20',
            'port' => 'max:20',
            'description' => 'max:500',
         ]);
            $equipments = Equipment::where('SN','=',$SN)->get()[0];
            // setting the assigned and assignedTo values to null on the port that was used by the equipment
            Ports::where('portNum', $equipments->port)->where('switchId', $equipments->switch)
            ->update([
                    'assigned' => NULL,
                    'assignedTo' =>NULL,
            ]);
            // alter the ports:assigned and ports:assignedTo values
            Ports::where('portNum', $request->port)->where('switchId', $request->switch)
            ->update([
                'assigned' => 1,
                'assignedTo' => $request->name,
            ]);
         // inserting validated data
         Equipment::where('SN',$url)->update($input);
 
         return redirect('equipment')->with('success','Item changed successfully!');
    }
    // equipment update ------------------------------------------

    // station type update ------------------------------------------
    public function showEquipmentType($name){
        $url = urldecode($name);
        // echo $url;
        $type = EquipmentType::get()->where('name', '=', $url);
        $index = $type->keys()[0];
        return view('components.forms.equipmentTypeUpdate', ['type'=> $type, 'index'=>$index]);
        
    }
    public function updateEquipmentType(Request $request, $id){
        $url = urldecode($id);
         // fetching input data
         $input = $request->except('_token', 'update');
         
         // validating input data
         $request->validate([
             'name' => ['required','max:20', Rule::unique('equipment_type')->ignore($id)],
             'description' => 'max:500',
             'icon' => 'max:50',
            ]);
        if($request->icon){
            // checking if there's an icon in the input            
            // validating input data
            $filename = $input['icon']->getClientOriginalName();
            // moving temporary image to the main folder and switching the request name
            // with the actual file name
            $input['icon']-> move(public_path('/assets/images/equipments/'), $filename);
            $input['icon']= $filename;
        }
         // inserting validated data
         EquipmentType::where('id',$url)->update($input);
    
         return redirect('equipment-type')->with('success','Item changed successfully!');
    }
    // Station type update ------------------------------------------
}

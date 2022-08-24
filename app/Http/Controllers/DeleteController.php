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
use Exception;

class DeleteController extends Controller
{
    // delete cabinet -----------------------------------
    // childrens : switch
    // parents: none
    public function deleteCabinet($id){
        $equipment = NetworkCabinet::where('id','=',$id);
        $equipment->delete()->with('error','Item deleted successfully!')->with('error','Item deleted successfully!');
    }

    // delete switch -----------------------------------
    // childrens : station / equipment
    // parents: cabinet
    public function deleteSwitch($id){
        $ports = Ports::where('switchId','=', $id);
        $ports->delete();
        $equipment = CabinetSwitch::where('id','=',$id);
        $equipment->delete()->with('error','Item deleted successfully!');
    }

    // delete line -----------------------------------
    // childrens : station
    // parents: none
    public function deleteLine($id){
        $line = Line::where('id','=',$id);
        $line->delete()->with('error','Item deleted successfully!');
    }

    // delete equipment -----------------------------------
    // childrens : none
    // parents: station - equipment type
    public function deleteEquipment($SN){
        $equipment = Equipment::where('SN','=',$SN);
        $equipments = Equipment::where('SN','=',$SN)->get()[0];
        // setting the assigned and assignedTo values to null on the port that was used by the equipment
        Ports::where('portNum', $equipments->port)->where('switchId', $equipments->switch)
        ->update([
               'assigned' => NULL,
               'assignedTo' =>NULL,
        ]);
        $equipment->delete()->with('error','Item deleted successfully!');
    }
    
    // delete equipment type -----------------------------------
    // childrens : equipment
    // parents: none
    public function deleteEquipmentType($id){
        $equipmenttype = EquipmentType::where('id','=',$id);
        $equipmenttype->delete()->with('error','Item deleted successfully!');
    }
    
    // delete station  -----------------------------------
    // childrens : equipment 
    // parents: station type - switch 
    public function deleteStation($SN){
        $station = Station::where('SN','=',$SN);
        $stations = $station->get()[0];
        // setting the assigned and assignedTo values to null on the port that was used by the station
        Ports::where('portNum', $stations->port)->where('switchId', $stations->switch)
        ->update([
               'assigned' => NULL,
               'assignedTo' =>NULL,
        ]);
        $station->delete()->with('error','Item deleted successfully!');
        
    }
    // delete station type -----------------------------------
    // childrens :  station 
    // parents: none
    public function deleteStationType($id){
            $stationtype = StationType::where('id','=',$id);
            $stationtype->delete()->with('error','Item deleted successfully!');
    }
}

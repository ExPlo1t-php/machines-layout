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
    // childrens : tbd
    // parents: tbd
    public function deleteCabinet($id){
        $equipment = NetworkCabinet::where('id','=',$id);
        $equipment->delete();
    }

    // delete switch -----------------------------------
    // childrens : tbd
    // parents: tbd
    public function deleteSwitch($id){
        $ports = Ports::where('switchId','=', $id);
        $ports->delete();
        $equipment = CabinetSwitch::where('id','=',$id);
        $equipment->delete();
    }

    // delete line -----------------------------------
    // childrens : tbd
    // parents: tbd
    public function deleteLine($id){
        $line = Line::where('id','=',$id);
        $line->delete();
    }

    // delete equipment -----------------------------------
    // childrens : none
    // parents: station - equipment type
    public function deleteEquipment($SN){
        $equipment = Equipment::where('SN','=',$SN);
        $equipments = Equipment::where('SN','=',$SN)->get()[0];
        Ports::where('portNum', $equipments->port)->where('switchId', $equipments->switch)
        ->update([
               'assigned' => NULL,
               'assignedTo' =>NULL,
        ]);
        $equipment->delete();
    }
    
    // delete equipment type -----------------------------------
    // childrens : equipment
    // parents: none
    public function deleteEquipmentType($id){
        $equipmenttype = EquipmentType::where('id','=',$id);
        $equipmenttype->delete();
    }
    
    // delete station  -----------------------------------
    // childrens : equipment  #equipment type#
    // parents: station type - switch - #network cabinet#
    public function deleteStation($SN){
        $station = Station::where('SN','=',$SN);
        $stations = $station->get()[0];
        Ports::where('portNum', $stations->port)->where('switchId', $stations->switch)
        ->update([
               'assigned' => NULL,
               'assignedTo' =>NULL,
        ]);
        $station->delete();
        
    }
    // delete station type -----------------------------------
    // childrens :  station - #equipment# - #equipment type#
    // 1️parents: none
    public function deleteStationType($id){
            $stationtype = StationType::where('id','=',$id);
            $stationtype->delete();
    }
}

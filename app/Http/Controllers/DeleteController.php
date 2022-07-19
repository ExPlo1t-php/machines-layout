<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Models\Station;
use App\Models\StationType;
use Exception;

class DeleteController extends Controller
{
    // delete equipment -----------------------------------
    // childrens : none
    // parents: station - equipment type
    public function deleteEquipment($SN){
        $equipment = Equipment::where('SN','=',$SN);
        $equipment->delete();
    }
    
    // delete equipment type -----------------------------------
    // childrens : equipment
    // parents: none
    public function deleteEquipmentType($name){
        $equipmenttype = EquipmentType::where('name','=',$name);
        $equipmenttype->delete();
    }
    
    // delete station  -----------------------------------
    // childrens : equipment  #equipment type#
    // parents: station type - switch - #network cabinet#
    public function deleteStation($SN){
        $station = Station::where('SN','=',$SN);
        $station->delete();
    }
    // delete station type -----------------------------------
    // childrens :  station - #equipment# - #equipment type#
    // 1️parents: none
    public function deleteStationType($name){
            $stationtype = StationType::where('name','=',$name);
            $stationtype->delete();
            return view('station')->with('stat','you can\'t delete this type because it\'s being used by another element');
 

                // try{    //here trying to update email and phone in db which are unique values
                //     DB::table('users')
                //         ->where('role_id',1)
                //         ->update($edit);
                //     return redirect("admin/update_profile")
                //            ->with('update','update');
                //         }catch(Exception $e){
                //          //if email or phone exist before in db redirect with error messages
                //             return redirect()->back()->with('phone_email','phone_email_exist before');
                //         }
    }
}

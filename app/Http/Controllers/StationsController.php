<?php

namespace App\Http\Controllers;

use App\Models\CabinetSwitch;
use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Models\NetworkCabinet;
use App\Models\Station;
use Illuminate\Http\Request;
use App\Models\Coordinates;
use App\Models\Line;
use App\Models\StationType;

class StationsController extends Controller
{
    public function stationInfo($name){
        $url = urldecode($name);
        $station = Station::get()->where('name', '=', $url);
        $index = $station->keys()[0];
        if(!is_null($station[$index]->switch)){
            $switch = CabinetSwitch::get()->where('switchId', '=', $station[$index]->switch);
            $cabinet = NetworkCabinet::get()->where('name', '=', $switch[$switch->keys()[0]]->cabName);
        }
        $equipments = Equipment::get()->where('station', '=', $url);
            $eqtype = EquipmentType::get();
            $stType = StationType::get();
            if(isset($switch) && isset($cabinet)){
                return view('pages.stationInfo', ['index'=>$index, 'station'=>$station[$index], 'switch'=>$switch[$switch->keys()[0]], 'cabinet'=>$cabinet[$cabinet->keys()[0]],  'equipments'=>$equipments, 'eqtype'=>$eqtype, 'stType'=>$stType]);
            }else{
                return view('pages.stationInfo', ['index'=>$index, 'station'=>$station[$index],'equipments'=>$equipments, 'eqtype'=>$eqtype, 'stType'=>$stType]);

            }
    }

    public function stationPos (Request $request, $SN) {
        if($request->ajax())
        {
           $input = $request->all();
           Station::where('SN',$SN)->update($input);
           return redirect('test');
             }
        }
    public function linePos (Request $request, $id) {
        if($request->ajax())
        {
           $input = $request->all();
           Line::where('id',$id)->update($input);
             }
        }
}

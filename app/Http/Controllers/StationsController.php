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
use App\Models\PLine;
use App\Models\PStation;
use App\Models\StationType;
use Illuminate\Support\Facades\Http;

class StationsController extends Controller
{
    public function stationInfo(Request $request, $SN){
        // requesting plcTracking token:
        $plcToken = $request->session()->get('token');
        // fetch data for station info view
        $url = urldecode($SN);
        $station = Station::get()->where('SN', '=', $url);
        $index = $station->keys()[0];
        if(!is_null($station[$index]->switch)){
            // check if the station has a switch assigned to it, to avoid missing data
            $switch = CabinetSwitch::get()->where('id', '=', $station[$index]->switch);
            $cabinet = NetworkCabinet::get()->where('name', '=', $switch[$switch->keys()[0]]->cabName);
        }
        $equipments = Equipment::get()->where('station', '=', $station[$index]->name);
        $eqtype = EquipmentType::get();
        $stType = StationType::get();
        // requesting station id from the PLC database
        $plcLineId = PLine::where('name', '=', $station[$index]->line)->get();
        $plcStationId = PStation::where('name', '=', $station[$index]->name)->get();
        // requesting prototypes using PLC api
        $api = env('API_IP');
        $data = null;
        try{
            $response = HTTP::withHeaders([
                'Authorization' => "Bearer $plcToken",
            ])->get("$api/api/v1/prototypes");
            if($response->successful()){
                $data = $response->json();
            }
        }catch(\Exception $e){
        }
        if (count($plcLineId)!==0) {
            $plcLineId = PLine::where('name', '=', $station[$index]->line)->get()[0]->line_id;
        }
        if (count($plcStationId)!==0) {
            $plcStationId = PStation::where('name', '=', $station[$index]->name)->get()[0]->station_id;
        }
        $role = session()->get('role');
        $loggedIn = session()->get('loggedIn');
        if(isset($switch) && isset($cabinet) || $data == null){
            return view('pages.stationInfo', ['index'=>$index, 'station'=>$station[$index], 'switch'=>$switch[$switch->keys()[0]], 'cabinet'=>$cabinet[$cabinet->keys()[0]],  'equipments'=>$equipments, 'eqtype'=>$eqtype, 'stType'=>$stType, 'token'=>$plcToken, 'stationId'=>$plcStationId, 'lineId'=>$plcLineId, 'role'=>$role, 'loggedIn'=>$loggedIn, 'prototypes'=>$data]);
        }else{
            return view('pages.stationInfo', ['index'=>$index, 'station'=>$station[$index],'equipments'=>$equipments, 'eqtype'=>$eqtype, 'stType'=>$stType, 'token'=>$plcToken, 'stationId'=>$plcStationId, 'lineId'=>$plcLineId, 'role'=>$role, 'loggedIn'=>$loggedIn]);
        }
    }

    // save station position on drag 
    public function stationPos (Request $request, $SN) {
        if($request->ajax())
        {
           $input = $request->all();
           Station::where('SN',$SN)->update($input);
             }
        }
    // save line position on drag
    public function linePos (Request $request, $id) {
        if($request->ajax())
        {
           $input = $request->all();
           Line::where('id',$id)->update($input);
             }
    }
    // save cabinet position on drag
    public function cabinetPos(Request $request, $id) {
        if($request->ajax())
        {
           $input = $request->all();
           NetworkCabinet::where('id',$id)->update($input);
             }
        }
        
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $station = Station::create($validatedData);

        return response()->json($station);
    }
        
}
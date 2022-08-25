<?php

namespace App\Http\Controllers;

use App\Models\equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    // station search bar -------------------------------------------------
    public function searchStation(Request $request)
    {
    if($request->ajax())
    {
    $output="";
    // search criteria
    $station= DB::table('station')
    ->where('name','LIKE','%'.$request->search."%")
    ->orWhere('SN','LIKE','%'.$request->search."%")
    ->orWhere('type','LIKE','%'.$request->search."%")
    ->orWhere('mainIpAddr','LIKE','%'.$request->search."%")
    ->orWhere('mainIpAddr','LIKE','%'.$request->search."%")
    ->get();
    // just a variable to store classes of td opening tag
    $attr = '<td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">';
    if($station)
    {
    foreach ($station as $key => $station) {
    $output.='<tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">'.
    $attr.$station->name.'</td>'.
    $attr.$station->SN.'</td>'.
    $attr.$station->supplier.'</td>'.
    $attr.$station->mainIpAddr.'</td>'.
    $attr.$station->port.'</td>'.
    $attr.$station->switch.'</td>'.
    $attr.$station->line.'</td>'.
    $attr.$station->type.'</td>'.
    $attr.$station->description.'</td>'.
    '<td class="px-4 py-4 text-right flex">'
    .'<a href="#" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>'
    .'<a data-id="'.$station->SN.'" data-method="DELETE" href="'.route('deleteEquipment', $station->SN).'" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>'
    .'</td>'.
    '</tr>';
}
    return Response($output);
       }
       }
    }

    // station type search bar -------------------------------------------------
    public function searchStationType(Request $request)
    {
    if($request->ajax())
    {
    $output="";
    // search criteria
    $type= DB::table('station_type')
    ->where('name','LIKE','%'.$request->search."%")
    ->get();
    // just a variable to store classes of td opening tag
    $attr = '<td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">';
    if($type)
    {
    foreach ($type as $key => $type) {
    $output.='<tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">'.
    $attr.$type->name.'</td>'.
    $attr.$type->description.'</td>'.
    $attr.'<img src="Image/'.$type->icon.'"></td>'.
    '<td class="px-4 py-4 text-right flex">'
    .'<a href="#" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>'
    .'<a data-id="'.$type->name.'" data-method="DELETE" href="'.route('deleteEquipmentType', $type->name).'" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>'
    .'</td>'.
    '</tr>';
}
    return Response($output);
       }
       }
    }
    
    
    
    // equipment search bar -------------------------------------------------
    public function searchEquipment(Request $request)
    {
    if($request->ajax())
    {
    $output="";
    $equipment= DB::table('equipment')
    ->where('name','LIKE','%'.$request->search."%")
    ->orWhere('SN','LIKE','%'.$request->search."%")
    ->orWhere('IpAddr','LIKE','%'.$request->search."%")
    ->get();
    $attr = '<td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">';
    if($equipment)
    {
    foreach ($equipment as $key => $equipment) {
    $output.='<tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">'.
    $attr.$equipment->name.'</td>'.
    $attr.$equipment->SN.'</td>'.
    $attr.$equipment->supplier.'</td>'.
    $attr.$equipment->IpAddr.'</td>'.
    $attr.$equipment->switch.'</td>'.
    $attr.$equipment->port.'</td>'.
    $attr.$equipment->type.'</td>'.
    $attr.$equipment->station.'</td>'.
    $attr.$equipment->description.'</td>'.
    '<td class="px-4 py-4 text-right flex">'
    .'<a href="#" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>'
    .'<a data-id="'.$equipment->name.'" data-method="DELETE" href="'.route('deleteEquipment', $equipment->name).'" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>'
    .'</td>'.
    '</tr>';
}
    return Response($output);
       }
       }
    }
   
    // equipment type search bar -------------------------------------------------
    public function searchEquipmentType(Request $request)
    {
    if($request->ajax())
    {
    $output="";
    // search criteria
    $type= DB::table('equipment_type')
    ->where('name','LIKE','%'.$request->search."%")
    ->get();
    // just a variable to store classes of td opening tag
    $attr = '<td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">';
    if($type)
    {
    foreach ($type as $key => $type) {
    $output.='<tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">'.
    $attr.$type->name.'</td>'.
    $attr.$type->description.'</td>'.
    $attr.'<img src="Image/'.$type->icon.'"></td>'.
    '<td class="px-4 py-4 text-right flex">'
    .'<a href="#" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>'
    .'<a data-id="'.$type->name.'" data-method="DELETE" href="'.route('deleteEquipmentType', $type->name).'" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>'
    .'</td>'.
    '</tr>';
}
    return Response($output);
       }
       }
    }
    
    // Assembly line search bar -------------------------------------------------
    public function searchLine(Request $request)
    {
    if($request->ajax())
    {
    $output="";
    // search criteria
    $line= DB::table('line')
    ->where('name','LIKE','%'.$request->search."%")
    ->get();
    // just a variable to store classes of td opening tag
    $attr = '<td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">';
    if($line)
    {
    foreach ($line as $key => $line) {
    $output.='<tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">'.
    $attr.$line->name.'</td>'.
    $attr.$line->description.'</td>'.
    '<td class="px-4 py-4 text-right flex">'
    .'<a href="#" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>'
    .'<a data-id="'.$line->name.'" data-method="DELETE" href="'.route('deleteLine', $line->name).'" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>'
    .'</td>'.
    '</tr>';
}
    return Response($output);
       }
       }
    }
    
    // switch search bar -------------------------------------------------
    public function searchCabinet(Request $request)
    {
    if($request->ajax())
    {
    $output="";
    // search criteria
    $cabinet= DB::table('network_cabinet')
    ->where('name','LIKE','%'.$request->search."%")
    ->orWhere('zone','LIKE','%'.$request->search."%")
    ->get();
    // just a variable to store classes of td opening tag
    $attr = '<td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">';
    if($cabinet)
    {
    foreach ($cabinet as $key => $cabinet) {
    $output.='<tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">'.
    $attr.$cabinet->name.'</td>'.
    $attr.$cabinet->zone.'</td>'.
    $attr.$cabinet->description.'</td>'.
    '<td class="px-4 py-4 text-right flex">'
    .'<a href="#" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>'
    .'<a data-id="'.$cabinet->name.'" data-method="DELETE" href="'.route('deleteCabinet', $cabinet->name).'" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>'
    .'</td>'.
    '</tr>';
}
    return Response($output);
       }
       }
    }

    // switch search bar -------------------------------------------------
    public function searchSwitch(Request $request)
    {
    if($request->ajax())
    {
    $output="";
    // search criteria
    $switch= DB::table('switch')
    ->where('id','LIKE','%'.$request->search."%")
    ->orWhere('ipAddr','LIKE','%'.$request->search."%")
    ->orWhere('portsNum','LIKE','%'.$request->search."%")
    ->orWhere('cabName','LIKE','%'.$request->search."%")
    ->get();
    // just a variable to store classes of td opening tag
    $attr = '<td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">';
    if($switch)
    {
    foreach ($switch as $key => $switch) {
    $output.='<tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">'.
    $attr.$switch->id.'</td>'.
    $attr.$switch->ipAddr.'</td>'.
    $attr.$switch->portsNum.'</td>'.
    $attr.$switch->cabName.'</td>'.
    '<td class="px-4 py-4 text-right flex">'
    .'<a href="#" class="m-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>'
    .'<a data-id="'.$switch->id.'" data-method="DELETE" href="'.route('deleteSwitch', $switch->id).'" id="delete" class="m-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>'
    .'</td>'.
    '</tr>';
}
    return Response($output);
       }
       }
    }

    // controller end
}
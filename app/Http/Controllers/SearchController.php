<?php

namespace App\Http\Controllers;

use App\Models\equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchequipment(Request $request)
    {
    if($request->ajax())
    {
    $output="";
    $equipment= DB::table('equipment')
    ->where('name','LIKE','%'.$request->search."%")
    ->get();
    $attr = '<td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">';
    if($equipment)
    {
    foreach ($equipment as $key => $equipment) {
    $output.='<tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">'.
    $attr.$equipment->name.'</td>'.
    $attr.$equipment->SN.'</td>'.
    $attr.$equipment->supplier.'</td>'.
    $attr.$equipment->mainIpAddr.'</td>'.
    $attr.$equipment->port.'</td>'.
    $attr.$equipment->switch.'</td>'.
    $attr.$equipment->line.'</td>'.
    $attr.$equipment->type.'</td>'.
    $attr.$equipment->description.'</td>'.
    // '<td class="px-6 py-4 text-right">
    // <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
    // </td>'.
    '</tr>';
}
    return Response($output);
       }
       }
    }


    public function searchEquipments(Request $request)
    {
    if($request->ajax())
    {
    $output="";
    $equipment= DB::table('equipment')
    ->where('name','LIKE','%'.$request->search."%")
    ->get();
    $attr = '<td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">';
    if($equipment)
    {
    foreach ($equipment as $key => $equipment) {
    $output.='<tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">'.
    $attr.$equipment->name.'</td>'.
    $attr.$equipment->SN.'</td>'.
    $attr.$equipment->supplier.'</td>'.
    $attr.$equipment->mainIpAddr.'</td>'.
    $attr.$equipment->port.'</td>'.
    $attr.$equipment->switch.'</td>'.
    $attr.$equipment->line.'</td>'.
    $attr.$equipment->type.'</td>'.
    $attr.$equipment->description.'</td>'.
    // '<td class="px-6 py-4 text-right">
    // <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
    // </td>'.
    '</tr>';
}
    return Response($output);
       }
       }
    }
   
}

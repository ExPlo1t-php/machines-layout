<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
    return view('pages.search');
    }

    public function search(Request $request)
    {
    if($request->ajax())
    {
    $output="";
    $station= DB::table('station')
    ->where('name','LIKE','%'.$request->search."%")
    ->get();
    if($station)
    {
    foreach ($station as $key => $station) {
    $output.='<tr>'.
    '<td>'.$station->name.'</td>'.
    '<td>'.$station->SN.'</td>'.
    '<td>'.$station->supplier.'</td>'.
    '<td>'.$station->mainIpAddr.'</td>'.
    '<td>'.$station->port.'</td>'.
    '<td>'.$station->description.'</td>'.
    '<td>'.$station->switch.'</td>'.
    '<td>'.$station->line.'</td>'.
    '</tr>';
    }
    return Response($output);
       }
       }
    }
    // public function search(Request $request)
    // {
    // if($request->ajax())
    // {
    // $output="";
    // $station= DB::table('station')->where('name','LIKE','%'.$request->search."%")->get();
    // if($station)
    // {
    // foreach ($station as $key => $station) {
    // $output.='<tr>'.
    // '<td>'.$station->name.'</td>'.
    // '<td>'.$station->SN.'</td>'.
    // '<td>'.$station->supplier.'</td>'.
    // '<td>'.$station->mainIpAddr.'</td>'.
    // '<td>'.$station->port.'</td>'.
    // '<td>'.$station->description.'</td>'.
    // '<td>'.$station->switch.'</td>'.
    // '<td>'.$station->line.'</td>'.
    // '</tr>';
    // }
    // return Response($output);
    //    }
    //    }
    // }

}

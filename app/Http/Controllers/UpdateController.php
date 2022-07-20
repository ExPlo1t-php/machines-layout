<?php

namespace App\Http\Controllers;

use App\Models\Line;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function showLine($name){
        $line = Line::get()->where('name', '=', $name);
        return view('components.forms.lineUpdate', ['line'=> $line]);

    }
    public function updateLine(Request $request, $name){
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $request->validate([
            'name' => 'required|max:20|unique:line',
            'description' => 'max:500',
         ]);
         // inserting validated data
         Line::where('name',$name)->update($input);
 
         return redirect('dashboard');
    }
}

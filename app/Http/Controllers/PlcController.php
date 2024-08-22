<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PlcController extends Controller
{
    public function getVariableData(Request $request, $id){
        $token = $request->session()->get('token');
        $api = env("API_IP");
        try{
            $response = Http::withHeaders([
                'Authorization' => "Bearer $token",
            ])->get("$api/api/v1/variables/{$id}");

            // Check if the response is successful
            if ($response->successful()) {
                $data = $response->json();
                // Return data to the view or as a JSON response
                return view('components/updateVariable', ['data' => $data, 'token'=>$token]);
            } else {
                // Handle non-successful responses
                return back()->withErrors(['error' => 'Failed to fetch data']);
            }
        } catch (\Exception $e) {
            // Handle exceptions
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PlcController extends Controller
{
    public function login(Request $request){
        $api = env("API_IP");

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $response = Http::post('http://172.30.125.81:8080/api/v1/auth/login', [
            'email' => $email,
            'password' => $password,
        ]);
        if ($response->successful()) {
            session()->put('loggedIn', true);
            session()->put('token', $response->json()['token']);
            session()->put('role', $response->json()['role']);
            // Process successful response
            return response()->json(['message' => 'Login successful', 'data' => $response->json()]);
        } else {
            session()->put('loggedIn', false);
            // Handle error response
            return response()->json(['message' => 'Login failed', 'error' => $response->json()], $response->status());
        }
    }

    public function logout(){
        session()->forget(['token', 'role']);
        session()->put('loggedIn', false);
    }

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

    public function show(){
        $token = session()->get('token');
        $loggedIn = session()->get('loggedIn');
        $role = session()->get('role');
        $api = env("API_IP");
        // Return the lines data as JSON
        return view('pages.plcRecords', ['api' => $api, 'token'=>$token, 'loggedIn'=>$loggedIn, 'role'=>$role]);
    }

    public function viewTraceability(Request $request, $id){
        $token = session()->get('token');
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');

        return view('pages.traceability', ['startDate'=>$startDate, 'endDate'=>$endDate, 'id'=>$id, 'token'=>$token]);
    }

    public function setTrackingValue(Request $request, $id){
        session()->put('tracking', $request->tracking);
        $trackingVal = session()->get('tacking');
        return response()->json(['tracking', $trackingVal]);
    }
}
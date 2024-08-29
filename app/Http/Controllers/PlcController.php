<?php

namespace App\Http\Controllers;

use App\Models\PUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
class PlcController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $response = Http::post("http://varmoxan18:2024/api/v1/auth/login", [
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
        try{
            $response = Http::withHeaders([
                'Authorization' => "Bearer $token",
            ])->get("http://varmoxan18:2024/api/v1/variables/{$id}");

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
    
    public function showPlcUsers(){
        $users = PUser::paginate(7);
        return view('plcUsers', ['users'=>$users]);
    }
    
    public function addPlcUser(Request $request){
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        PUser::create([
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/plcUsers');
    }

    public function showPlcUser($id){
        $user = PUser::where('id', '=', $id)->get();
        return view('components.forms.plcUser', ['user'=>$user]);
    }

    public function editPlcUser(Request $request, $id){
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $request->validate([
             'email' => ['required', 'string', 'email', 'max:255', Rule::unique('pgsql.app_users')->ignore($id)],
             'role' => ['required', 'string', 'max:255'],
             'password' => ['string', 'nullable', 'confirmed', Rules\Password::defaults()],
            ]);
            // inserting validated data
        // checking if the user entered current/new password
        if($request->password && $request->password_confirmation){
            // if new password = new password repeat
            // update the db record
            PUser::where('id',$id)->update([
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password_confirmation),
            ]);
            return redirect('plcUsers')->with('success','Plc User details and password changed successfully!');;
        }else{
            PUser::where('id',$id)->update([
                'email' => $request->email,
                'role' => $request->role,
            ]);
            return redirect('plcUsers')->with('success','Plc User details changed successfully!');;
        }

    }

    public function deletePlcUser($id){
        $user = PUser::where('id','=',$id);
        $user->delete();
    }
}
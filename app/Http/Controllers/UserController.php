<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showUsers(){
        // shows all the users in the table
        $users = User::paginate(7);
        return view('index', ['users'=>$users]); 
      }

    //   show a specific user preparing for edit
    public function showUser($id){
        $user = User::where('id', '=', $id)->get();
        return view('components.forms.user', ['user'=>$user]);
    }

    public function editUser(Request $request, $id){
         // fetching input data
         $input = $request->except('_token', 'update');
         // validating input data
         $request->validate([
             'name' => ['required','max:20', Rule::unique('users')->ignore($id)],
             'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
             'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            // inserting validated data
        $user = User::where('id', '=', $id)->get();
        // check if the input password match the record
        $hashCheck = Hash::check($request->currentPw, $user[0]->password);
        // checking if the user entered current/new password
        if($request->currentPw && $request->password && $request->password_confirmation){
            // if new password = new password repeat and current password match records
            // update the db record
            if($hashCheck){
                User::where('id',$id)->update([
                   'name' => $request->name,
                   'email' => $request->email,
                   'password' => Hash::make($request->password_confirmation),
                ]);
                return redirect('users')->with('success','User details and password changed successfully!');;
            }else{
                // in case the passwords didn't match return with an error message
                return redirect('users')->with('error','Passwords didn\'t match, nothing happened!');;
            }
        }else{
            User::where('id',$id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            return redirect('users')->with('success','User details changed successfully!');;
        }
 
    }

    public function deleteUser($id){
            $user = User::where('id','=',$id);
            $user->delete();
    }

    public function addUser(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));

        return redirect('/users');
    }
}

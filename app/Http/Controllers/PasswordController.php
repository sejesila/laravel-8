<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    //
    public function changePassword(){
        return view('admin.body.changepass');
    }
    public function updatePassword(Request $request){
        $validate = $request->validate([
            'current_password'=> 'required',
            'password'=>'required|confirmed'
        ]);
        $hashedPass = Auth::user()->password;
        if (Hash::check($request->current_password,$hashedPass)){
            $user= User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success','Password changed successfully');


        }
        else{
            return redirect()->back()->with('error','Current password invalid');
        }

    }
}

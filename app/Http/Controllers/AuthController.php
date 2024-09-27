<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function ShowRegistrationForm(){
        return view ('auth.register');
    }


    public function Register(Request $request){
        $request->validate([

            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' =>'required|string|min:8|confirmed'
        ]);
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),

        ]);
        session(['user_id'=>$user->id]);
        return redirect()->route('dashboard')->with('success', 'Registration completed Successfully!');
    }


    public function DashboardIndex()
    {
    
        $userId = session('user_id');
        if ($userId) {
            $user = User::find($userId); 
            $file_data = File::where('user_id', $userId)->get();
            if ($file_data->isEmpty()) {
                $file_data = null; 
            }
        } else {
            return redirect()->route('login')->with('error', 'User not logged in.');
        }

        return view('dashboard', compact('user','file_data'));
    }


    public function ShowLoginForm(){
        return view ('auth.login');
    }



    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' =>'required|string|min:8'
        ]);

        $user = User::where('email',$request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session(['user_id' => $user->id]);
            return redirect()->route('dashboard')->with('success', 'Logged in Successfully!');
        }
       
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }


    
    public function logout(Request $request){
        session()->forget('user_id');
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }


}

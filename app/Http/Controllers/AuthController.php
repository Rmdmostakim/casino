<?php

namespace App\Http\Controllers;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function UserLogin(Request $request){

        $validated = $request->validate([
            'username' => 'bail|required|exists:users',
            'password'=> 'bail|required|min:8',
        ]);

        if($request->exists('remember')){
            if(\UserAuth::attempt(['username' => $request->username, 'password' => $request->password],$request->remember)){
                return redirect('user/dashboard');
            }
        }
        if(\UserAuth::attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect('user/dashboard');
        }
        return redirect('/login')->with('error', 'Something went wrong ! Try again.');
    }

    public function UserReg(Request $request){
        $validated = $request->validate([
            'fname' => 'bail|required|min:10|max:50',
            'username' => 'bail|required|unique:users|min:5|max:50',
            'phone' => 'bail|required|min:7|max:20',
            'email' => 'bail|required|unique:users|email',
            'password'=> 'required|string|min:8|confirmed',
            'password_confirm'=>'same:password|min:8'
        ]);

        if(
            \UserAuth::create([
                'fname'=>$request->fname,
                'username'=>$request->username,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'password'=>\Hash::make($request->password),
                'country'=>Location::get($request->ip())->countryName,
                'user_id'=> \Str::random(16),
                ])
        ){
            if(\UserAuth::attempt(['username' => $request->username, 'password' => $request->password])){
                return redirect()->route('user.dashboard');
            }
            return redirect()->route('user.login');
        }
        return redirect()->route('user.reg')->with('error', 'Something went wrong ! Try again.');
    }
    
    public function resetPassword(Request $request){
        $validated = $request->validate([
            'email' => 'bail|required|exists:users|email',
            'password'=> 'required|string|min:8|confirmed',
            'password_confirm'=>'same:password|min:8'
        ]);

        if( User::where('email',$request->email)->update(['password'=>\Hash::make($request->password)]) ){
            return redirect()->route('sign-in')->with('success','Password reset success login with new password');
        }
        return redirect()->back()->with('error','Something went wrong try again later');
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
    
}

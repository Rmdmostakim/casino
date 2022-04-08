<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class SuperAdminController extends Controller
{
    public function superadminCofirmation(Request $request){
        $validated = $request->validate([
            'email' => 'bail|required|email',
            'password'=> 'bail|required|string|min:8',
        ]);

        if(\AdminAuth::superAdminAttempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('superadmin.dashboard');
        }
        return redirect()->route('superadmin.login')->with('error','Something went wrong! Try again');
    }

    public function addnewAdmin(Request $request){ 
        $validated = $request->validate([
            'admin_name' => 'bail|required|string|min:5|unique:admin',
            'admin_phone' => 'bail|required|string|min:11|unique:admin',
            'admin_email' => 'bail|required|email|unique:admin',
            'admin_type'=>'bail|required',
            'password'=> 'required|string|min:8',
            'password_confirm'=>'same:password|min:8',
        ]);

        if( $request->admin_type == 'admin' || $request->admin_type == 'staff' ){
            $result = Admin::create([
                'admin_id'=> \Str::random(8),
                'admin_type'=> $request->admin_type,
                'admin_name'=> $request->admin_name,
                'admin_email'=>$request->admin_email,
                'admin_phone'=>$request->admin_phone,
                'password'=>   \Hash::make($request->password),
                'status'=>      1,
            ]);

            if( $result ){
                return redirect()->route('superadmin.dashboard')->with('success','Admin created succesfully');
            }
            return redirect()->route('superadmin.newadmin')->with('error','Something went wrong! Try again');
        }
        return redirect()->route('superadmin.newadmin')->with('error','Select admin type');    
    }

    public function adminDelete($admin_id){

        try {
            $admin_id   = \Crypt::decryptString($admin_id);
            $admin_data = \AdminAuth::getSpecificAdmin($admin_id);
            if(\AdminAuth::deleteAdmin($admin_id)){
                return redirect()->route('superadmin.dashboard')->with('success',$admin_data->admin_name.' deleted successfully');
            }
        } catch (DecryptException $e) {
            return redirect()->route('superadmin.dashboard')->with('error','Admin is not deleted');
        }
        return redirect()->route('superadmin.dashboard')->with('error','Something went wrong! Try again');

    }
    
    public function cacheClear(){
        $config = \Artisan::call('config:cache');
        $route  = \Artisan::call('route:cache');
        $view   = \Artisan::call('view:cache');

        if($config==0 && $route==0 && $view==0){
            return redirect()->back()->with('success','System Cleared');
        }
        return redirect()->back()->with('error','Try again');
    }
    
}

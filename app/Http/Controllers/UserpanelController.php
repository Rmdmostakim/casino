<?php

namespace App\Http\Controllers;

use App\Models\BalanceTransfer;
use App\Models\User;
use App\Models\TransferMethod;
use Illuminate\Http\Request;
class UserpanelController extends Controller
{
    public function deposit(Request $request){
        $validated = $request->validate([
            'transfer_number'=>'bail|required|min:8',
            'method_name'=> 'bail|required|exists:transfer_method',
            'transection_id'=> 'bail|required|min:8',
            'balance_amount'=>'bail|required|numeric|gt:0',

        ]);

        $result = BalanceTransfer::create([
            'user_id'=>\UserAuth::user_id(),
            'balance_type'=>'deposit',
            'transfer_method'=>$request->method_name,
            'transfer_number'=>$request->transfer_number,
            'transection_id'=>$request->transection_id,
            'balance_amount'=>$request->balance_amount,
            'uc_amount'=> \UserAuth::currencyConverter($request->method_name,$request->balance_amount),
            'status'=>0,
        ]);
        if($result){
            return redirect()->route('deposit')->with('success', 'Deposit Request send successfully. Wait for confirmation ');
        }else{
            return redirect()->route('deposit')->with('error', 'Something went wrong ! Try again.');
        }
    }

    public function withdraw(Request $request){
        $validated = $request->validate([
            'transfer_number'=>'bail|required|min:8',
            'method_name'=> 'bail|required|exists:transfer_method',
            'balance_amount'=>'bail|required|numeric|gt:0',

        ]);

        if( \UserAuth::currencyConverter($request->method_name,$request->balance_amount)<= \UserAuth::ucBalance()){
            $result = BalanceTransfer::create([
                'user_id'=>\UserAuth::user_id(),
                'balance_type'=>'withdraw',
                'transfer_method'=>$request->method_name,
                'transfer_number'=>$request->transfer_number,
                'balance_amount'=>$request->balance_amount,
                'uc_amount'=> \UserAuth::currencyConverter($request->method_name,$request->balance_amount),
                'status'=>0,
            ]);
            if($result){
                return redirect()->route('withdraw')->with('success', 'Withdraw Request send successfully. Wait for confirmation ');
            }else{
                return redirect()->route('withdraw')->with('error', 'Something went wrong ! Try again.');
            }
        }
        return redirect()->route('withdraw')->with('error', 'You have not enough balance ! Try again.');
    }

    public function profileUpdate(Request $request){
        $validated = $request->validate([
            'avatar'=>'bail|image|max:512',
            'fname'=> 'bail|required|string|min:10|max:50',
            'username'=>'bail|required|string|min:5|max:50',
            'phone' => 'bail|required|min:7|max:20',
        ]);

        if($request->hasFile('avatar')){
            $avatar = \UserAuth::avatar();
            if($avatar != '/images/avatar.png'){
                \File::delete($avatar);
            }

            $img = $request->file('avatar');
            $imgName = \Str::random(30).'.'.$img->extension();
            $imgPath = $img->move('public/images',$imgName);
            $imgPath = \Str::replace('\\', '/', $imgPath);
            
            if(\UserAuth::profileUpdate($request->fname,$request->username,$request->phone,$imgPath)){
                return redirect()->route('user.profile')->with('success','Profile updated.');
            }
            return redirect()->route('user.profile')->with('error','Something went wrong ! Please try agains.');      
        }else{
            $avatar = \UserAuth::avatar();
            if($avatar != '/images/avatar.png'){
                if(\UserAuth::profileUpdate($request->fname,$request->username,$request->phone,$avatar)){
                    return redirect()->route('user.profile')->with('success','Profile updated.');
                }
                return redirect()->route('user.profile')->with('error','Something went wrong ! Please try agains.');
            }
            if(\UserAuth::profileUpdate($request->fname,$request->username,$request->phone,$request->email,$avatar='')){
                return redirect()->route('user.profile')->with('success','Profile updated.');
            }
            return redirect()->route('user.profile')->with('error','Something went wrong ! Please try agains.');
            
        }
    }
    /********* */

    public function passwordReset(Request $request){
        $validated = $request->validate([
            'password'=>'bail|required|string|min:8',
            'new_password'=> 'bail|required|string|min:8',
            'new_password_confirm'=>'bail|required|string|min:8'
        ]);

        if( $request->new_password == $request->new_password_confirm ){
            $user = User::where('user_id','=',\UserAuth::user_id())->first();
            $user = \Hash::check($request->password, $user->password);
            if($user){
                $result = User::where('user_id','=',\UserAuth::user_id())
                        ->update(['password' => \Hash::make($request->new_password)]);
                if($result){
                    return redirect()->route('change.password')->with('success', 'Password reset confirmed.');
                }
                return redirect()->route('change.password')->with('error', 'Something went wrong ! Try again.');
            }
            return redirect()->route('change.password')->with('error', 'Current password is wrong ! Try again.');
        }
        return redirect()->route('change.password')->with('not-matched', 'New password is not confirmed.');
    }

    public function currencyConverter(Request $request){
        $method_name    = $request->method_name;
        $balance_amount = $request->balance_amount;
        return \UserAuth::currencyConverter($method_name,$balance_amount);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DepositeEvent;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\GameRate;
class AdminController extends Controller
{
    public function adminConfirmation(Request $request){
        $validated = $request->validate([
            'admin_email' => 'bail|required|email|exists:admin',
            'password'=> 'bail|required|string|min:8',
        ]);

        if($request->exists('remember')){
            if(\AdminAuth::attempt(['admin_email' => $request->admin_email, 'password' => $request->password],$request->remember)){
                return redirect()->route('admin.dashboard');
            }
        }
        if(\AdminAuth::attempt(['admin_email' => $request->admin_email, 'password' => $request->password])){
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->with('error', 'Something went wrong ! Try again.');
    }

    public function depositConfirmation($depositID){
        $balanceTransfer_id =  \Crypt::decryptString($depositID);
        if( \AdminAuth::depositConfirmation($balanceTransfer_id) ){
            return redirect()->back()->with('success','Deposit Confirm');
        }
        return redirect()->back()->with('error','Deposit Failed');
    }

    public function depositRejection($depositID){
        $balanceTransfer_id =  \Crypt::decryptString($depositID);
        if( \AdminAuth::depositRejection($balanceTransfer_id) ){
            return redirect()->back()->with('success','Deposit rejected');
        }
        return redirect()->back()->with('error','Deposit rejected failed');
    }

    public function pullWithrawrequest($withdrawID){
        $balanceTransfer_id = \Crypt::decryptString($withdrawID);
        $withdraw           = \AdminAuth::pullWithdraw($balanceTransfer_id);
        return view('AdminpanelPages.Withdrawconfirm',compact('withdraw'));
    }

    public function confirmWithdraw(Request $request){
        $validated = $request->validate([
            'transection_id' => 'bail|required|min:8',
            'withdrawId'=> 'bail|required|min:32',
        ]);
        $balanceTransfer_id = \Crypt::decryptString($request->withdrawId);
        $transection_id     = $request->transection_id;

        if( \AdminAuth::withdrawConfirmation($balanceTransfer_id,$transection_id) ){
            return redirect()->route('admin.withdrawrequest')->with('success','Withdraw confirmed');
        }
        return redirect()->route('admin.withdrawrequest')->with('error','Withdraw rejected');
    }

    public function withdrawRejection($depositID){
        $balanceTransfer_id =  \Crypt::decryptString($depositID);
        if( \AdminAuth::withdrawRejection($balanceTransfer_id) ){
            return redirect()->back()->with('success','Withdraw rejected');
        }
        return redirect()->back()->with('error','Withdraw rejected failed');
    }

    public function passwordReset(Request $request){
        $validated = $request->validate([
            'password'=>'bail|required|string|min:8',
            'new_password'=> 'bail|required|string|min:8',
            'new_password_confirm'=>'bail|required|string|min:8',
        ]);

        if( $request->new_password == $request->new_password_confirm ){
            if( \AdminAuth::passwordReset($request->password,$request->new_password) ){
                return redirect()->back()->with('success', 'Password changed.');
            }
            return redirect()->back()->with('error', 'Current password invalid.');
        }
        return redirect()->route('change.password')->with('not-matched', 'New password is not confirmed.');
    }

    public function profileUpdate(Request $request){
        $validated = $request->validate([
            'admin_name'=>'bail|required|string|min:5',
            'admin_phone'=> 'bail|required|string|min:11',
            'avatar'=>'bail|image|max:512',
        ]);

        if($request->hasFile('avatar')){
            $avatar = \AdminAuth::avatar();
            if($avatar != '/images/avatar.png'){
                \File::delete($avatar);
            }

            $img = $request->file('avatar');
            $imgName = \Str::random(30).'.'.$img->extension();
            $imgPath = $img->move('public/images',$imgName);
            $imgPath = \Str::replace('\\', '/', $imgPath);

            if(\AdminAuth::profileUpdate($request->admin_name,$request->admin_phone,$imgPath)){
                return redirect()->back()->with('success','Profile updated.');
            }
            return redirect()->back()->with('error','Something went wrong ! Please try agains.');
        }else{
            $avatar = \AdminAuth::avatar();
            if($avatar != '/images/avatar.png'){
                if(\AdminAuth::profileUpdate($request->admin_name,$request->admin_phone,$avatar)){
                    return redirect()->back()->with('success','Profile updated.');
                }
                return redirect()->back()->with('error','Something went wrong ! Please try agains.');
            }
            if(\AdminAuth::profileUpdate($request->admin_name,$request->admin_phone,$avatar='')){
                return redirect()->back()->with('success','Profile updated.');
            }
            return redirect()->back()->with('error','Something went wrong ! Please try agains.');
        }
    }

    public function addnewAdmin(Request $request){
        if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin'){
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
                    return redirect()->back()->with('success','Admin created succesfully');
                }
                return redirect()->back()->with('error','Something went wrong! Try again');
            }
            return redirect()->back()->with('error','Select admin type');
        }
        return redirect()->back();
    }

    public function staffDelete($staffId){
        if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin'){
            $staffId = \Crypt::decryptString($staffId);
            if(\AdminAuth::deleteAdmin($staffId)){
                return redirect()->back()->with('success','Staff deleted');
            }
            return redirect()->back()->with('error','Can not delete at this moment');
        }
        return redirect()->back();
    }

    public function updateRate(Request $request){
        if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin'){
            $validated = $request->validate([
                'evenodd' => 'bail|required|numeric',
                'headtail' => 'bail|required|numeric',
                'kingqueen' => 'bail|required|numeric',
                'spinwin' => 'bail|required|numeric',
                'roulette' => 'bail|required|numeric',
                'choosecard' => 'bail|required|numeric',
            ]);

            $games = [
                [
                    'game_name'=>'even&odd',
                    'game_rate'=>$request->evenodd,
                    'status'=>1
                ],
                [
                    'game_name'=>'head&tail',
                    'game_rate'=>$request->headtail,
                    'status'=>1
                ],
                [
                    'game_name'=>'king&queen',
                    'game_rate'=>$request->kingqueen,
                    'status'=>1
                ],
                [
                    'game_name'=>'spin&win',
                    'game_rate'=>$request->spinwin,
                    'status'=>1
                ],
                [
                    'game_name'=>'roulette',
                    'game_rate'=>$request->roulette,
                    'status'=>1
                ],
                [
                    'game_name'=>'choosecard',
                    'game_rate'=>$request->choosecard,
                    'status'=>1
                ]
            ];

            $result = GameRate::upsert($games,['game_name'],['game_rate']);
            if($result){
                return redirect()->back()->with('success','Game rate updated');
            }
            return redirect()->back()->with('error','Game rate update failed');
        }
        return redirect()->back();
    }

    public function addMethod(Request $request){
        if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin'){
            $validated = $request->validate([
                'method_name'=>'bail|required|string|min:4',
                'trx_number'=> 'bail|required|string|min:8',
                'exchange_rate'=>'bail|required|numeric|min:1',
            ]);
            $credential = ['method_name'=>$request->method_name,'trx_number'=>$request->trx_number,'exchange_rate'=>$request->exchange_rate,'status'=>1];
            if(\AdminAuth::addMethod($credential)){
                return redirect()->back()->with('success','Method added successfully');
            }
            return redirect()->back()->with('error','Method add failed');
        }
        return redirect()->back();

    }

    public function editMethodView($method_id){
        if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin'){
            $method_id = \Crypt::decryptString($method_id);
            $method    = \AdminAuth::getspecificMethod($method_id);
            if(!is_null($method)){
                return view('AdminpanelPages.Edittransfermethod',compact('method'));
            }
            return redirect()->back()->with('error','You have selected wrong method');
        }
        return redirect()->back();
    }

    public function confirmeditMethod(Request $request){
        if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin'){
            $validated = $request->validate([
                'trx_number'=> 'bail|required|string|min:8',
                'exchange_rate'=>'bail|required|numeric|min:1',
            ]);
    
            $method_id = \Crypt::decryptString($request->methodId);
            if(\AdminAuth::updateMethod($method_id,$request->trx_number,$request->exchange_rate)){
                return redirect()->route('admin.gamesetting')->with('success','Method updated successfully');
            }
            return redirect()->route('admin.gamesetting')->with('error','Method update failed');
        }
        return redirect()->back();
    }

    public function deactivatedMethod($method_id){
        if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin'){
            $method_id = \Crypt::decryptString($method_id);
            if(\AdminAuth::deactivatedMethod($method_id)){
                return redirect()->back()->with('success','Method deactivated successfully');
            }
            return redirect()->back()->with('error','Method deactivation failed');
        }
        return redirect()->back();
    }

    public function activeMethod($method_id){
        if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin'){
            $method_id = \Crypt::decryptString($method_id);
            if(\AdminAuth::deactivatedMethod($method_id)){
                return redirect()->back()->with('success','Method activated successfully');
            }
            return redirect()->back()->with('error','Method activation failed');
        }
        return redirect()->back();
    }

    public function addoffer(Request $request){
        if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin'){
            $validated = $request->validate([
                'offer'=>'bail|required|numeric|min:1',
            ]);
            DepositeEvent::query()->update(['status' => 0]);
            if( DepositeEvent::create(['event'=>$request->offer,'status'=>1])){
                return redirect()->back()->with('success','Deposit offer added successfully');
            }
            return redirect()->back()->with('error','Deposit offer failed');
        }
        return redirect()->back();
    }
    
    public function allClear(){
		$cache  = \Artisan::call('cache:clear');
        $config = \Artisan::call('config:clear');
        $route  = \Artisan::call('route:clear');
        $view   = \Artisan::call('view:clear');

        if($cache==0 && $config==0 && $route==0 && $view==0){
            return redirect()->back()->with('success','System Cleared');
        }
        return redirect()->back()->with('error','Try again');
	}
	
	public function optimize(){
        $config = \Artisan::call('config:cache');
        $route  = \Artisan::call('route:cache');
        $view   = \Artisan::call('view:cache');

        if($config==0 && $route==0 && $view==0){
            return redirect()->back()->with('success','System Cleared');
        }
        return redirect()->back()->with('error','Try again');
	}
}

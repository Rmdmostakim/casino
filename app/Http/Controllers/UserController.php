<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\UserProfileModel;
use App\Models\DepositModel;
use App\Models\WithdrawModel;
use App\Models\GamebalanceModel;
use App\Models\TransectionNumber;
class UserController extends Controller
{   
    private $currentBalance,$totalEarning,$winingRate,$pendingRequest,$profile,$name;

    public function UserHome(Request $request){
        
        $phone = $request->session()->get('user');
        $this->MenuData($phone);

        $bkash = TransectionNumber::where(['type'=>"Bkash"])->get('number')->last();
        $rocket = TransectionNumber::where(['type'=>"Rocket"])->get('number')->last();
        $nagad = TransectionNumber::where(['type'=>"Nagad"])->get('number')->last();

        return view('userPages.Home',['balance'=>$this->currentBalance,'earning'=>$this->totalEarning,'wining'=>$this->winingRate,
        'request'=>$this->pendingRequest,'profile'=>$this->profile,'name'=>$this->name,'bkash'=>$bkash['number'],'rocket'=>$rocket['number'],'nagad'=>$nagad['number']]);

    }

    public function WithDraw(Request $request){
        $email = $request->session()->get('user');
        $this->MenuData($email);
        return view('userPages.withdraw',['balance'=>$this->currentBalance,'earning'=>$this->totalEarning,'wining'=>$this->winingRate,
        'request'=>$this->pendingRequest,'profile'=>$this->profile,'name'=>$this->name]);
    }

    public function DepositTable(Request $request){
        $phone = $request->session()->get('user');
        $this->MenuData($phone);
        $deposit = DepositModel::where(['user_phone'=>$phone])->orderBy('id', 'desc')->get();
        
        $bkash = TransectionNumber::where(['type'=>"Bkash"])->get('number')->last();
        $rocket = TransectionNumber::where(['type'=>"Rocket"])->get('number')->last();
        $nagad = TransectionNumber::where(['type'=>"Nagad"])->get('number')->last();

        return view('userPages.depositSummary',['balance'=>$this->currentBalance,'earning'=>$this->totalEarning,'wining'=>$this->winingRate,
        'request'=>$this->pendingRequest,'profile'=>$this->profile,'name'=>$this->name,'deposit'=>$deposit,'bkash'=>$bkash['number'],'rocket'=>$rocket['number'],'nagad'=>$nagad['number']]);
    }

    public function WithdrawTable(Request $request){
        $phone = $request->session()->get('user');
        $this->MenuData($phone);
        $withdraw = WithdrawModel::where(['user_phone'=>$phone])->orderBy('id', 'desc')->get();
        
        return view('userPages.withdrawSummary',['balance'=>$this->currentBalance,'earning'=>$this->totalEarning,'wining'=>$this->winingRate,
        'request'=>$this->pendingRequest,'profile'=>$this->profile,'name'=>$this->name,'withdraw'=>$withdraw]);
    }

    public function GameBalance(Request $request){
        $phone = $request->session()->get('user');
        $this->MenuData($phone);
        $gamebalance = GamebalanceModel::where(['user_phone'=>$phone])->orderBy('id', 'desc')->get();
        
        return view('userPages.gamebalance',['balance'=>$this->currentBalance,'earning'=>$this->totalEarning,'wining'=>$this->winingRate,
        'request'=>$this->pendingRequest,'profile'=>$this->profile,'name'=>$this->name,'gamebalance'=>$gamebalance]);
    }

    public function PendingRequest(Request $request){
        $phone = $request->session()->get('user');
        $this->MenuData($phone);

        $deposit  = DepositModel::where(['user_phone'=>$phone,'status'=>0])->get();
        $withdraw = WithdrawModel::where(['user_phone'=>$phone,'status'=>0])->get();

        return view('userPages.PendingRequest',['balance'=>$this->currentBalance,'earning'=>$this->totalEarning,'wining'=>$this->winingRate,
        'request'=>$this->pendingRequest,'profile'=>$this->profile,'name'=>$this->name,'deposit'=>$deposit,'withdraw'=>$withdraw]);
    }

    public function CurrentBalance($phone){
        $deposit  = DepositModel::where(['user_phone'=>$phone,'status'=>1])->sum('amount');
        $withdraw = WithdrawModel::where(['user_phone'=>$phone,'status'=>1])->sum('amount');
        $won      = GamebalanceModel::where(['user_phone'=>$phone,'status'=>1])->sum('amount');
        $lost     = GamebalanceModel::where(['user_phone'=>$phone,'status'=>0])->sum('amount');
        
        $this->currentBalance = $deposit+$won-$lost-$withdraw;
        return $this->currentBalance;
    }

    public function TotalPendingRequest($phone){
        $deposit  = DepositModel::where(['user_phone'=>$phone,'status'=>0])->count();
        $withdraw = WithdrawModel::where(['user_phone'=>$phone,'status'=>0])->count();

        $this->pendingRequest = $deposit+$withdraw;
        return $this->pendingRequest;
    }

    public function WiningRate($phone){
        $won      = GamebalanceModel::where(['user_phone'=>$phone,'status'=>1])->count();
        $lost     = GamebalanceModel::where(['user_phone'=>$phone,'status'=>0])->count();
        if($won>0){
            $rate = ($won*100)/($won+$lost);
            $rate = round($rate, 2);
            $this->winingRate = $rate;
        }else{
            $this->winingRate = 0;
        }
        return $this->winingRate;
          
    }

    public function TotalEarning($phone){
        $this->totalEarning = GamebalanceModel::where(['user_phone'=>$phone,'status'=>1])->sum('amount');
        return $this->totalEarning;
    }

    public function Profile($phone){
        $name = UserModel::where('user_phone','=',$phone)->value('name');
        $this->name = $name;
        $this->profile = "DefaultUserProfile.png";
    }

    public function MenuData($phone){
        $this->CurrentBalance($phone);
        $this->TotalPendingRequest($phone);
        $this->WiningRate($phone);
        $this->TotalEarning($phone);
        $this->Profile($phone);
    }

    public function Deposit(Request $request){
        
        $user_phone  = $request->session()->get('user');
        $deposit_phone  = $request->input('phone');
        $trxid  = $request->input('trxid');
        $amount = $request->input('amount');
        $method = $request->input('method');

        date_default_timezone_set("Asia/Dhaka");
        $time   = date("h:i:sa");
        $date   = date("Y/m/d");
        if($amount>=300){
            $result = DepositModel::insert(['user_phone'=>$user_phone,'deposit_number'=>$deposit_phone,'trxid'=>$trxid,'amount'=>$amount,'paymentmethod'=>$method,'time'=>$time,'date'=>$date,'status'=>0]);
            if($result == true){
                return true;
            }
        }    
        return false;
    }

    public function WithdrawRequest(Request $request){
        $user_phone  = $request->session()->get('user');
        $withdraw_number  = $request->input('phone');
        $amount = $request->input('amount');
        $method = $request->input('method');

        date_default_timezone_set("Asia/Dhaka");
        $time   = date("h:i:sa");
        $date   = date("Y/m/d");

        $this->CurrentBalance($user_phone);
        if($this->currentBalance>(int)$amount && (int)$amount>=500){
            $pending = WithdrawModel::where(['user_phone'=>$user_phone,'status'=>0])->count();
            if($pending == 0){
                $result = WithdrawModel::insert(['user_phone'=>$user_phone,'withdraw_number'=>$withdraw_number,'trxid'=>'','amount'=>$amount,'paymentmethod'=>$method,'time'=>$time,'date'=>$date,'status'=>0]);
                if($result == true){
                    return true;
                }
            }  
        }
        return false; 
    }

    public function UserLoginConfirm(Request $request){       
        $phone    = $request->input('UserPhone');
        $password = md5($request->input('UserPass'));
        
        $result = UserModel::where(['user_phone'=>$phone,'password'=>$password])->count();
        if($result == 1){
            $request->session()->put('user',$phone);
            return true;   
        }else{
            false;
        }
    }

    public function UserRegConfirm(Request $request){
        $name  = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $pass  = md5($request->input('password'));

        if(empty($email)){
            $email = "null";
        }
        $status = UserModel::where(['user_phone'=>$phone])->count();
        if($status == 0){
            $result = UserModel::insert(['email'=>$email,'user_phone'=>$phone,'name'=>$name,'password'=>$pass]);
            if($result){
                $request->session()->put('user',$phone);
                return true;   
            }  
        }else{
            return false;
        }

    }

    public function Logout(Request $request){
        $request->session()->forget('user');
        return redirect('/login');
    }

}

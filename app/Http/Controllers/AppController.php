<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\UserProfileModel;
use App\Models\BetModel;
use App\Models\AdminModel;
use App\Models\DepositModel;
use App\Models\WithdrawModel;
use App\Models\GamebalanceModel;
class AppController extends Controller
{   
    private $LoginStatus=false,$profile,$currentBalance;
    public function Home(Request $request){
        if($request->session()->has('user')){
            $user_phone   = $request->session()->get('user');
            $this->LoginStatusCheck($user_phone);
            $this->CurrentBalance($user_phone);
        }
        return view('sitePages.Home',['LoginStatus'=>$this->LoginStatus,'profile'=>$this->profile,'balance'=>$this->currentBalance]);
    }

    public function HeadTailsPage(Request $request){
        if($request->session()->has('user')){
            $user_phone   = $request->session()->get('user');
            $this->LoginStatusCheck($user_phone);
            $this->CurrentBalance($user_phone);
        }
        $rate = $this->bettingRate("Head&Tails");
        return view('sitePages.HeadTailPage',['LoginStatus'=>$this->LoginStatus,'profile'=>$this->profile,'rate'=>$rate,'balance'=>$this->currentBalance]);
    }

    public function KingQueenPage(Request $request){
        if($request->session()->has('user')){
            $user_phone   = $request->session()->get('user');
            $this->LoginStatusCheck($user_phone);
            $this->CurrentBalance($user_phone);
        }
        $rate = $this->bettingRate("King&Queen");
        return view('sitePages.KingQueenPage',['LoginStatus'=>$this->LoginStatus,'profile'=>$this->profile,'rate'=>$rate,'balance'=>$this->currentBalance]);
    }

    public function EvenOddPage(Request $request){
        if($request->session()->has('user')){
            $user_phone   = $request->session()->get('user');
            $this->LoginStatusCheck($user_phone);
            $this->CurrentBalance($user_phone);
        }
        $rate = $this->bettingRate("Even&Odd");
        return view('sitePages.EvenOddPage',['LoginStatus'=>$this->LoginStatus,'profile'=>$this->profile,'rate'=>$rate,'balance'=>$this->currentBalance]);
    }

    public function SpinWinPage(Request $request){
        if($request->session()->has('user')){
            $user_phone   = $request->session()->get('user');
            $this->LoginStatusCheck($user_phone);
            $this->CurrentBalance($user_phone);
        }
        $rate = $this->bettingRate("Spin&Win");
        return view('sitePages.SpinWinPage',['LoginStatus'=>$this->LoginStatus,'profile'=>$this->profile,'rate'=>$rate,'balance'=>$this->currentBalance]);
    }

    public function ChooseCard(Request $request){
        if($request->session()->has('user')){
            $user_phone   = $request->session()->get('user');
            $this->LoginStatusCheck($user_phone);
            $this->CurrentBalance($user_phone);
        }
        $rate = $this->bettingRate("ChooseCard");
        return view('sitePages.ChooseAcardPage',['LoginStatus'=>$this->LoginStatus,'profile'=>$this->profile,'rate'=>$rate,'balance'=>$this->currentBalance]);
    }

    public function Roulette(Request $request){
        if($request->session()->has('user')){
            $user_phone   = $request->session()->get('user');
            $this->LoginStatusCheck($user_phone);
            $this->CurrentBalance($user_phone);
        }
        $rate = $this->bettingRate("RouletteTable");
        return view('sitePages.RoulettePage',['LoginStatus'=>$this->LoginStatus,'profile'=>$this->profile,'rate'=>$rate,'balance'=>$this->currentBalance]);
    }

    public function LoginPage(Request $request){
        if($request->session()->has('user')){
            $email   = $request->session()->get('user');
            $this->LoginStatusCheck($email);
        }
        return view('sitePages.LoginPage',['LoginStatus'=>$this->LoginStatus,'profile'=>$this->profile]);
    }

    public function RegPage(Request $request){
        if($request->session()->has('user')){
            $email   = $request->session()->get('user');
            $this->LoginStatusCheck($email);
        }
        return view('sitePages.RegPage',['LoginStatus'=>$this->LoginStatus,'profile'=>$this->profile]);
    }

    public function LoginStatusCheck($phone){
        $this->LoginStatus = true;
        $this->profile = "DefaultUserProfile.png";
    }

    public function bettingRate($gameName){
        $rate = BetModel::where('gamename','=',$gameName)->get('betrate')->last();
        $rate = $rate['betrate'];
        return $rate;
    }

    public function AdminLoginPage(){
        return view('adminPages.AdminLogin');
    }

    public function CurrentBalance($phone){
        $deposit  = DepositModel::where(['user_phone'=>$phone,'status'=>1])->sum('amount');
        $withdraw = WithdrawModel::where(['user_phone'=>$phone,'status'=>1])->sum('amount');
        $won      = GamebalanceModel::where(['user_phone'=>$phone,'status'=>1])->sum('amount');
        $lost     = GamebalanceModel::where(['user_phone'=>$phone,'status'=>0])->sum('amount');
        
        $this->currentBalance = $deposit+$won-$lost-$withdraw;
        return $this->currentBalance;
    }
}

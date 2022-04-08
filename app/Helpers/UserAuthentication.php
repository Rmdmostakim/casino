<?php
    namespace App\Helpers;
    use App\Models\UCBalance;
    use App\Models\User;
    use App\Models\BalanceTransfer;
    use App\Models\GameBalance;
    use App\Models\TransferMethod;

    class UserAuthentication{
        public function attempt(array $credenials,$remember=false){
            $user    = User::where('username', '=', $credenials['username'])->first();
            $matched = \Hash::check($credenials['password'], $user->password);
            if($matched){
                \Request::session()->put('user_id',$user->user_id);
                if($remember == 'on'){
                    \Cookie::queue('username', $credenials['username'],43200);
                    \Cookie::queue('password', $credenials['password'],43200);
                }else{
                    \Cookie::queue(\Cookie::forget('username'));
                    \Cookie::queue(\Cookie::forget('password'));
                }
                return true;
            }
            return false;
        }

        public function create(array $credenials){
            $result = User::create($credenials);
            if($result){
                UCBalance::create([
                    'user_id'=>$credenials['user_id'],
                    'balance_amount'=>\Gameplay::getactiveEvent(),
                    'status'=>1
                ]);
                return true;
            }
            return false;
        }

        public function profileUpdate($fname,$username,$phone,$avatar){
            $result = User::where('user_id',$this->user_id())
                            ->update([
                                'fname'=>$fname,
                                'username'=>$username,
                                'phone'=>$phone,
                                'avatar'=>$avatar,
                            ]);
            if($result){
                return true;
            }
            return false;
        }
        
        public function user_id(){
            return \Request::session()->get('user_id');
        }

        public function userInfo(){
           return User::where('user_id','=',$this->user_id())->first();
        }

        public function avatar(){
            $avatar = User::where('user_id','=',$this->user_id())->value('avatar');
            if($avatar){
                return $avatar;
            }
            $avatar = "/images/avatar.png";
            return $avatar;
        }
        
        public function ucBalance(){
            return UCBalance::where('user_id','=',$this->user_id())
                            ->where('status','=',1)
                            ->sum('balance_amount');
        }

        public function depositBalance(){
            return BalanceTransfer::where('user_id','=',$this->user_id())
                            ->where('balance_type','=','deposit')
                            ->where('status','=',1)
                            ->sum('uc_amount');
        }

        public function pendingDeposit(){
            return BalanceTransfer::where('user_id','=',$this->user_id())
                                    ->where('balance_type','=','deposit')
                                    ->where('status','=',0)
                                    ->orderBy('created_at','desc')
                                    ->get();
        }

        public function confirmedDeposit(){
            return BalanceTransfer::where('user_id','=',$this->user_id())
                                    ->where('balance_type','=','deposit')
                                    ->where('status','=',1)
                                    ->orderBy('created_at','desc')
                                    ->get();
        }

        public function rejectedDeposit(){
            return BalanceTransfer::where('user_id','=',$this->user_id())
                                    ->where('balance_type','=','deposit')
                                    ->where('status','=',2)
                                    ->orderBy('created_at','desc')
                                    ->get();
        }

        public function depositSummary(){
            return BalanceTransfer::where('user_id','=',$this->user_id())
                                    ->where('balance_type','=','deposit')
                                    ->orderBy('created_at','desc')
                                    ->get();
        }

        public function withdrawBalance(){
            return BalanceTransfer::where('user_id','=',$this->user_id())
                                    ->where('balance_type','=','withDraw')
                                    ->where('status','=',1)
                                    ->sum('uc_amount');
        }

        public function pendingWithdraw(){
            return BalanceTransfer::where('user_id','=',$this->user_id())
                                    ->where('balance_type','=','withdraw')
                                    ->where('status','=',0)
                                    ->orderBy('created_at','desc')
                                    ->get();
        }

        public function confirmedWithdraw(){
            return BalanceTransfer::where('user_id','=',$this->user_id())
                                    ->where('balance_type','=','withdraw')
                                    ->where('status','=',1)
                                    ->orderBy('created_at','desc')
                                    ->get();
        }

        public function rejectedWithdraw(){
            return BalanceTransfer::where('user_id','=',$this->user_id())
                                    ->where('balance_type','=','withdraw')
                                    ->where('status','=',2)
                                    ->orderBy('created_at','desc')
                                    ->get();
        }

        public function withdrawSummary(){
            return BalanceTransfer::where('user_id','=',$this->user_id())
                                    ->where('balance_type','=','withdraw')
                                    ->orderBy('created_at','desc')
                                    ->get();
        }

        public function totalConfirmedTransfer(){
            return BalanceTransfer::where('user_id','=',$this->user_id())
                                    ->where('status','=',1)
                                    ->orderBy('created_at','desc')
                                    ->get();
        }

        public function totalTransection(){
            return BalanceTransfer::where('user_id','=',$this->user_id())
                                    ->orderBy('created_at','desc')
                                    ->get();
        }

        public function gameHistory(){
            return GameBalance::where('user_id','=',$this->user_id())
                                ->where('balance_type','=','in-game')
                                ->orderBy('created_at','desc')
                                ->get();
        }

        public function transferMethod(){
           return TransferMethod::where('status','=',1)->get();
        }

        public function currencyConverter($method_name,$balance_amount){
            $exchange_rate = TransferMethod::where('method_name','=',$method_name)->value('exchange_rate');
            if($exchange_rate && $balance_amount>0){
                return $balance_amount*$exchange_rate;
            }
            return 0; 
        }


    }

<?php
    namespace App\Helpers;
    use App\Models\Admin;
    use App\Models\DepositeEvent;
    use App\Models\UCBalance;
    use App\Models\User;
    use App\Models\BalanceTransfer;
    use App\Models\GameBalance;
    use App\Models\GameRate;
    use App\Models\TransferMethod;

    class AdminAuthentication{

        public function superAdminAttempt(array $credenial){
            if($credenial['email'] == config('app.super-admin') && $credenial['password'] == config('app.super-admin-password')){
                \Request::session()->put('super_admin',\Hash::make($credenial['password']));
                return true;
            }
            return false;
        }

        public function attempt(array $credenials,$remember=false){
            $admin    = Admin::where('admin_email', '=', $credenials['admin_email'])->first();
            $matched = \Hash::check($credenials['password'], $admin->password);
            if($matched){
                \Request::session()->put('admin_id',$admin->admin_id);
                \Request::session()->put('admin_type',$admin->admin_type);
                if($remember == 'on'){
                    \Cookie::queue('admin_email', $credenials['admin_email'],43200);
                    \Cookie::queue('admin_password', $credenials['password'],43200);
                }else{
                    \Cookie::queue(\Cookie::forget('admin_email'));
                    \Cookie::queue(\Cookie::forget('admin_password'));
                }
                return true;
            }
            return false;
        }

        public function admin_id(){
            return \Request::session()->get('admin_id');
        }

        public function adminInfo(){
            return Admin::where('admin_id','=',$this->admin_id())->first();
        }

        public function avatar(){
            $avatar = Admin::where('admin_id','=',$this->admin_id())->value('avatar');
            if($avatar){
                return $avatar;
            }
            $avatar = "/images/avatar.png";
            return $avatar;
        }

        public function totalUser(){
            return User::count();
        }

        public function allUsers(){
            return User::orderBy('id','desc')->get();
        }

        public function totalDeposit(){
            return BalanceTransfer::where('balance_type','=','deposit')
                                    ->where('status',1)
                                    ->sum('uc_amount');
        }

        public function totaldepositRequest(){
            return BalanceTransfer::where('balance_type','=','deposit')
                                    ->where('status',0)
                                    ->count();
        }

        public function allDeposit(){
            return \DB::table('users')
                        ->leftJoin('balance_transfer','users.user_id','=','balance_transfer.user_id')
                        ->where('balance_type','=','deposit')
                        ->get();
        }

        public function pendingDeposit(){
            return \DB::table('users')
                        ->leftJoin('balance_transfer','users.user_id','=','balance_transfer.user_id')
                        ->where('balance_type','=','deposit')
                        ->where('status',0)
                        ->get();
        }

        public function depositConfirmation($id){
            $balanceInfo    = BalanceTransfer::where('id','=',$id)
                                            ->where('balance_type','=','deposit')
                                            ->where('status','=',0)
                                            ->first();
            $depositConfirm = BalanceTransfer::where('id',$id)
                                            ->where('balance_type','=','deposit')
                                            ->update(['status'=>1]);

            if($depositConfirm){
                $balanceAdd = UCBalance::create([
                                                    'user_id'=>$balanceInfo->user_id,
                                                    'balance_amount'=>$balanceInfo->uc_amount,
                                                    'status'=>1
                                                ]);
                if($balanceAdd){
                    return true;
                }
            }
            return false;
        }

        public function depositRejection($id){
            $balanceInfo =  BalanceTransfer::where('id','=',$id)->first();
            $depositConfirm = BalanceTransfer::where('id',$id)
                                                ->where('balance_type','=','deposit')
                                                ->update(['status'=>2]);
            if($depositConfirm){
                return true;
            }
            return false;
        }

        public function totalWithdraw(){
            return BalanceTransfer::where('balance_type','=','withdraw')
                                    ->where('status',1)
                                    ->sum('uc_amount');
        }

        public function allWithdraw(){
            return \DB::table('users')
                        ->leftJoin('balance_transfer','users.user_id','=','balance_transfer.user_id')
                        ->where('balance_type','=','withdraw')
                        ->get();
        }

        public function totalwithdrawRequest(){
            return BalanceTransfer::where('balance_type','=','withdraw')
                                    ->where('status',0)
                                    ->count();
        }

        public function pendingWithdraw(){
            return \DB::table('users')
                        ->leftJoin('balance_transfer','users.user_id','=','balance_transfer.user_id')
                        ->where('balance_type','=','withdraw')
                        ->where('status',0)
                        ->get();
        }

        public function pullWithdraw($id){
            return BalanceTransfer::where('id','=',$id)
                                    ->where('balance_type','=','withdraw')
                                    ->where('status','=',0)
                                    ->first();
        }

        public function withdrawConfirmation($id,$transection_id){
            $balanceInfo     = BalanceTransfer::where('id','=',$id)
                                            ->where('balance_type','=','withdraw')
                                            ->where('status','=',0)
                                            ->first();
            $withdrawConfirm = BalanceTransfer::where('id',$id)
                                            ->where('balance_type','=','withdraw')
                                            ->update(['status'=>1,'transection_id'=>$transection_id]);

            if($withdrawConfirm){
                $balanceOut = UCBalance::create([
                                                    'user_id'=>$balanceInfo->user_id,
                                                    'balance_amount'=>'-'.$balanceInfo->uc_amount,
                                                    'status'=>1
                                                ]);
                if($balanceOut){
                    return true;
                }
            }
            return false;
        }

        public function withdrawRejection($id){
            $balanceInfo    =  BalanceTransfer::where('id','=',$id)->first();
            $withdrawReject = BalanceTransfer::where('id',$id)
                                                ->where('balance_type','=','withdraw')
                                                ->update(['status'=>2]);
            if($withdrawReject){
                return true;
            }
            return false;
        }

        public function totalTransection(){
            return \DB::table('users')
                        ->leftJoin('balance_transfer','users.user_id','=','balance_transfer.user_id')
                        ->get();
        }

        public function totalCountry(){
            return User::distinct('country')->count();
        }

        public function totalWon(){
            return GameBalance::where('status',0)
                                ->sum('balance_amount');
        }

        public function wonGames(){
            return \DB::table('users')
                        ->leftJoin('game_balance','users.user_id','=','game_balance.user_id')
                        ->where('status','=',0)
                        ->get();
        }

        public function lostGames(){
            return \DB::table('users')
                        ->leftJoin('game_balance','users.user_id','=','game_balance.user_id')
                        ->where('status','=',1)
                        ->get();
        }

        public function totalLost(){
            return GameBalance::where('status',1)
                                ->sum('balance_amount');
        }

        public function currentBalance(){
            return $this->totalWon()-$this->totalLost();
        }

        public function getallAdmin(){
            return Admin::orderBy('id','desc')->get();
        }

        public function getSpecificAdmin($admin_id){
            return Admin::where('admin_id',$admin_id)->first();
        }

        public function profileUpdate($admin_name,$admin_phone,$avatar){
            $result = Admin::where('admin_id',$this->admin_id())
                            ->update([
                                'admin_name'=>$admin_name,
                                'admin_phone'=>$admin_phone,
                                'avatar'=>$avatar,
                            ]);
            if($result){
                return true;
            }
            return false;
        }

        public function passwordReset($oldPassword, $newPassword){
            $admin_id = $this->admin_id();
            $admin    = Admin::where('admin_id','=',$admin_id)->first();
            $admin    = \Hash::check($oldPassword, $admin->password);

            if($admin){
                $result   = Admin::where('admin_id',$admin_id)
                                    ->update([
                                        'password'=> \Hash::make($newPassword)
                                    ]);
                if($result){
                    return true;
                }
            }
            return false;
        }

        public function staffList(){
            return Admin::where('admin_type','=','staff')->get();
        }

        public function deleteAdmin($admin_id){
            return Admin::where('admin_id',$admin_id)->delete();
        }

        public function gameRate(){
            return GameRate::where('status',1)->get();
        }

        public function transectionMethod(){
            return TransferMethod::get();
        }

        public function addMethod(array $credential){
            return TransferMethod::create($credential);
        }

        public function deactivatedMethod($id){
            $status = TransferMethod::where('id',$id)->pluck('status')->first();
            if($status == 0){
                return TransferMethod::where('id',$id)->update(['status'=>1]);
            }else{
                return TransferMethod::where('id',$id)->update(['status'=>0]);
            }

        }

        public function getEvent(){
            return DepositeEvent::get();
        }

        public function getspecificMethod($id){
            return TransferMethod::where('id',$id)->first();
        }

        public function updateMethod($id,$trx_number,$exchnage_rate){
            $result = TransferMethod::where('id',$id)
                                    ->update([
                                        'trx_number'=>$trx_number,
                                        'exchange_rate'=>$exchnage_rate
                                    ]);
            if($result){
                return true;
            }
            return false;
        }
    }

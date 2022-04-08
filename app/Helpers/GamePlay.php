<?php
    namespace App\Helpers;
    use App\Models\GameRate;
    use App\Models\GameBalance;
    use App\Models\BalanceTransfer;
    use App\Models\UCBalance;
    use App\Models\TransferMethod;
    use App\Models\User;
    use App\Models\DepositeEvent;

    class GamePlay{
        public function headTail($choosen,$invest){
            $system_choosen = random_int(0,9);
            if($choosen == 'head' && $system_choosen%2 == 0){
                $balance_amount = $this->winningAmount($invest,'head&tail');
                GameBalance::create([
                    'user_id'=> \UserAuth::user_id(),
                    'balance_type'=>'in-game',
                    'game_name'=> 'head&tail',
                    'balance_amount'=> $balance_amount,
                    'status'=>1
                ]);
                UCBalance::where('user_id',\UserAuth::user_id())
                            ->update([
                                'balance_amount'=> \UserAuth::ucBalance()+$balance_amount,
                            ]);
                return true;
            }
            if($choosen == 'tail' && $system_choosen%2 == 1){
                $balance_amount = $this->winningAmount($invest,'head&tail');
                GameBalance::create([
                    'user_id'=> \UserAuth::user_id(),
                    'balance_type'=>'in-game',
                    'game_name'=> 'head&tail',
                    'balance_amount'=> $balance_amount,
                    'status'=>1
                ]);
                UCBalance::where('user_id',\UserAuth::user_id())
                            ->update([
                                'balance_amount'=> \UserAuth::ucBalance()+$balance_amount,
                            ]);
                return true;
            }
            GameBalance::create([
                'user_id'=> \UserAuth::user_id(),
                'balance_type'=>'in-game',
                'game_name'=> 'head&tail',
                'balance_amount'=> $invest,
                'status'=>0
            ]);
            UCBalance::where('user_id',\UserAuth::user_id())
                        ->update([
                            'balance_amount'=> \UserAuth::ucBalance()-$invest,
                        ]);
            return false;
        }

        public function evenOdd($choosen,$invest){
            $system_choosen = random_int(0,9);
            if($choosen == 'even' && $system_choosen%2 == 0){
                $balance_amount = $this->winningAmount($invest,'even&odd');
                GameBalance::create([
                    'user_id'=> \UserAuth::user_id(),
                    'balance_type'=>'in-game',
                    'game_name'=> 'even&odd',
                    'balance_amount'=> $balance_amount,
                    'status'=>1
                ]);
                UCBalance::where('user_id',\UserAuth::user_id())
                            ->update([
                                'balance_amount'=> \UserAuth::ucBalance()+$balance_amount,
                            ]);
                return true;
            }
            if($choosen == 'odd' && $system_choosen%2 == 1){
                $balance_amount = $this->winningAmount($invest,'even&odd');
                GameBalance::create([
                    'user_id'=> \UserAuth::user_id(),
                    'balance_type'=>'in-game',
                    'game_name'=> 'even&odd',
                    'balance_amount'=> $balance_amount,
                    'status'=>1
                ]);
                UCBalance::where('user_id',\UserAuth::user_id())
                            ->update([
                                'balance_amount'=> \UserAuth::ucBalance()+$balance_amount,
                            ]);
                return true;
            }
            GameBalance::create([
                'user_id'=> \UserAuth::user_id(),
                'balance_type'=>'in-game',
                'game_name'=> 'even&odd',
                'balance_amount'=> $invest,
                'status'=>0
            ]);
            UCBalance::where('user_id',\UserAuth::user_id())
                        ->update([
                            'balance_amount'=> \UserAuth::ucBalance()-$invest,
                        ]);
            return false;
        }

        public function kingQueen($choosen,$invest){
            $system_choosen = random_int(0,9);
            if($choosen == 'king' && $system_choosen%2 == 0){
                $balance_amount = $this->winningAmount($invest,'king&queen');
                GameBalance::create([
                    'user_id'=> \UserAuth::user_id(),
                    'balance_type'=>'in-game',
                    'game_name'=> 'king&queen',
                    'balance_amount'=> $balance_amount,
                    'status'=>1
                ]);
                UCBalance::where('user_id',\UserAuth::user_id())
                            ->update([
                                'balance_amount'=> \UserAuth::ucBalance()+$balance_amount,
                            ]);
                return true;
            }
            if($choosen == 'queen' && $system_choosen%2 == 1){
                $balance_amount = $this->winningAmount($invest,'king&queen');
                GameBalance::create([
                    'user_id'=> \UserAuth::user_id(),
                    'balance_type'=>'in-game',
                    'game_name'=> 'king&queen',
                    'balance_amount'=> $balance_amount,
                    'status'=>1
                ]);
                UCBalance::where('user_id',\UserAuth::user_id())
                            ->update([
                                'balance_amount'=> \UserAuth::ucBalance()+$balance_amount,
                            ]);
                return true;
            }
            GameBalance::create([
                'user_id'=> \UserAuth::user_id(),
                'balance_type'=>'in-game',
                'game_name'=> 'king&queen',
                'balance_amount'=> $invest,
                'status'=>0
            ]);
            UCBalance::where('user_id',\UserAuth::user_id())
                        ->update([
                            'balance_amount'=> \UserAuth::ucBalance()-$invest,
                        ]);
            return false;
        }
        
        public function chooseCard($choosen,$invest){
            $system_choosen = random_int(1,12);

            if($system_choosen == 1){
                $system_choosen = 'ace';
            }
            if($system_choosen == 2){
                $system_choosen = 'two';
            }
            if($system_choosen == 3){
                $system_choosen = 'three';
            }
            if($system_choosen == 4){
                $system_choosen = 'four';
            }
            if($system_choosen == 5){
                $system_choosen = 'five';
            }
            if($system_choosen == 1){
                $system_choosen = 'ace';
            }
            if($system_choosen == 6){
                $system_choosen = 'six';
            }
            if($system_choosen == 7){
                $system_choosen = 'seven';
            }
            if($system_choosen == 8){
                $system_choosen = 'eight';
            }
            if($system_choosen == 9){
                $system_choosen = 'nine';
            }
            if($system_choosen == 10){
                $system_choosen = 'ten';
            }
            if($system_choosen == 11){
                $system_choosen = 'queen';
            }
            if($system_choosen == 12){
                $system_choosen = 'king';
            }

            if($choosen == $system_choosen){
                $balance_amount = $this->winningAmount($invest,'choosecard');
                GameBalance::create([
                    'user_id'=> \UserAuth::user_id(),
                    'balance_type'=>'in-game',
                    'game_name'=> 'choosecard',
                    'balance_amount'=> $balance_amount,
                    'status'=>1
                ]);
                UCBalance::where('user_id',\UserAuth::user_id())
                            ->update([
                                'balance_amount'=> \UserAuth::ucBalance()+$balance_amount,
                            ]);
                return array('status'=>true,'system_choosen'=>$system_choosen);
            }
            GameBalance::create([
                'user_id'=> \UserAuth::user_id(),
                'balance_type'=>'in-game',
                'game_name'=> 'choosecard',
                'balance_amount'=> $invest,
                'status'=>0
            ]);
            UCBalance::where('user_id',\UserAuth::user_id())
                        ->update([
                            'balance_amount'=> \UserAuth::ucBalance()-$invest,
                        ]);
            return array('status'=>false,'system_choosen'=>$system_choosen);
        }
        
        public function spinWin($choosen,$invest){
            $system_choosen = random_int(1,4);

            if($system_choosen == 1){
                $system_choosen = 'red';
            }
            if($system_choosen == 2){
                $system_choosen = 'blue';
            }
            if($system_choosen == 3){
                $system_choosen = 'green';
            }
            if($system_choosen == 4){
                $system_choosen = 'yellow';
            }

            if($choosen == $system_choosen){
                $balance_amount = $this->winningAmount($invest,'spin&win');
                GameBalance::create([
                    'user_id'=> \UserAuth::user_id(),
                    'balance_type'=>'in-game',
                    'game_name'=> 'spin&win',
                    'balance_amount'=> $balance_amount,
                    'status'=>1
                ]);
                UCBalance::where('user_id',\UserAuth::user_id())
                            ->update([
                                'balance_amount'=> \UserAuth::ucBalance()+$balance_amount,
                            ]);
                return array('status'=>true,'system_choosen'=>$system_choosen);
            }
            GameBalance::create([
                'user_id'=> \UserAuth::user_id(),
                'balance_type'=>'in-game',
                'game_name'=> 'spin&win',
                'balance_amount'=> $invest,
                'status'=>0
            ]);
            UCBalance::where('user_id',\UserAuth::user_id())
                        ->update([
                            'balance_amount'=> \UserAuth::ucBalance()-$invest,
                        ]);
            return array('status'=>false,'system_choosen'=>$system_choosen);
        }
        
        public function roulette($choosen,$invest){
            $system_choosen = random_int(1,12);

            if($choosen == $system_choosen){
                $balance_amount = $this->winningAmount($invest,'roulette');
                GameBalance::create([
                    'user_id'=> \UserAuth::user_id(),
                    'balance_type'=>'in-game',
                    'game_name'=> 'roulette',
                    'balance_amount'=> $balance_amount,
                    'status'=>1
                ]);
                UCBalance::where('user_id',\UserAuth::user_id())
                            ->update([
                                'balance_amount'=> \UserAuth::ucBalance()+$balance_amount,
                            ]);
                return array('status'=>true,'system_choosen'=>$system_choosen);
            }
            GameBalance::create([
                'user_id'=> \UserAuth::user_id(),
                'balance_type'=>'in-game',
                'game_name'=> 'roulette',
                'balance_amount'=> $invest,
                'status'=>0
            ]);
            UCBalance::where('user_id',\UserAuth::user_id())
                        ->update([
                            'balance_amount'=> \UserAuth::ucBalance()-$invest,
                        ]);
            return array('status'=>false,'system_choosen'=>$system_choosen);
        }

        public function winningAmount($invest,$game_name){
            return $invest+($invest*$this->gameRate($game_name))/100;
        }

        public function gameRate($game_name){
            return GameRate::where('game_name','=',$game_name)->value('game_rate');
        }

        public function getactiveEvent(){
            return DepositeEvent::where('status',1)->pluck('event')->first();
        }
    }
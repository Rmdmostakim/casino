<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function HeadTail(Request $request){
        $validated = $request->validate([
            'invest' => 'bail|required|numeric|min:10|max:500',
            'choosed' => 'bail|required|string',
        ]);
        $invest  = $request->invest;
        $choosen = $request->choosed;

        if($invest <= \UserAuth::ucBalance()){
            if(\Gameplay::headTail($choosen,$invest)){
                return redirect()->route('head-tail')->with('win','<span class="text-warning">Congratulation</span> you have won !')
                                                    ->with('choosen',$choosen)
                                                    ->with('system_choosen',$choosen);
            }
            else{
                if($choosen == 'head'){
                    return redirect()->route('head-tail')->with('lose','<span class="text-warning">Sorry</span> you have lost !')
                                                        ->with('choosen',$choosen)
                                                        ->with('system_choosen','tail');
                }
                return redirect()->route('head-tail')->with('lose','<span class="text-warning">Sorry</span> you have lost !')
                                                        ->with('choosen',$choosen)
                                                        ->with('system_choosen','head');
            }
        }
        return redirect()->route('head-tail')->with('balance', 'Not enough balance ! click to <a href="'.route('deposit').'" class="btn btn--sm">Deposti</a>');
    }

    public function EvenOdd(Request $request){
        $validated = $request->validate([
            'invest' => 'bail|required|numeric|min:10|max:500',
            'choosed' => 'bail|required|string',
        ]);
        $invest  = $request->invest;
        $choosen = $request->choosed;

        if($invest <= \UserAuth::ucBalance()){
            if(\Gameplay::evenOdd($choosen,$invest)){
                return redirect()->route('even-odd')->with('win','<span class="text-warning">Congratulation</span> you have won !')
                                                    ->with('choosen',$choosen)
                                                    ->with('system_choosen',$choosen);
            }
            else{
                if($choosen == 'even'){
                    return redirect()->route('even-odd')->with('lose','<span class="text-warning">Sorry</span> you have lost !')
                                                        ->with('choosen',$choosen)
                                                        ->with('system_choosen','odd');
                }
                return redirect()->route('even-odd')->with('lose','<span class="text-warning">Sorry</span> you have lost !')
                                                        ->with('choosen',$choosen)
                                                        ->with('system_choosen','even');
            }
        }
        return redirect()->route('even-odd')->with('balance', 'Not enough balance ! click to <a href="'.route('deposit').'" class="btn btn--sm">Deposti</a>');
    }

    public function KingQueen(Request $request){
        $validated = $request->validate([
            'invest' => 'bail|required|numeric|min:10|max:500',
            'choosed' => 'bail|required|string',
        ]);
        $invest  = $request->invest;
        $choosen = $request->choosed;

        if($invest <= \UserAuth::ucBalance()){
            if(\Gameplay::kingQueen($choosen,$invest)){
                return redirect()->route('king-queen')->with('win','<span class="text-warning">Congratulation</span> you have won !')
                                                    ->with('choosen',$choosen)
                                                    ->with('system_choosen',$choosen);
            }
            else{
                if($choosen == 'king'){
                    return redirect()->route('king-queen')->with('lose','<span class="text-warning">Sorry</span> you have lost !')
                                                        ->with('choosen',$choosen)
                                                        ->with('system_choosen','queen');
                }
                return redirect()->route('king-queen')->with('lose','<span class="text-warning">Sorry</span> you have lost !')
                                                        ->with('choosen',$choosen)
                                                        ->with('system_choosen','king');
            }
        }
        return redirect()->route('king-queen')->with('balance', 'Not enough balance ! click to <a href="'.route('deposit').'" class="btn btn--sm">Deposti</a>');
    }
    
    public function ChooseCard(Request $request){
        $validated = $request->validate([
            'invest' => 'bail|required|numeric|min:10|max:500',
            'choosed' => 'bail|required|string',
        ]);
        $invest  = $request->invest;
        $choosen = $request->choosed;

        if($invest <= \UserAuth::ucBalance()){
            $result = \Gameplay::chooseCard($choosen,$invest);
            if($result['status']){
                return redirect()->route('choose-card')->with('win','<span class="text-warning">Congratulation</span> you have won !')
                                                        ->with('choosen',$choosen)
                                                        ->with('system_choosen',$result['system_choosen']);
            }
            return redirect()->route('choose-card')->with('lose','<span class="text-warning">Sorry</span> you have lost !')
                                                    ->with('choosen',$choosen)
                                                    ->with('system_choosen',$result['system_choosen']);
        }
        return redirect()->route('choose-card')->with('balance', 'Not enough balance ! click to <a href="'.route('deposit').'" class="btn btn--sm">Deposti</a>');
    }
    
    public function SpinWin(Request $request){
        $validated = $request->validate([
            'invest' => 'bail|required|numeric|min:10|max:500',
            'choosed' => 'bail|required|string',
        ]);
        $invest  = $request->invest;
        $choosen = $request->choosed;

        if($invest <= \UserAuth::ucBalance()){
            $result = \Gameplay::spinWin($choosen,$invest);
            if($result['status']){
                return redirect()->route('spin-win')->with('win','<span class="text-warning">Congratulation</span> you have won !')
                                                        ->with('choosen',$choosen)
                                                        ->with('system_choosen',$result['system_choosen']);
            }
            return redirect()->route('spin-win')->with('lose','<span class="text-warning">Sorry</span> you have lost !')
                                                    ->with('choosen',$choosen)
                                                    ->with('system_choosen',$result['system_choosen']);
        }
        return redirect()->route('spin-win')->with('balance', 'Not enough balance ! click to <a href="'.route('deposit').'" class="btn btn--sm">Deposti</a>');
    }
    
    public function Roulette(Request $request){
        $validated = $request->validate([
            'invest' => 'bail|required|numeric|min:10|max:500',
            'choosed' => 'bail|required|numeric',
        ]);
        $invest  = $request->invest;
        $choosen = $request->choosed;

        if($invest <= \UserAuth::ucBalance()){
            $result = \Gameplay::roulette($choosen,$invest);
            if($result['status']){
                return redirect()->route('roulette')->with('win','<span class="text-warning">Congratulation</span> you have won !')
                                                        ->with('choosen',$choosen)
                                                        ->with('system_choosen',$result['system_choosen']);
            }
            return redirect()->route('roulette')->with('lose','<span class="text-warning">Sorry</span> you have lost !')
                                                    ->with('choosen',$choosen)
                                                    ->with('system_choosen',$result['system_choosen']);
        }
        return redirect()->route('roulette')->with('balance', 'Not enough balance ! click to <a href="'.route('deposit').'" class="btn btn--sm">Deposti</a>');
    }
}

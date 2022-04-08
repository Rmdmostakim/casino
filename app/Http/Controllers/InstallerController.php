<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameRate;

class InstallerController extends Controller
{
    public function requirements(){
        $phpVersion = phpversion();
        $BCMath     = extension_loaded('BCMath');
        $Ctype      = extension_loaded('Ctype');
        $cURL       = extension_loaded('cURL');
        $DOM        = extension_loaded('DOM');
        $Fileinfo   = extension_loaded('JSON');
        $JSON       = extension_loaded('JSON');
        $Mbstring   = extension_loaded('Mbstring');
        $OpenSSL    = extension_loaded('OpenSSL');
        $PCRE       = extension_loaded('PCRE');
        $PDO        = extension_loaded('pdo');
        $Tokenizer  = extension_loaded('tokenizer');
        $XML        = extension_loaded('xml');

        $requirements = array($phpVersion,$BCMath,$Ctype,$cURL,$DOM,$Fileinfo,$JSON,$Mbstring,$OpenSSL,$PCRE,$PDO,$Tokenizer,$XML);
        $nextSteps = true;
        foreach($requirements as $req){
            if($req < '8.0' || $req == 0){
                $nextSteps = false;
                break;
            }
        }
        return view('Installer.Prerequirement',compact('requirements','nextSteps'));
    }

    public function environment(Request $request){
        $validated = $request->validate([
            'app_name' => 'bail|required|string',
            'app_url'=> 'bail|required|string',
            'database_name' => 'bail|required|string',
            'database_username'=> 'bail|required|string',
        ]);
        
        $app_name          = $this->envsetup('APP_NAME',$request->app_name);
        $app_url           = $this->envsetup('APP_URL',$request->app_url);
        $database_name     = $this->envsetup('DB_DATABASE',$request->database_name);
        $database_username = $this->envsetup('DB_USERNAME',$request->database_username);
        $database_password = $this->envsetup('DB_PASSWORD',$request->database_password);

        if( $app_name && $app_url && $database_name && $database_username && $database_password ){
            return redirect()->route('installer.database');
        }
        return redirect()->back()->with('error','Something went wrong try again');
        
        
    }

    public function migrate(){
        $result = \Artisan::call('migrate');

        if( $result == 0){
            \Request::session()->put('migrate',true);
            return redirect()->back()->with('success','Mrigrate run successfully');
        }
        return redirect()->back()->with('error','Mrigrate run failed');
    }    

    public function initialdataset(){
        $games = [
            [
                'game_name'=>'even&odd',
                'game_rate'=>0,
                'status'=>1
            ],
            [
                'game_name'=>'head&tail',
                'game_rate'=>0,
                'status'=>1
            ],
            [
                'game_name'=>'king&queen',
                'game_rate'=>0,
                'status'=>1
            ],
            [
                'game_name'=>'spin&win',
                'game_rate'=>0,
                'status'=>1
            ],
            [
                'game_name'=>'roulette',
                'game_rate'=>0,
                'status'=>1
            ],
            [
                'game_name'=>'choosecard',
                'game_rate'=>0,
                'status'=>1
            ]
        ];
        
        $result = GameRate::upsert($games,['game_name'],['game_rate']);
        if($result){
            \Request::session()->put('dbInitial',true);
            return redirect()->back()->with('success','Database initialization success');
        }
        return redirect()->back()->with('error','Database initialization failed');
    }

    public function systemClean(){
        $cache  = \Artisan::call('cache:clear');
        $config = \Artisan::call('config:clear');
        $route  = \Artisan::call('route:clear');
        $view   = \Artisan::call('view:clear');

        if($cache==0 && $config==0 && $route==0 && $view==0){
            return redirect()->back()->with('success','System Cleared');
        }
        return redirect()->back()->with('error','Try again');
    }

    public function systemOptimize(){
        $config = \Artisan::call('config:cache');
        $route  = \Artisan::call('route:cache');
        $view   = \Artisan::call('view:cache');
    
        if($config==0 && $route==0 && $view==0){
            return redirect()->back()->with('success','System Optimized');
        }
        return redirect()->back()->with('error','Try again');
    }

    public function installComplete(){
        $installedLogFile = storage_path('installed');
        $dateStamp        = date('Y/m/d h:i:sa'); 
        $message          = trans('installation complete on ').$dateStamp."\n";
        if (!file_exists($installedLogFile)) {
            
            file_put_contents($installedLogFile, $message);
        }else{
            file_put_contents($installedLogFile, $message.PHP_EOL, FILE_APPEND | LOCK_EX);
        }

        return redirect()->route('home');
    }
    
    private function envsetup($key,$value){
        $envPath = app()->environmentFilePath();
        $env     = file_get_contents($envPath);
        $env    .= "\n";

        $startPos = strpos($env,$key);
        $endPos   = strpos($env,"\n",$startPos);
        $oldValue = substr($env,$startPos,$endPos-$startPos);
        $replace  = str_replace($oldValue,"{$key}={$value}",$env);
        $newEnv   = file_put_contents($envPath,$replace);
        return $newEnv;
    }

}

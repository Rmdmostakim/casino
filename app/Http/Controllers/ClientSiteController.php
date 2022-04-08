<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientSiteController extends Controller
{
    public function changeLanguage($lang='en'){ 
        
        if($lang == 'en' || $lang == 'bn' || $lang == 'hn'){
            \Request::session()->put('lang',$lang);
            return redirect()->route('home');
        }

        \Request::session()->put('lang','en');
        return redirect()->route('home');
    }
}

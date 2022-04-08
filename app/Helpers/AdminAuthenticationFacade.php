<?php
    namespace App\Helpers;
    use Illuminate\Support\Facades\Facade;

    class AdminAuthenticationFacade extends Facade{
        protected static function getFacadeAccessor(){
            return 'adminAuth';
        }
    }
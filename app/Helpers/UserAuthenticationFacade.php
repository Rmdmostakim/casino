<?php
    namespace App\Helpers;
    use Illuminate\Support\Facades\Facade;

    class UserAuthenticationFacade extends Facade{
        protected static function getFacadeAccessor(){
            return 'usersAuth';
        }
    }
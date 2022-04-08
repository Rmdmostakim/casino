<?php
    namespace App\Helpers;
    use Illuminate\Support\Facades\Facade;

    class GameplayFacade extends Facade{
        protected static function getFacadeAccessor(){
            return 'gameControlls';
        }
    }
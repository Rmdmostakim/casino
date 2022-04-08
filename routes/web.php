<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientSiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserpanelController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;


Route::middleware(['installerGuard'])->group(function () {
    //client site routes
    Route::get('/',function(){
        return view('ClientSitePages.Home');
    })->name('home')->middleware('lang');
    Route::get('/about',function(){
        return view('ClientSitePages.About');
    })->name('about')->middleware('lang');
    Route::get('/games',function(){
        return view('ClientSitePages.Games');
    })->name('games')->middleware('lang');
    Route::get('/fag',function(){
        return view('ClientSitePages.FAQ');
    })->name('faq')->middleware('lang');

    //language change route
    Route::get('/lang/{lang}',[ClientSiteController::class,'changeLanguage'])->name('lang');

    //client site login/reg routes
    Route::group(['middleware'=>'UserGuard'],function(){
        Route::get('/login', function(){
            return view('ClientSitePages.Login');
        })->name('sign-in');
        Route::get('/registration', function(){
            return view('ClientSitePages.Registration');
        })->name('sign-up');
    });

    // play game routes
    Route::group(['middleware'=>'UserAuth','prefix' => '/play'],function(){
        Route::get('/even-odd', function () {
            return view('GamePages.EvenOdd');
        })->name('even-odd');
        Route::get('/roulette', function () {
            return view('GamePages.Roulette');
        })->name('roulette');
        Route::get('/choose-card', function () {
            return view('GamePages.Choosecard');
        })->name('choose-card');
        Route::get('/head-tail', function () {
            return view('GamePages.HeadTail');
        })->name('head-tail');
        Route::get('/king-queen', function () {
            return view('GamePages.KingQueen');
        })->name('king-queen');
        Route::get('/spin-win', function () {
            return view('GamePages.Spinwin');
        })->name('spin-win');
    });

    // game results routes
    Route::group(['middleware'=>'UserAuth'],function(){
        Route::get('/headTail',[GameController::class,'HeadTail'])->name('HeadTail');
        Route::get('/evenOdd',[GameController::class,'EvenOdd'])->name('EvenOdd');
        Route::get('/kingQueen',[GameController::class,'KingQueen'])->name('KingQueen');
        Route::get('/chooseCard',[GameController::class,'ChooseCard'])->name('chooseCard');
        Route::get('/spinWin',[GameController::class,'SpinWin'])->name('SpinWin');
        Route::get('/rouletteSpin',[GameController::class,'Roulette'])->name('rouletteSpin');
    });

    // user login & reg confirmation route
    Route::post('/user.login',[AuthController::class,'UserLogin'])->name('user.login');
    Route::post('/user.reg',[AuthController::class,'UserReg'])->name('user.reg');
    Route::get('/user-password-reset',function(){
        return view('ClientSitePages.UserpasswordReset');
    })->name('user.reserpassword');
    Route::post('/confirmuserReset',[AuthController::class,'resetPassword'])->name('user.confirmreset');

    // user panel route
    Route::group(['middleware'=>'UserAuth','prefix' => '/user'],function(){
        Route::get('/dashboard', function () {
            return view('UserpanelPages.Dashboard');
        })->name('user.dashboard');

        Route::get('/balance', function () {
            return view('UserpanelPages.Balance');
        })->name('user.balance');

        Route::get('/deposit-summary', function () {
            return view('UserpanelPages.depositSummary');
        })->name('deposit.summary');

        Route::get('/withdraw-summary', function () {
            return view('UserpanelPages.withdrawSummary');
        })->name('withdraw.summary');

        Route::get('/deposit', function () {
            return view('UserpanelPages.Deposit');
        })->name('deposit');

        Route::get('/withdraw', function () {
            return view('UserpanelPages.Withdraw');
        })->name('withdraw');

        Route::get('/transection', function () {
            return view('UserpanelPages.transectionSummary');
        })->name('transection');

        Route::get('/user-profile', function () {
            return view('UserpanelPages.userProfile');
        })->name('user.profile');

        Route::get('/change-password', function () {
            return view('UserpanelPages.changePassword');
        })->name('change.password');
    });

    //user panel post request routes
    Route::group(['middleware'=>'UserAuth'],function(){
        Route::post('/deposit-request',[UserpanelController::class,'deposit'])->name('deposit.request');
        Route::post('/withdraw-request',[UserpanelController::class,'withdraw'])->name('withdraw.request');
        Route::post('/profile-update',[UserpanelController::class,'profileUpdate'])->name('profile.update');
        Route::post('/passwordReset',[UserpanelController::class,'passwordReset'])->name('password.reset');
    });

    //currency converter route
    Route::post('/currency-converter',[UserpanelController::class,'currencyConverter'])->name('currency.converter');
    // logout
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');


    //superadmin login
    Route::get('/superadmin/login',function(){
        return view('ClientSitePages.superadminLogin');
    })->name('superadmin.login');
    Route::post('/superadmin/confirmation',[SuperAdminController::class,'superadminCofirmation'])
            ->name('superadmin.confirmation');
    Route::group(['middleware'=>'SuperAdminAuth', 'prefix'=>'superadmin'],function(){
        Route::get('/dashboard', function () {
            return view('SuperadminpanelPages.Dashboard');
        })->name('superadmin.dashboard');
        Route::get('/newadmin', function () {
            return view('SuperadminpanelPages.Newadmin');
        })->name('superadmin.newadmin');
        Route::get('/add-newadmin', [SuperAdminController::class,'addnewAdmin'])->name('superadmin.add-newadmin');
        Route::get('/confirm-delete/{admin_id}',[SuperAdminController::class,'adminDelete'])->name('superadmin.delete');
        Route::get('/cache-clear',[SuperAdminController::class,'cacheClear'])->name('superadmin.clear');
    });

    //admin routes
    Route::get('/admin/login',function(){
        return view('ClientSitePages.adminLogin');
    })->name('admin.login')->middleware('AdminGuard');
    Route::post('/admin/confirm', [AdminController::class,'adminConfirmation'])->name('admin.confirm');
    // admin panel pages
    Route::group(['middleware'=>'AdminAuth','prefix'=>'admin'],function(){
        Route::get('/dashboard',function(){
            return view('AdminpanelPages.Dashboard');
        })->name('admin.dashboard');

        Route::get('/userlist',function(){
            return view('AdminpanelPages.Userlist');
        })->name('admin.userlist');
        //deposit
        Route::get('/total-deposit',function(){
            return view('AdminpanelPages.Depositsummary');
        })->name('admin.totaldeposit');

        Route::get('/deposit-request',function(){
            return view('AdminpanelPages.Depositrequest');
        })->name('admin.depositrequest');

        Route::get('/confirm-deposit/{depositID}',[AdminController::class,'depositConfirmation'])
                ->name('admin.confirmdeposit');

        Route::get('/reject-deposit/{depositID}',[AdminController::class,'depositRejection'])
            ->name('admin.rejectdeposit');
        //withdraw
        Route::get('/total-withdraw',function(){
            return view('AdminpanelPages.Withdrawsummary');
        })->name('admin.totalwithdraw');

        Route::get('/withdraw-request',function(){
            return view('AdminpanelPages.Withdrawrequest');
        })->name('admin.withdrawrequest');

        Route::get('/pull-withdraw/{withdrawID}',[AdminController::class,'pullWithrawrequest'])
            ->name('admin.pullwithdraw');

        Route::post('/confirm-withdraw',[AdminController::class,'confirmWithdraw'])
            ->name('admin.confirmwithdraw');

        Route::get('/reject-withdraw/{withdrawId}',[AdminController::class,'withdrawRejection'])
        ->name('admin.withdrawRejection');
        //total transection
        Route::get('/transection',function(){
            return view('AdminpanelPages.Totaltansection');
        })->name('admin.transection');
        //admin profile
        Route::get('/admin-profile',function(){
            return view('AdminpanelPages.Adminprofile');
        })->name('admin.profile');

        Route::post('/update-profile',[AdminController::class,'profileUpdate'])
        ->name('admin.profileupdate');
        // change password
        Route::get('/change-password',function(){
            return view('AdminpanelPages.Changepassword');
        })->name('admin.changepassword');

        Route::post('/password-reset',[AdminController::class,'passwordReset'])
        ->name('admin.passwordreset');
        //game won and lost
        Route::get('/total-won',function(){
            return view('AdminpanelPages.Totalwongames');
        })->name('admin.totalwon');

        Route::get('/total-lost',function(){
            return view('AdminpanelPages.Totallostgames');
        })->name('admin.totallost');
        //add new admin
        Route::get('/addnew-admin',function(){
            if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin'){
                return view('AdminpanelPages.Addnewadmin');
            }
            return redirect()->back();
        })->name('admin.addnew');

        Route::post('/confirmnewadd',[AdminController::class,'addnewAdmin'])
        ->name('admin.confirm-newadmin');

        Route::get('/adminlist',function(){
            if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin'){
                return view('AdminpanelPages.Adminlist');
            }
            return redirect()->back();
        })->name('admin.adminlist');

        Route::get('/staff-delete/{staffId}',[AdminController::class,'staffDelete'])
        ->name('admin.staffdelete');

        Route::get('/gamesetting',function(){
            if(\Request::session()->has('admin_type') && \Request::session()->get('admin_type') == 'admin'){
                return view('AdminpanelPages.Gamesetting');
            }
            return redirect()->back();
        })->name('admin.gamesetting');

        Route::post('/updaterate',[AdminController::class,'updateRate'])->name('admin.rateupdate');

        Route::post('/addmethod',[AdminController::class,'addMethod'])->name('admin.addmethod');
        Route::get('/editmethod/{method_id}',[AdminController::class,'editMethodView'])->name('admin.editmethod');
        Route::post('/confirmeditmethod',[AdminController::class,'confirmeditMethod'])->name('admin.confirmeditmethod');
        Route::get('/deactivatedmethod/{method_id}',[AdminController::class,'deactivatedMethod'])->name('admin.deactivatedmethod');
        Route::get('/activatemethod/{method_id}',[AdminController::class,'activeMethod'])->name('admin.activatemethod');

        Route::post('/addoffer',[AdminController::class,'addoffer'])->name('admin.addoffer');
        
        Route::get('/caache-clear',[AdminController::class,'allClear'])->name('admin.clear');
		Route::get('/system-optimize',[AdminController::class,'optimize'])->name('admin.optimize');
    });

});

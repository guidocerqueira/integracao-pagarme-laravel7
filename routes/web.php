<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Site', 'as' => 'site.'], function(){
    Route::get('', 'SiteController@home')->name('home');
    Route::get('plan', 'SiteController@plans')->name('plan');
    Route::get('account/login', 'SiteController@formLogin')->name('account.login');
    Route::post('account/login', 'SiteController@login')->name('account.login.post');
    Route::post('account/register', 'SiteController@register')->name('account.register.post');
    
    Route::group(['middleware' => 'auth'], function () {
        Route::get('account/home', 'SiteController@homeAccount')->name('account.home');
        Route::get('account/info', 'SiteController@infoAccount')->name('account.info');
        Route::put('account/info', 'SiteController@updateInfoAccount')->name('account.info.update');
        Route::get('account/transaction', 'SiteController@transactionAccount')->name('account.transaction');
        Route::get('account/logout', 'SiteController@logout')->name('account.logout');
        Route::get('account/plan/{id}/subscription', 'SiteController@planSubscription')->name('account.plan.subscription');
        Route::post('account/plan/{id}/subscription', 'SiteController@planSubscriptionStore')->name('account.plan.subscription.store');
        Route::get('account/plan/{id}/subscription/billet', 'SiteController@planSubscriptionStoreBillet')->name('account.plan.subscription.store.billet');
    });
});

Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin'], function(){
    //login
    Route::get('', 'AuthController@formLogin')->name('formlogin');
    Route::post('login', 'AuthController@login')->name('login');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('home', 'AuthController@home')->name('home');
        Route::get('logout', 'AuthController@logout')->name('logout');

        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');

        Route::resource('pagarme/plan', 'PlanController');
    });
});

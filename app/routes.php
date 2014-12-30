<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//set url redirect on accepting app permissions on mobile
if(Agent::isMobile()){
    Config::set('facebook.APP_URL', Config::get('facebook.CANVAS_URL_MOBILE'));
}
//fb app init
Route::any('/', array('as' => 'home', 'uses' => 'HomeController@showWelcome'));
Route::any('home', array('as' => 'home', 'uses' => 'HomeController@showWelcome'));

//fb tab init
Route::any('tab', array('as' => 'tab', 'uses' => 'HomeController@showTab'));

//fb mobile init -> in this case the method points to the same as '/'
Route::any('mobile', array('as' => 'mobile', 'uses' => 'HomeController@showWelcome'));

Route::post('ajaxform', 'HomeController@ajaxresponse');

//fb privacy policy
Route::any('legal', array('as' => 'privacy', 'uses' => 'HomeController@showLegal'));

//permissions window fb privacy policy
Route::any('privacy', array('as' => 'privacy', 'uses' => 'OutsideController@permissionsPolicy'));

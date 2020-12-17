<?php

use Illuminate\Support\Facades\Route;
use Knusperleicht\CrumbForm\Mail\Boundary\MailController;

//require 'vendor/autoload.php';
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Knusperleicht\CrumbForm'], function () {

    Route::post('forms/{id}', [MailController::class, 'validate']);

    Route::post('sendmail', 'MailController@sendMail');
    Route::get('reload-captcha', 'MailController@reloadCaptcha');
    Route::get('test', 'MailController@index');
    Route::get('template', function () {
        return view('template');
    });
    /*Route::get('template', function () {
        return view('template');
    });*/
});
//(new Captcha)->img()


<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect()->route('Company.index');
});

//Route::get('/home', 'HomeController@index');

Auth::routes();

Route::resource('Company','CompanyController');
Route::resource('Certificate','CertificateController');

//Route::group([
//    'prefix' => 'company'
//],function (){
//    Route::get('',"CompanyController@List");
//    Route::get('{id}',"CompanyController@View");
//    Route::get('{id}/edit',"CompanyController@Edit");
//    Route::post('{id}/edit',"CompanyController@EditPost");
//    Route::post('{id}/delete',"CompanyController@Delete");
//    Route::get('{id}',"CompanyController@View");
//});
//
//Route::group([
//    'prefix' => 'certificate'
//],function (){
//    Route::get('',"CertificateController@List");
//    Route::get('{id}',"CertificateController@View");
//    Route::get('{id}/edit',"CertificateController@Edit");
//    Route::post('{id}/edit',"CertificateController@EditPost");
//    Route::post('{id}/delete',"CertificateController@Delete");
//    Route::get('{id}',"CertificateController@View");
//});

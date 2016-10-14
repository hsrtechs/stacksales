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

Route::post('/Company/QualificationPost/{id}',function (\App\QualificationCategory $id){
    return response()->json($id->Qualifications->toArray());
});
//$c = (new \App\Certificate());
//$d = $c->find(99);
//$d->expiry = \Carbon\Carbon::now()->addWeek(15);
//$d->save();
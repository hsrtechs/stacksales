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

Route::get('Certificate/create/{company?}','CertificateController@create')->name('Certificate.create.var');
Route::get('Certificate/view/{data?}',"CertificateController@index")->name('Certificate.index.var');
Route::get('Company/{Company}/{Category?}/{CertificateName?}/{Level?}',"CompanyController@show")->name('Company.show.var');

Route::post('/Certificate/Roles/{id}',function (\App\CertificateCategory $id){
    return response()->json($id->Roles->toArray());
});

Route::post('Certificate/Level/{id}',function (\App\CertificateName $id){
    return response()->json($id->Level()->get()->toArray());
});

Route::post('/Company/QualificationPost/{id}',function (\App\QualificationCategory $id){
    return response()->json($id->Qualifications->toArray());
});

Route::post('/Company/QualificationLevel/{id}',function (\App\Qualification $id){
    return response()->json($id->Levels->toArray());
});

Route::group([
    'prefix' => 'download'
],function (){
    Route::post('certificates/{token}',"DownloadController@certificates");
});
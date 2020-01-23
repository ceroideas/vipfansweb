<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/terminos-de-uso' , 'adminController@privacy');
Route::get('/faqs' , 'adminController@faqs');
Route::get('/admin/logout' , 'adminController@logout');
Route::get('/migrar' , 'adminController@migrar');

Route::view('/admin/login' , 'admin.login')->name('login');
Route::view('/contacto' , 'contact');

Route::post('/login' , 'adminController@postLogin');

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => '/admin'] , function(){
    	Route::get('/home' , 'adminController@showIndex');
    	Route::get('/users/updateStatus/{id}' , 'usersController@changeStatus');
    	Route::get('/packages/updateStatus/{id}' , 'packagesController@changeStatus');
    	Route::get('/themes/updateStatus/{id}' , 'themesController@changeStatus');
    	Route::get('/likes' , 'adminController@likes');
        Route::get('/packages/sells/{id}' , 'packagesController@sells');
        Route::get('/packages/export/all/{id}' , 'packagesController@export');
        Route::get('/earnings' , 'adminController@earnings');
        Route::get('/magnetism' , 'adminController@magnetism');
        Route::get('/magnetism/options' , 'adminController@optionsMagnetism');
        Route::get('/magnetism/options/{id}/edit' , 'adminController@editOptions');
        Route::get('/magnetism/options/updateStatus/{id}' , 'adminController@deleteOptions');
        Route::get('/magnetism/packages' , 'adminController@listMagnetismPackages');
        Route::get('/magnetism/packages/create' , 'adminController@createMagnetismPackages');
        Route::get('/magnetism/packages/{id}/edit' , 'adminController@editMagnetismPackages');
        Route::get('/magnetism/packages/updateStatus/{id}' , 'adminController@deleteMagnetismPackages');
        Route::get('/faqs/updateStatus/{id}' , 'faqsController@destroy');
        Route::get('/credits/updateStatus/{id}' , 'creditsController@destroy');
        Route::get('/languages/updateStatus/{id}' , 'languagesController@destroy');

    	Route::post('/likes' , 'adminController@postLike');
        Route::post('/users/credits/{id}' , 'usersController@credits');
        Route::post('/earnings' , 'adminController@postEarnings');
        Route::post('/magnetism' , 'adminController@postMagnetism');
        Route::post('/magnetism/options' , 'adminController@postMagnetismOptions');
        Route::post('/magnetism/packages/' , 'adminController@storeMagnetismPackages');
        Route::post('/magnetism/packages/{id}' , 'adminController@updateMagnetismPackages');
        Route::post('/export/users' , 'usersController@exportUsers');

        Route::put('/magnetism/options/{id}' , 'adminController@updateMagnetismOptions');

    	Route::resource('/users' , 'usersController');
    	Route::resource('/packages' , 'packagesController');
    	Route::resource('/themes' , 'themesController');
        Route::resource('/faqs' , 'faqsController');
        Route::resource('/credits' , 'creditsController');
        Route::resource('/languages' , 'languagesController');
    });
});

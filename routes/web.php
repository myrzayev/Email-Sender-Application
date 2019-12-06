<?php

Route::group(['namespace'=>'front'],function (){
    Route::group(['namespace'=>'auth','as'=>'auth.'],function (){
        Route::get('/giris','loginController@index')->name('giris');
        Route::post('/giris','loginController@store')->name('girisStore');
        Route::get('/cixis','loginController@logout')->name('cixis');
        Route::get('/qeyd','registerController@index')->name('qeyd');
        Route::post('/qeyd','registerController@store')->name('qeydStore');
        Route::get('/tesdiqle','verifyController@index')->name('tesdiqle');
        Route::post('/tesdiqle','verifyController@store')->name('tesdiqleStore');
        Route::get('/reminder',function (){
            \Illuminate\Support\Facades\Artisan::call('Reminder:Start');
        });
    });
});

Auth::routes();

Route::group(['namespace'=>'front','middleware'=>['auth']],function (){

    Route::group(['namespace'=>'home','as'=>'home.'],function (){
        Route::get('/','indexController@index')->name('index');
        Route::post('/','indexController@store')->name('store');
    });

    Route::group(['namespace'=>'senders','as'=>'senders.'],function (){
        Route::get('/senders','indexController@index')->name('index');
        Route::get('/senders/edit/{id}','indexController@edit')->name('edit');
        Route::post('/senders/edit/{id}','indexController@update')->name('update');
        Route::get('/senders/delete/{id}','indexController@delete')->name('delete');
    });

});

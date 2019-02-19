<?php 

Route::group(['prefix' => 'v1/system'], function () {
    Route::get('debug', 'SystemController@debug');
    Route::post('debug', 'SystemController@debug');
    Route::put('debug', 'SystemController@debug');

    Route::get('time', 'SystemController@time');
    Route::get('day', 'SystemController@day');
    Route::get('week', 'SystemController@week');
    Route::get('month', 'SystemController@month');
    Route::get('year', 'SystemController@year');
    Route::get('uuid', 'SystemController@uuid');
});
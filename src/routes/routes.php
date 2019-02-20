<?php

Route::group(['namespace' => 'Allumina\Playd\Core\Http\Controllers', 'prefix' => 'api/v1/system'], function () {
    Route::get('time', 'SystemController@time');
    Route::get('day', 'SystemController@day');
    Route::get('week', 'SystemController@week');
    Route::get('month', 'SystemController@month');
    Route::get('year', 'SystemController@year');
    Route::get('uuid', 'SystemController@uuid');
});
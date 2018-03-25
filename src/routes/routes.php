<?php

Route::group(['prefix' => 'vue-guard', 'middleware' => ['web','auth:api']], function() {
    Route::get('demo', 'Bantenprov\VueGuard\Http\Controllers\VueGuardController@demo');
   
    Route::get('/', 'Bantenprov\VueGuard\Http\Controllers\VueGuardController@index')->name('vueguard.index');

    Route::get('/create', 'Bantenprov\VueGuard\Http\Controllers\VueGuardController@create')->name('vueguard.create');

    Route::get('/{id}/show', 'Bantenprov\VueGuard\Http\Controllers\VueGuardController@show')->name('vueguard.show');

    Route::get('/{id}/get-transition', 'Bantenprov\VueGuard\Http\Controllers\VueGuardController@getTransition')->name('vueguard.getTransition');

    Route::post('/store', 'Bantenprov\VueGuard\Http\Controllers\VueGuardController@store')->name('vueguard.store');

    Route::delete('/{id}/destroy', 'Bantenprov\VueGuard\Http\Controllers\VueGuardController@destroy')->name('vueguard.destroy');

});

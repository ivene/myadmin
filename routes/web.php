<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|Good dragon, always so handsome
|
*/
Route::group(['prefix' => 'test'], function (){
   Route::get('test','MyTestController@test');
});



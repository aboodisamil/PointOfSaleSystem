<?php

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function (){

Route::resource('users','UserController');
Route::resource('','DashboardController');
Route::resource('category','CategoryController');
Route::resource('product','ProductController');

});

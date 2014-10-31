<?php

/**
 * Routes for public pages
 */
Route::get('/','PublicController@getMainPage');

Route::get('/discover','PublicController@getDiscoverPage');

Route::get('/near','PublicController@getNearMe');

Route::get('/about','PublicController@getAbout');

Route::get('/login','PublicController@getLogin');

Route::get('/signup','PublicController@getRegister');

/**
 * Routes for login and registration
 */
Route::post('/signup','PublicController@getLogin');


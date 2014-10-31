<?php


Route::get('/','PublicController@getMainPage');

Route::get('/discover','PublicController@getDiscoverPage');

Route::get('/near','PublicController@getNearMe');

Route::get('/about','PublicController@getAbout');

Route::get('/login','PublicController@getLogin');

Route::get('/register','PublicController@getRegister');


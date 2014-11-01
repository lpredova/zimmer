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
 * ====================================================================
 */

/**
 * Routes for login and registration
 */
Route::get('/signup','RegistrationController@createUser');
Route::get('/signup/owner','RegistrationController@createOwner');
Route::post('/register/user','RegistrationController@storeUser');
Route::post('/register/owner','RegistrationController@storeOwner');
/**
 * ====================================================================
 */


/**
 * Admin routes
 */
Route::get('/admin/','AdminController@indexAdmin');

/**
 * Roles CRUD
 */
Route::get('/admin/roles','AdminController@indexRole');
Route::get('/admin/roles/new','AdminController@createRole');
Route::post('/admin/roles/store','AdminController@storeRole');
Route::get('/admin/roles/show/{id}','AdminController@showRole');
Route::get('/admin/roles/edit/{id}','AdminController@editRole');
Route::put('/admin/roles/update/{id}','AdminController@updateRole');
Route::delete('/admin/roles/destroy/{id}','AdminController@destroyRole');
/**
 * ====================================================================
 */

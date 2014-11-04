<?php

/**
 * Routes for public pages
 */
Route::get('/', 'PublicController@getMainPage');
Route::get('/discover', 'PublicController@getDiscoverPage');
Route::get('/near', 'PublicController@getNearMe');
Route::get('/about', 'PublicController@getAbout');
Route::get('/login', 'PublicController@getLogin');
Route::get('/signup', 'PublicController@getRegister');
Route::get('/restricted', 'PublicController@indexRestricted');
/**
 * ====================================================================
 */

/**
 * Routes for login and registration
 */
Route::get('/signup', 'RegistrationController@createUser');
Route::get('/signup/owner', 'RegistrationController@createOwner');
Route::post('/register/user', 'RegistrationController@storeUser');
Route::post('/register/owner', 'RegistrationController@storeOwner');
Route::post('/login', 'RegistrationController@loginUser');
Route::get('/logout', 'RegistrationController@logoutUser');
/**
 * ====================================================================
 */

/**
 * Admin routes
 */
Route::group(array('before' => 'auth|admin'), function () {

    Route::get('/admin/', 'AdminController@indexAdmin');
    /**
     * Users CRUD
     */
    Route::get('/admin/users', 'AdminController@indexUser');
    Route::get('/admin/users/new', 'AdminController@createUser');
    Route::post('/admin/users/store', 'AdminController@storeUser');
    Route::get('/admin/users/show/{id}', 'AdminController@showUser');
    Route::get('/admin/users/edit/{id}', 'AdminController@editUser');
    Route::put('/admin/users/update/{id}', 'AdminController@updateUser');
    Route::delete('/admin/users/destroy/{id}', 'AdminController@destroyUser');


    /**
     * Roles CRUD
     */
    Route::get('/admin/roles', 'AdminController@indexRole');
    Route::get('/admin/roles/new', 'AdminController@createRole');
    Route::post('/admin/roles/store', 'AdminController@storeRole');
    Route::get('/admin/roles/show/{id}', 'AdminController@showRole');
    Route::get('/admin/roles/edit/{id}', 'AdminController@editRole');
    Route::put('/admin/roles/update/{id}', 'AdminController@updateRole');
    Route::delete('/admin/roles/destroy/{id}', 'AdminController@destroyRole');
    /**
     * ====================================================================
     */
});


/**
 * Owner routes
 */
Route::group(array('before' => 'auth|owner'), function () {

    Route::get('/owner', 'OwnerController@indexOwner');
});
/**
 * ====================================================================
 */


/**
 * User routes
 */
Route::group(array('before' => 'auth|user'), function () {

    Route::get('/user', 'UserController@indexUser');

});
/**
 * ====================================================================
 */
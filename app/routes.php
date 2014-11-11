<?php
/**
 * API routes
 */
Route::group(array('prefix' => 'api/v1'), function()
{
    Route::get('/', 'ApiController@index');
});

/**
 * ====================================================================
 */
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
Route::group(array('before' => 'auth|admin','prefix' => 'admin/'), function () {

    Route::get('/', 'AdminController@indexAdmin');
    /**
     * Users CRUD
     */
    Route::get('/users', 'AdminController@indexUser');
    Route::get('/users/new', 'AdminController@createUser');
    Route::post('/users/store', 'AdminController@storeUser');
    Route::get('/users/show/{id}', 'AdminController@showUser');
    Route::get('/users/edit/{id}', 'AdminController@editUser');
    Route::put('/users/update/{id}', 'AdminController@updateUser');
    Route::delete('/users/destroy/{id}', 'AdminController@destroyUser');
    /**
     * Apartments CRUD
     */
    Route::get('/apartments', 'AdminController@indexApartment');
    Route::get('/apartments/new', 'AdminController@createApartment');
    Route::post('/apartments/store', 'AdminController@storeApartment');
    Route::get('/apartments/show/{id}', 'AdminController@showApartment');
    Route::get('/apartments/edit/{id}', 'AdminController@editApartment');
    Route::put('/apartments/update/{id}', 'AdminController@updateApartment');
    Route::delete('/apartments/destroy/{id}', 'AdminController@destroyApartment');
    /**
     * Apartment types CRUD
     */
    Route::get('/apartment_types', 'AdminController@indexApType');
    Route::get('/apartment_types/new', 'AdminController@createApType');
    Route::post('/apartment_types/store', 'AdminController@storeApType');
    Route::get('/apartment_types/show/{id}', 'AdminController@showApType');
    Route::get('/apartment_types/edit/{id}', 'AdminController@editApType');
    Route::put('/apartment_types/update/{id}', 'AdminController@updateApType');
    Route::delete('/apartment_types/destroy/{id}', 'AdminController@destroyApType');

    /**
     * Countries CRUD
     */
    Route::get('/countries', 'AdminController@indexCountry');
    Route::get('/countries/new', 'AdminController@createCountry');
    Route::post('/countries/store', 'AdminController@storeCountry');
    Route::get('/countries/show/{id}', 'AdminController@showCountry');
    Route::get('/countries/edit/{id}', 'AdminController@editCountry');
    Route::put('/countries/update/{id}', 'AdminController@updateCountry');
    Route::delete('/countries/destroy/{id}', 'AdminController@destroyCountry');
    /**
     * Cities CRUD
     */
    Route::get('/cities', 'AdminController@indexCity');
    Route::get('/cities/new', 'AdminController@createCity');
    Route::post('/cities/store', 'AdminController@storeCity');
    Route::get('/cities/show/{id}', 'AdminController@showCity');
    Route::get('/cities/edit/{id}', 'AdminController@editCity');
    Route::put('/cities/update/{id}', 'AdminController@updateCity');
    Route::delete('/cities/destroy/{id}', 'AdminController@destroyCity');
    /**
     * Pictures CRUD
     */
    Route::get('/pictures', 'AdminController@indexPicture');
    Route::get('/pictures/new', 'AdminController@createPicture');
    Route::post('/pictures/store', 'AdminController@storePicture');
    Route::get('/pictures/show/{id}', 'AdminController@showPicture');
    Route::get('/pictures/edit/{id}', 'AdminController@editPicture');
    Route::put('/pictures/update/{id}', 'AdminController@updatePicture');
    Route::delete('/pictures/destroy/{id}', 'AdminController@destroyPicture');

    /**
     * Roles CRUD
     */
    Route::get('/roles', 'AdminController@indexRole');
    Route::get('/roles/new', 'AdminController@createRole');
    Route::post('/roles/store', 'AdminController@storeRole');
    Route::get('/roles/show/{id}', 'AdminController@showRole');
    Route::get('/roles/edit/{id}', 'AdminController@editRole');
    Route::put('/roles/update/{id}', 'AdminController@updateRole');
    Route::delete('/roles/destroy/{id}', 'AdminController@destroyRole');
    /**
     * ====================================================================
     */
});


/**
 * Owner routes
 */
Route::group(array('before' => 'auth|owner','prefix' => 'owner/'), function () {

    Route::get('/', 'OwnerController@indexOwner');
});
/**
 * ====================================================================
 */


/**
 * User routes
 */
Route::group(array('before' => 'auth|user','prefix' => 'user/'), function () {

    Route::get('/', 'UserController@indexUser');

});
/**
 * ====================================================================
 */
<?php

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

    Route::get('/main', 'AdminController@indexAdmin');
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
    Route::get('/city', 'AdminController@indexCity');
    Route::get('/city/new', 'AdminController@createCity');
    Route::post('/city/store', 'AdminController@storeCity');
    Route::get('/city/show/{id}', 'AdminController@showCity');
    Route::get('/city/edit/{id}', 'AdminController@editCity');
    Route::put('/city/update/{id}', 'AdminController@updateCity');
    Route::delete('/city/destroy/{id}', 'AdminController@destroyCity');
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
     * Rooms CRUD
     */
    Route::get('/rooms', 'AdminController@indexRoom');
    Route::get('/rooms/new', 'AdminController@createRoom');
    Route::post('/rooms/store', 'AdminController@storeRoom');
    Route::get('/rooms/show/{id}', 'AdminController@showRoom');
    Route::get('/rooms/edit/{id}', 'AdminController@editRoom');
    Route::put('/rooms/update/{id}', 'AdminController@updateRoom');
    Route::delete('/rooms/destroy/{id}', 'AdminController@destroyRoom');


    /**
     * ====================================================================
     */

    /**
     * Push notifications managment
     */
    Route::get('/push', 'AdminController@pushNotification');

    /**
     * User personal profile managment
     */
    Route::get('/profile', 'AdminController@getUserProfile');

    /**
     * System stats owerview
     */
    Route::get('/stats', 'AdminController@getStatistics');

});


/**
 * Owner routes
 */
Route::group(array('before' => 'auth|owner','prefix' => 'owner/'), function () {

    Route::get('/', 'OwnerController@indexOwner');

    /**
     * Apartments
     */
    Route::get('/apartments', 'OwnerController@indexApartments');
    Route::get('/apartments/new', 'OwnerController@createApartment');
    Route::post('/apartments/store', 'OwnerController@storeApartment');
    Route::get('/apartments/show/{id}', 'OwnerController@showApartment');
    Route::get('/apartments/edit/{id}', 'OwnerController@editApartment');
    Route::put('/apartments/update/{id}', 'OwnerController@updateApartment');
    Route::delete('/apartments/destroy/{id}', 'OwnerController@destroyApartment');

    /**
     * Rooms
     */
    Route::get('/room', 'OwnerController@indexRooms');
    Route::get('/room/new', 'OwnerController@createRoom');
    Route::post('/room/store', 'OwnerController@storeRoom');
    Route::get('/room/show/{id}', 'OwnerController@showRoom');
    Route::get('/room/edit/{id}', 'OwnerController@editRoom');
    Route::put('/room/update/{id}', 'OwnerController@updateRoom');
    Route::delete('/room/destroy/{id}', 'OwnerController@destroyRoom');

    /**
     * Stats
     */
    Route::get('/stats', 'OwnerController@getStatistics');

    /**
     * Favs
     */
    Route::get('/favorites', 'OwnerController@getFavorites');

    /**
     * Profile
     */
    Route::get('/profile', 'OwnerController@getUserProfile');
    Route::get('/profile/edit', 'OwnerController@editUserProfile');
    Route::put('/profile/update', 'OwnerController@updateUserProfile');
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


/**
 * API routes
 */
Route::group(array('prefix' => 'api/v1'), function()
{
    /**
     * API route for apartments in specific range
     */
    Route::get('/', 'ApiController@index');
    Route::get('/locations', 'ApiController@getLocationsLatLng');
    Route::get('/place', 'ApiController@getLocationsPlace');
    Route::get('/apartmentDetails', 'ApiController@getApartmentDetails');
});
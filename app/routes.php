<?php
/**
 * API routes
 */
Route::get('/api/v1/getLocations', 'ApiController@Method1');


/**
 * ====================================================================
 */
/**
 * Routes for public pages
 */
Route::get('/', 'PublicController@getMainPage');
Route::get('/discover', 'PublicController@getDiscoverPage');
Route::get('//near', 'PublicController@getNearMe');
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
     * Apartments CRUD
     */
    Route::get('/admin/apartments', 'AdminController@indexApartment');
    Route::get('/admin/apartments/new', 'AdminController@createApartment');
    Route::post('/admin/apartments/store', 'AdminController@storeApartment');
    Route::get('/admin/apartments/show/{id}', 'AdminController@showApartment');
    Route::get('/admin/apartments/edit/{id}', 'AdminController@editApartment');
    Route::put('/admin/apartments/update/{id}', 'AdminController@updateApartment');
    Route::delete('/admin/apartments/destroy/{id}', 'AdminController@destroyApartment');
    /**
     * Apartment types CRUD
     */
    Route::get('/admin/apartment_types', 'AdminController@indexApType');
    Route::get('/admin/apartment_types/new', 'AdminController@createApType');
    Route::post('/admin/apartment_types/store', 'AdminController@storeApType');
    Route::get('/admin/apartment_types/show/{id}', 'AdminController@showApType');
    Route::get('/admin/apartment_types/edit/{id}', 'AdminController@editApType');
    Route::put('/admin/apartment_types/update/{id}', 'AdminController@updateApType');
    Route::delete('/admin/apartment_types/destroy/{id}', 'AdminController@destroyApType');

    /**
     * Countries CRUD
     */
    Route::get('/admin/countries', 'AdminController@indexCountry');
    Route::get('/admin/countries/new', 'AdminController@createCountry');
    Route::post('/admin/countries/store', 'AdminController@storeCountry');
    Route::get('/admin/countries/show/{id}', 'AdminController@showCountry');
    Route::get('/admin/countries/edit/{id}', 'AdminController@editCountry');
    Route::put('/admin/countries/update/{id}', 'AdminController@updateCountry');
    Route::delete('/admin/countries/destroy/{id}', 'AdminController@destroyCountry');
    /**
     * Cities CRUD
     */
    Route::get('/admin/cities', 'AdminController@indexCity');
    Route::get('/admin/cities/new', 'AdminController@createCity');
    Route::post('/admin/cities/store', 'AdminController@storeCity');
    Route::get('/admin/cities/show/{id}', 'AdminController@showCity');
    Route::get('/admin/cities/edit/{id}', 'AdminController@editCity');
    Route::put('/admin/cities/update/{id}', 'AdminController@updateCity');
    Route::delete('/admin/cities/destroy/{id}', 'AdminController@destroyCity');
    /**
     * Pictures CRUD
     */
    Route::get('/admin/pictures', 'AdminController@indexPicture');
    Route::get('/admin/pictures/new', 'AdminController@createPicture');
    Route::post('/admin/pictures/store', 'AdminController@storePicture');
    Route::get('/admin/pictures/show/{id}', 'AdminController@showPicture');
    Route::get('/admin/pictures/edit/{id}', 'AdminController@editPicture');
    Route::put('/admin/pictures/update/{id}', 'AdminController@updatePicture');
    Route::delete('/admin/pictures/destroy/{id}', 'AdminController@destroyPicture');

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
<?php


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
Route::post('/Login', 'RegistrationController@loginUser');
Route::get('/logout', 'RegistrationController@logoutUser');
/**
 * ====================================================================
 */

/**
 * Admin routes
 */
Route::group(array('before' => 'auth|admin', 'prefix' => 'admin/'), function () {

    Route::get('/main', 'AdminController@indexAdmin');

    /**
     * Users CRUD
     */

    Route::group(array('prefix' => 'users/'), function () {
        Route::get('', 'AdminController@indexUser');
        Route::get('new', 'AdminController@createUser');
        Route::post('store', 'AdminController@storeUser');
        Route::get('show/{id}', 'AdminController@showUser');
        Route::get('edit/{id}', 'AdminController@editUser');
        Route::put('update/{id}', 'AdminController@updateUser');
        Route::delete('destroy/{id}', 'AdminController@destroyUser');
        Route::get('data', 'AdminController@getUserData');
    });


    /**
     * Apartments CRUD
     */
    Route::group(array('prefix' => 'apartments/'), function () {
        Route::get('', 'AdminController@indexApartment');
        Route::get('new', 'AdminController@createApartment');
        Route::post('store', 'AdminController@storeApartment');
        Route::get('show/{id}', 'AdminController@showApartment');
        Route::get('edit/{id}', 'AdminController@editApartment');
        Route::put('update/{id}', 'AdminController@updateApartment');
        Route::delete('destroy/{id}', 'AdminController@destroyApartment');
        Route::get('data', 'AdminController@getApartmentsData');

    });


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
    Route::group(array('prefix' => 'city/'), function () {
        Route::get('', 'AdminController@indexCity');
        Route::get('/new', 'AdminController@createCity');
        Route::post('/store', 'AdminController@storeCity');
        Route::get('/show/{id}', 'AdminController@showCity');
        Route::get('/edit/{id}', 'AdminController@editCity');
        Route::put('/update/{id}', 'AdminController@updateCity');
        Route::delete('/destroy/{id}', 'AdminController@destroyCity');
        Route::get('data', 'AdminController@getCityData');
    });

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
    Route::group(array('prefix' => 'roles/'), function () {
        Route::get('', 'AdminController@indexRole');
        Route::get('/new', 'AdminController@createRole');
        Route::post('/store', 'AdminController@storeRole');
        Route::get('/show/{id}', 'AdminController@showRole');
        Route::get('/edit/{id}', 'AdminController@editRole');
        Route::put('/update/{id}', 'AdminController@updateRole');
        Route::delete('/destroy/{id}', 'AdminController@destroyRole');
        Route::get('data', 'AdminController@getRolesData');
    });


    /**
     * Rooms CRUD
     */
    Route::group(array('prefix' => 'rooms/'), function () {
        Route::get('', 'AdminController@indexRoom');
        Route::get('/new', 'AdminController@createRoom');
        Route::post('/store', 'AdminController@storeRoom');
        Route::get('/show/{id}', 'AdminController@showRoom');
        Route::get('/edit/{id}', 'AdminController@editRoom');
        Route::put('/update/{id}', 'AdminController@updateRoom');
        Route::delete('/destroy/{id}', 'AdminController@destroyRoom');
        Route::get('data', 'AdminController@getRoomsData');
    });

    /**
     * Fittings
     */
    Route::group(array('prefix' => 'fitting/'), function () {
        Route::get('', 'AdminController@indexFitting');
        Route::get('/new', 'AdminController@createFitting');
        Route::post('/store', 'AdminController@storeFitting');
        Route::get('/show/{id}', 'AdminController@showFitting');
        Route::get('/edit/{id}', 'AdminController@editFitting');
        Route::put('/update/{id}', 'AdminController@updateFitting');
        Route::delete('/destroy/{id}', 'AdminController@destroyFitting');
        Route::get('data', 'AdminController@getFittingsData');
    });

    /**
     * Favorites
     */
    Route::group(array('prefix' => 'favorites/'), function () {
        Route::get('', 'AdminController@indexFavorites');
        Route::get('/new', 'AdminController@createFavorites');
        Route::post('/store', 'AdminController@storeFavorites');
        Route::get('/show/{id}', 'AdminController@showFavorites');
        Route::get('/edit/{id}', 'AdminController@editFavorites');
        Route::put('/update/{id}', 'AdminController@updateFavorites');
        Route::delete('/destroy/{id}', 'AdminController@destroyFavorites');
        Route::get('data', 'AdminController@getFavoritesData');
    });

    /**
     * Ratings
     */
    Route::group(array('prefix' => 'ratings/'), function () {
        Route::get('', 'AdminController@indexRatings');
        Route::get('/new', 'AdminController@createRatings');
        Route::post('/store', 'AdminController@storeRatings');
        Route::get('/show/{id}', 'AdminController@showRatings');
        Route::get('/edit/{id}', 'AdminController@editRatings');
        Route::put('/update/{id}', 'AdminController@updateRatings');
        Route::delete('/destroy/{id}', 'AdminController@destroyRatings');
        Route::get('data', 'AdminController@getRatingsData');
    });


    /**
     * ====================================================================
     */

    /**
     * Push notifications managment
     */
    Route::get('/push', 'AdminController@pushNotification');
    Route::post('/sendPush', 'AdminController@sendPushNotification');

    /**
     * User personal profile managment
     */
    Route::get('/profile', 'AdminController@getUserProfile');
    Route::get('/profile/edit', 'AdminController@editUserProfile');
    Route::put('/profile/update', 'AdminController@updateUserProfile');

    /**
     * System stats owerview
     */
    Route::get('/stats', 'AdminController@getStatistics');

});


/**
 * Owner routes
 */
Route::group(array('before' => 'auth|owner', 'prefix' => 'owner/'), function () {

    Route::get('/', 'OwnerController@indexOwner');

    /**
     * Apartments
     */
    Route::group(array('prefix' => '/apartments'), function () {
        Route::get('', 'OwnerController@indexApartments');
        Route::get('/new', 'OwnerController@createApartment');
        Route::post('/store', 'OwnerController@storeApartment');
        Route::get('/show/{id}', 'OwnerController@showApartment');
        Route::get('/edit/{id}', 'OwnerController@editApartment');
        Route::put('/update/{id}', 'OwnerController@updateApartment');
        Route::delete('/destroy/{id}', 'OwnerController@destroyApartment');
        Route::get('data', 'OwnerController@getApartmentData');
    });


    /**
     * Rooms
     */
    Route::group(array('prefix' => 'room/'), function () {
        Route::get('', 'OwnerController@indexRooms');
        Route::get('/new', 'OwnerController@createRoom');
        Route::post('/store', 'OwnerController@storeRoom');
        Route::get('/show/{id}', 'OwnerController@showRoom');
        Route::get('/edit/{id}', 'OwnerController@editRoom');
        Route::put('/update/{id}', 'OwnerController@updateRoom');
        Route::delete('/destroy/{id}', 'OwnerController@destroyRoom');
        Route::get('data', 'OwnerController@getRoomData');
    });

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
    Route::group(array('prefix' => 'profile/'), function () {
        Route::get('', 'OwnerController@getUserProfile');
        Route::get('/edit', 'OwnerController@editUserProfile');
        Route::put('/update', 'OwnerController@updateUserProfile');
    });

});
/**
 * ====================================================================
 */


/**
 * User routes
 */
Route::group(array('before' => 'auth|user', 'prefix' => 'user/'), function () {

    Route::get('/', 'UserController@indexUser');

});
/**
 * ====================================================================
 * API routes
 */
Route::group(array('prefix' => 'api/v1'), function () {
    /**
     * API route for apartments in specific range
     */
    Route::get('/', 'ApiController@index');
    Route::get('/locations', 'ApiController@getLocationsLatLng');
    Route::get('/place', 'ApiController@getLocationsPlace');
    Route::get('/apartmentDetails', 'ApiController@getApartmentDetails');
    Route::get('/apartmentSpecialOffers', 'ApiController@getApartmentSpecialOffers');

    /**
     * Api mobile user login
     */
    Route::post('/login', 'ApiController@loginUser');

    /**
     * Routes for CURD of user favorites
     */
    Route::post('/getUserFavorites', 'ApiController@getUserFavorites');
    Route::post('/setUserFavorites', 'ApiController@setUserFavorites');
    Route::post('/deleteUserFavorites', 'ApiController@DeleteUserFavorites');

    /**
     * Routes for CRUD of user ratings
     */
    Route::post('/getUserRatings', 'ApiController@getUserRatings');
    Route::post('/setUserRatings', 'ApiController@setUserRatings');

    /**
     * Route for new user mobile registration
     */
    Route::post('/signup', 'ApiController@signupUser');

    /**
     * Route for update user profile
     */
    Route::post('/update/user', 'ApiController@signupUser');


});
/**
 * ====================================================================
 * Laravel session token
 */
Route::get('/auth/token', 'AuthController@token');


/**
 * Routes for frontend
 */
//Route::get('/', 'PublicController@getMainPage');
Route::get('/', function(){return View::make('index');});
Route::get('/special', function(){return View::make('index');});
Route::get('/near', function(){return View::make('index');});
Route::get('/about', function(){return View::make('index');});
Route::get('/apartment/{id}', function(){return View::make('index');});

Route::get('/restricted', 'PublicController@indexRestricted');

/**
 * Routes for mobile webview
 */
Route::get('/mobile/help', function(){return View::make('mobile.help');});
Route::get('/mobile/about', function(){return View::make('mobile.about');});
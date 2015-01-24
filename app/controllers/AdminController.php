<?php

class AdminController extends \BaseController
{

    /**
     * Protecting admin panel from idiots
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('getDashboard')));
    }

    /**
     * Admin panel index page
     */
    public function indexAdmin()
    {

        $users = User::all()->count();
        $bookings = Booking::all()->count();
        $apartments = Apartment::all()->count();

        return View::make('admin.start', compact('admin', 'users', 'apartments', 'bookings'));
    }
    /**
     * ====================================================================
     */
    /**
     * Users CRUD
     */
    public function getUserData()
    {

        $result = DB::table('users')
            ->select('users.id', 'users.name', 'users.surname', 'users.username', 'users.email');

        return Datatables::of($result)
            ->add_column('edit',
                '<a href="users/edit/{{ $id }}" class="btn btn-default"><i class="icon-list-alt"></i>Edit</a>')
            ->make();
    }


    public function indexUser()
    {

        $users = User::with('role')->get();
        return View::make('admin.users.index', compact('users'));
    }

    public function createUser()
    {

        $roles = Role::lists('name', 'id');
        return View::make('admin.users.create', compact('roles'));
    }

    public function storeUser()
    {
        $rules = array(
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'username' => 'required|alpha|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/users/new')->withErrors($validator);
        } else {
            $user = new User();
            $user->name = Input::get('name');
            $user->surname = Input::get('surname');
            $user->username = Input::get('username');
            $user->password = Hash::make(Input::get('password'));
            $user->email = Input::get('email');
            $user->phone = Input::get('phone');
            $user->avatar = 'none';
            $user->activated = 0;
            $user->activation_token = Hash::make(Input::get('password'));
            $user->role_id = Input::get('role');
            $user->save();

            return Redirect::to('/admin/users/');
        }
    }


    public function showUser($id)
    {

        $user = User::where('id', '=', $id)->with('role')->get();
        return View::make('admin.users.show', compact('user'));
    }

    public function editUser($id)
    {

        $user = User::find($id);
        $roles = Role::lists('name', 'id');
        return View::make('admin.users.edit', compact('user', 'roles'));
    }

    public function updateUser($id)
    {
        $rules = array(
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'username' => 'required|alpha',
            'email' => 'required|email',
            'password' => 'required|min:5'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/users/')->withErrors($validator);
        } else {
            $user = User::find($id);
            $user->name = Input::get('name');
            $user->surname = Input::get('surname');
            $user->username = Input::get('username');
            $user->password = Hash::make(Input::get('password'));
            $user->email = Input::get('email');
            $user->phone = Input::get('phone');
            $user->avatar = 'none';
            $user->role_id = Input::get('role');;
            $user->save();

            Session::flash('message', 'Successfully updated user!');
            return Redirect::to('/admin/users/');
        }
    }

    public function destroyUser($id)
    {
        $user = User::find($id);
        $user->delete();

        Session::flash('message', 'Successfully deleted the role!');
        return Redirect::to('/admin/users/');
    }


    /**
     * ====================================================================
     */
    /**
     * Roles CRUD
     */

    public function getRolesData()
    {
        $result = DB::table('roles')
            ->select('roles.name', 'roles.id as id');

        return Datatables::of($result)
            ->add_column('id',
                '<a href="/admin/roles/edit/{{ $id }}" class="btn btn-default"><i class="icon-list-alt"></i>Edit</a>')
            ->make();
    }

    public function indexRole()
    {
        $roles = Role::all();
        return View::make('admin.roles.index', compact('roles'));
    }


    public function createRole()
    {
        return View::make('admin.roles.create');
    }

    public function storeRole()
    {
        $rules = array('name' => 'required|alpha');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/roles/new')->withErrors($validator);
        } else {
            $role = new Role();
            $role->name = Input::get('name');
            $role->save();

            return Redirect::to('/admin/roles/');
        }
    }

    public function showRole($id)
    {

        $role = Role::find($id);
        return View::make('admin.roles.show', compact('role'));
    }

    public function editRole($id)
    {

        $role = Role::find($id);
        return View::make('admin.roles.edit', compact('role'));
    }

    public function updateRole($id)
    {
        $rules = array('name' => 'required|alpha');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/roles/show/' . $id)->withErrors($validator);
        } else {
            $role = Role::find($id);
            $role->name = Input::get('name');
            $role->save();

            Session::flash('message', 'Successfully updated role!');
            return Redirect::to('/admin/roles/show/' . $id);
        }
    }

    public function destroyRole($id)
    {
        $role = Role::find($id);
        $role->delete();

        Session::flash('message', 'Successfully deleted the role!');
        return Redirect::to('/admin/roles/');
    }

    /**
     * Countries CRUD
     * ====================================================================
     */

    public function indexCountry()
    {

        $countries = Country::all();
        return View::make('admin.country.index', compact('countries'));
    }

    public function createCountry()
    {

        return View::make('admin.country.create', compact('admin'));

    }

    public function storeCountry()
    {
        $rules = array('name' => 'required|alpha|unique:country');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/countries/new')->withErrors($validator);
        } else {
            $country = new Country();
            $country->name = Input::get('name');
            $country->save();

            Session::flash('message', 'Successfully added country !');
            return Redirect::to('/admin/countries');
        }
    }

    public function showCountry($id)
    {

        $country = Country::find($id);
        return View::make('admin.country.show', compact('country'));

    }

    public function editCountry($id)
    {
        $country = Country::find($id);
        return View::make('admin.country.edit', compact('country'));
    }

    public function updateCountry($id)
    {
        $rules = array('name' => 'required|alpha|unique:country');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/countries/new')->withErrors($validator);
        } else {
            $country = Country::find($id);
            $country->name = Input::get('name');
            $country->save();

            Session::flash('message', 'Successfully added country !');
            return Redirect::to('/admin/countries');
        }
    }

    public function destroyCountry($id)
    {
        $country = Country::find($id);
        $country->delete();

        Session::flash('message', 'Successfully deleted the role!');
        return Redirect::to('/admin/countries/');
    }

    /**
     * Cities CRUD
     * ====================================================================
     */

    public function getCityData()
    {

        $result = DB::table('city')
            ->join('country', 'country.id', '=', 'city.country_id')
            ->select('city.name as name', 'country.name as country', 'city.lat as lat', 'city.lng as lng',
                'city.id as id');

        return Datatables::of($result)
            ->add_column('id',
                '<a href="city/edit/{{ $id }}" class="btn btn-default"><i class="icon-list-alt"></i>Edit</a>')
            ->make();
    }

    public function indexCity()
    {

        $city = City::with('country')->get();
        return View::make('admin.city.index', compact('city'));
    }

    public function createCity()
    {

        $country = Country::lists('name', 'id');
        return View::make('admin.city.create', compact('country'));
    }

    public function storeCity()
    {
        $rules = array(
            'name' => 'required|alpha',
            'lat' => 'required|regex:/^[+-]?\d+\.\d+$/',
            'lng' => 'required|regex:/^^[+-]?\d+\.\d+$/',
            'country' => 'required|numeric',
        );


        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/city/new')->withErrors($validator);
        } else {
            $city = new City();

            $city->name = Input::get('name');
            $city->lng = Input::get('lng');
            $city->lat = Input::get('lat');
            $city->country_id = Input::get('country');

            $city->save();
            Session::flash('message', 'Successfully added city!');
            return Redirect::to('/admin/city');
        }
    }

    public function showCity($id)
    {

        $city = City::with('country')->where('id', '=', $id)->get();
        return View::make('admin.city.show', compact('city'));
    }

    public function editCity($id)
    {

        $country = Country::lists('name', 'id');
        $city = City::with('country')->where('id', '=', $id)->get();
        return View::make('admin.city.edit', compact('city', 'country'));
    }

    public function updateCity($id)
    {
        $rules = array(
            'name' => 'required|alpha',
            'lat' => 'required|regex:/^[+-]?\d+\.\d+$/',
            'lng' => 'required|regex:/^^[+-]?\d+\.\d+$/',
            'country' => 'required|numeric',
        );


        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/city/edit/' . $id)->withErrors($validator);
        } else {
            $city = City::find($id);
            $city->name = Input::get('name');
            $city->lng = Input::get('lng');
            $city->lat = Input::get('lat');
            $city->country_id = Input::get('country');

            $city->save();
            Session::flash('message', 'Successfully added city!');
            return Redirect::to('/admin/city');
        }

    }

    public function destroyCity($id)
    {
        $city = City::find($id);
        $city->delete();

        Session::flash('message', 'Successfully deleted the role!');
        return Redirect::to('/admin/city');
    }

    /**
     * Apartment types CRUD
     * ====================================================================
     */

    public function indexApType()
    {

        $apartment_types = ApartmentType::all();
        return View::make('admin.apartmentType.index', compact('apartment_types'));
    }

    public function createApType()
    {

        return View::make('admin.apartmentType.create', compact('admin'));
    }

    public function storeApType()
    {
        $rules = array('name' => 'required|alpha|unique:apartment_types');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/apartment_types/new')->withErrors($validator);
        } else {
            $country = new ApartmentType();
            $country->name = Input::get('name');
            $country->save();

            Session::flash('message', 'Successfully added apartment type !');
            return Redirect::to('/admin/apartment_types');
        }
    }

    public function showApType($id)
    {

        $apartment_types = ApartmentType::find($id);
        return View::make('admin.apartmentType.show', compact('apartment_types'));
    }

    public function editApType($id)
    {

        $apartment_types = ApartmentType::find($id);
        return View::make('admin.apartmentType.edit', compact('apartment_types'));
    }

    public function updateApType($id)
    {
        $rules = array('name' => 'required|alpha|unique:apartment_types');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/apartment_types/new')->withErrors($validator);
        } else {
            $country = ApartmentType::find($id);
            $country->name = Input::get('name');
            $country->save();

            Session::flash('message', 'Successfully added apartment type !');
            return Redirect::to('/admin/apartment_types');
        }
    }

    public function destroyApType($id)
    {
        $country = ApartmentType::find($id);
        $country->delete();

        Session::flash('message', 'Successfully deleted the role!');
        return Redirect::to('/admin/apartment_types');
    }

    /**
     * Apartments CRUD
     * ====================================================================
     */

    public function getApartmentsData()
    {

        $result = DB::table('apartments')
            ->join('users', 'users.id', '=', 'apartments.owner_id')
            ->select('apartments.id', 'apartments.name', 'apartments.phone', 'users.username', 'users.email');

        return Datatables::of($result)
            ->add_column('edit',
                '<a href="apartments/edit/{{ $id }}" class="btn btn-default"><i class="icon-list-alt"></i>Edit</a>')
            ->make();
    }

    public function indexApartment()
    {

        $apartments = Apartment::with('user')->get();
        return View::make('admin.apartment.index', compact('apartments'));
    }

    public function createApartment()
    {

        $owners = User::lists('username', 'id');
        $cities = City::lists('name', 'id');
        $types = ApartmentType::lists('name', 'id');

        return View::make('admin.apartment.create', compact('owners', 'cities', 'types'));
    }

    public function storeApartment()
    {
        $rules = array(
            'name' => 'required|regex:/^[A-Za-zŠĐČĆŽšđčćž ]+$/',
            'description' => 'required|regex:/^[A-Za-zŠĐČĆŽšđčćž ]+$/',
            'capacity' => 'numeric',
            'address' => 'required|regex:/^[A-Za-zŠĐČĆŽšđčćž0-9 ]+$/',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'phone_2' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'lat' => 'required|regex:/^[+-]?\d+\.\d+$/',
            'lng' => 'required|regex:/^^[+-]?\d+\.\d+$/'
        );


        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/apartments/new')->withErrors($validator);
        } else {
            $apartment = new Apartment();

            $apartment->name = Input::get('name');
            $apartment->description = Input::get('description');
            $apartment->capacity = Input::get('capacity');
            $apartment->address = Input::get('address');
            $apartment->email = Input::get('email');
            $apartment->phone = Input::get('phone');
            $apartment->phone_2 = Input::get('phone_2');
            $apartment->rating = 0;
            $apartment->lng = Input::get('lng');
            $apartment->lat = Input::get('lat');
            $apartment->owner_id = Input::get('owner');
            $apartment->type_id = Input::get('type');
            $apartment->city_id = Input::get('city');

            $apartment->save();
            Session::flash('message', 'Successfully added apartment type !');
            return Redirect::to('/admin/apartments');
        }
    }

    public function showApartment($id)
    {

        $apartment = Apartment::with('user', 'city')->where('id', '=', $id)->get();
        return View::make('admin.apartment.show', compact('apartment'));
    }

    public function editApartment($id)
    {

        $owners = User::lists('username', 'id');
        $cities = City::lists('name', 'id');
        $types = ApartmentType::lists('name', 'id');
        $apartment = Apartment::find($id);
        return View::make('admin.apartment.edit', compact('apartment', 'owners', 'cities', 'types'));
    }

    public function updateApartment($id)
    {
        $rules = array(
            'name' => 'required|regex:/^[A-Za-zŠĐČĆŽšđčćž ]+$/',
            'description' => 'required',
            'capacity' => 'numeric',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'phone_2' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'lat' => 'required|regex:/^[+-]?\d+\.\d+$/',
            'lng' => 'required|regex:/^^[+-]?\d+\.\d+$/',
            'special' => 'boolean',
            'active' => 'boolean',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('/admin/apartments/edit/' . $id)->withErrors($validator);
        } else {
            $apartment = Apartment::find($id);
            $apartment->name = Input::get('name');
            $apartment->description = Input::get('description');
            $apartment->capacity = Input::get('capacity');
            $apartment->address = Input::get('address');
            $apartment->email = Input::get('email');
            $apartment->phone = Input::get('phone');
            $apartment->phone_2 = Input::get('phone_2');
            $apartment->rating = 0;
            $apartment->lng = Input::get('lng');
            $apartment->lat = Input::get('lat');
            $apartment->owner_id = Input::get('owner');
            $apartment->type_id = Input::get('type');
            $apartment->city_id = Input::get('city');
            $apartment->special = Input::get('special');
            $apartment->active = Input::get('active');
            $apartment->save();
            return Redirect::to('/admin/apartments/edit/' . $id);
        }
    }

    public function destroyApartment($id)
    {
        $apartment = Apartment::find($id);
        $apartment->delete();

        Session::flash('message', 'Successfully deleted the role!');
        return Redirect::to('/admin/apartments');
    }

    /**
     * Fitting CRUD
     * ====================================================================
     */

    public function getFittingsData()
    {

        $result = DB::table('fittings')
            ->select('fittings.name', 'fittings.icon as icon', 'fittings.id as id');

        return Datatables::of($result)
            ->add_column('id',
                '<a href="apartments/edit/{{ $id }}" class="btn btn-default"><i class="icon-list-alt"></i>Edit</a>')
            ->add_column('icon', '<img src="{{$icon}}"/>')
            ->make();
    }


    public function indexFitting()
    {
        $fittings = Fitting::all();
        return View::make('admin.fitting.index', compact('fittings'));
    }

    public function createFitting()
    {

        return View::make('admin.fitting.create', compact('admin'));
    }

    public function storeFitting()
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/fitting/new')->withErrors($validator);

        } else {
            $fitting = new Fitting();
            $fitting->name = Input::get('name');
            $fitting->description = Input::get('description');
            $fitting->save();
            Session::flash('message', 'Successfully added fitting!');
            return Redirect::to('/admin/fitting');
        }
    }

    public function showFitting($id)
    {

        $fitting = Fitting::where('id', '=', $id)->get();
        return View::make('admin.fitting.show', compact('fitting'));
    }

    public function editFitting($id)
    {

        $fitting = Fitting::find($id);
        return View::make('admin.fitting.edit', compact('fitting'));
    }

    public function updateFitting($id)
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/fitting/edit' . $id)->withErrors($validator);

        } else {
            $fitting = Fitting::find($id);
            $fitting->name = Input::get('name');
            $fitting->description = Input::get('description');
            $fitting->save();

            Session::flash('message', 'Successfully added fitting!');
            return Redirect::to('/admin/fitting');
        }
    }


    public function destroyFitting($id)
    {
        $apartment = Fitting::find($id);
        $apartment->delete();

        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('/admin/fitting');
    }

    /**
     * Pictures CRUD ToDo
     * ====================================================================
     */

    public function indexPicture()
    {
        $pictures = Picture::all();
        return View::make('admin.picture.index', compact('pictures'));
    }

    public function createPicture()
    {
        $apartments = Apartment::lists('name', 'id');
        return View::make('admin.picture.create', compact('apartments'));
    }

    public function storePicture()
    {
    }

    public function showPicture($id)
    {
        $pictures = Picture::with('apartment')->where('id', '=', $id)->get();
        return View::make('admin.picture.show', compact('pictures'));
    }

    public function editPicture($id)
    {

    }

    public function updatePicture($id)
    {
    }

    public function destroyPicture($id)
    {
    }

    /**
     * Rooms CRUD
     * ====================================================================
     */

    public function getRoomsData()
    {
        $result = DB::table('rooms')
            ->join('apartments', 'apartments.id', '=', 'rooms.apartment_id')
            ->join('users', 'users.id', '=', 'apartments.owner_id')
            ->select('rooms.name', 'rooms.capacity', 'rooms.stars', 'rooms.price', 'users.username',
                'rooms.id as roomid');

        return Datatables::of($result)
            ->add_column('roomid',
                '<a href="/admin/rooms/edit/{{ $roomid }}" class="btn btn-default"><i class="icon-list-alt"></i>Edit</a>')
            ->make();
    }


    public function indexRoom()
    {
        $rooms = Room::with('apartment')->get();
        return View::make('admin.room.index', compact('rooms'));
    }

    public function createRoom()
    {

        $apartments = Apartment::lists('name', 'id');
        return View::make('admin.room.create', compact('apartments'));
    }

    public function storeRoom()
    {
        $rules = array(
            'apartment' => 'required|numeric',
            'name' => 'required',
            'capacity' => 'numeric',
            'stars' => 'numeric',
            'price' => 'required|numeric',
            'description' => 'required|regex:/^[A-Za-zŠĐČĆŽšđčćž ]+$/',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/rooms/new')->withErrors($validator);
        } else {
            $room = new Room();

            $room->apartment_id = Input::get('apartment');
            $room->name = Input::get('name');
            $room->capacity = Input::get('capacity');
            $room->stars = Input::get('stars');
            $room->price = Input::get('stars');
            $room->description = Input::get('description');

            $room->save();

            Session::flash('message', 'Successfully added room !');
            return Redirect::to('/rooms');
        }
    }

    public function showRoom($id)
    {

        $room = Room::where('id', '=', $id)->with('apartment')->get();
        return View::make('admin.room.show', compact('room'));
    }

    public function editRoom($id)
    {

        $apartments = Apartment::lists('name', 'id');
        $room = Room::where('id', '=', $id)->with('apartment')->get();
        return View::make('admin.room.edit', compact('apartments', 'room'));
    }

    public function updateRoom($id)
    {
        $rules = array(
            'apartment' => 'required|numeric',
            'name' => 'required',
            'capacity' => 'numeric',
            'stars' => 'numeric',
            'price' => 'required|numeric',
            'description' => 'required|regex:/^[A-Za-zŠĐČĆŽšđčćž ]+$/',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/rooms/new')->withErrors($validator);
        } else {
            $room = Room::find($id);

            $room->apartment_id = Input::get('apartment');
            $room->name = Input::get('name');
            $room->capacity = Input::get('capacity');
            $room->stars = Input::get('stars');
            $room->price = Input::get('stars');
            $room->description = Input::get('description');

            $room->save();

            Session::flash('message', 'Successfully added room !');
            return Redirect::to('/rooms');
        }
    }

    public function destroyRoom($id)
    {
        $room = Room::find($id);
        $room->delete();

        Session::flash('message', 'Successfully deleted room!');
        return Redirect::to('/admin/rooms');
    }

    /**
     * Favorites CRUD
     * ====================================================================
     */

    public function getFavoritesData()
    {
        $result = DB::table('user_favorites as uf')
            ->join('apartments', 'apartments.id', '=', 'uf.apartment_id')
            ->join('users', 'users.id', '=', 'uf.user_id')
            ->select('users.username', 'apartments.name', 'uf.title', 'uf.id as ufid');

        return Datatables::of($result)
            ->add_column('ufid',
                '<a href="/admin/favorites/edit/{{ $ufid }}" class="btn btn-default"><i class="icon-list-alt"></i>Edit</a>')
            ->make();
    }

    public function indexFavorites()
    {
        return View::make('admin.favorites.index');
    }


    public function editFavorites($id)
    {
        $favorites = DB::table('user_favorites as uf')
            ->join('apartments', 'apartments.id', '=', 'uf.apartment_id')
            ->join('users', 'users.id', '=', 'uf.user_id')
            ->where('uf.id', '=', $id)
            ->first();
        return View::make('admin.favorites.edit', compact('favorites', 'id'));
    }

    public function updateFavorites($id)
    {
        $rules = array(
            'title' => 'required',
            'description' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/favorites')->withErrors($validator);
        } else {


            $favorite = UserFavorite::find($id);
            $favorite->title = Input::get('title');
            $favorite->description = Input::get('description');

            $favorite->save();

            return Redirect::to('/admin/favorites/edit/' . $id);
        }
    }

    public function destroyFavorites($id)
    {
        $favorite = UserFavorite::find($id);
        $favorite->delete();

        return Redirect::to('/admin/favorites');
    }

    /**
     * Ratings CRUD
     * ====================================================================
     */

    public function getRatingsData()
    {
        $result = DB::table('user_ratings as ur')
            ->join('apartments', 'apartments.id', '=', 'ur.apartment_id')
            ->join('users', 'users.id', '=', 'ur.user_id')
            ->select('users.username', 'apartments.name', 'ur.rating', 'ur.id as urid');

        return Datatables::of($result)
            ->add_column('urid',
                '<a href="/admin/ratings/edit/{{ $urid }}" class="btn btn-default"><i class="icon-list-alt"></i>Edit</a>')
            ->make();
    }


    public function indexRatings()
    {
        $rooms = Room::with('apartment')->get();
        return View::make('admin.ratings.index', compact('rooms'));
    }

    public function editRatings($id)
    {
        $rating = DB::table('user_ratings as us')
            ->join('apartments', 'apartments.id', '=', 'us.apartment_id')
            ->join('users', 'users.id', '=', 'us.user_id')
            ->where('us.id', '=', $id)
            ->first();

        return View::make('admin.ratings.edit', compact('rating', 'id'));
    }

    public function updateRatings($id)
    {
        $rules = array(
            'rating' => 'required|numeric|between:1,5',
            'comment' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/ratings/edit/' . $id)->withErrors($validator);
        } else {
            $rating = UserRating::find($id);
            $rating->rating = Input::get('rating');
            $rating->comment = Input::get('comment');
            $rating->save();
            return Redirect::to('/admin/ratings/');
        }
    }

    public function destroyRatings($id)
    {
        $rating = UserRating::find($id);
        $rating->delete();
        return Redirect::to('/admin/ratings');
    }


    /**
     * Other functionalities ToDo
     * ====================================================================
     */

    public function pushNotification()
    {
        return View::make('admin.pushNotifications.show');
    }

    public function sendPushNotification()
    {

        $rules = array(
            'gcm-message' => 'required',
            'gcm-title' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/push')->withErrors($validator);
        } else {

            $title = Input::get('gcm-title');
            $text = Input::get('gcm-message');
            $message=json_encode(['title'=>$title,'message'=>$text]);


            PushNotification::app('appNameAndroid')
                ->to('APA91bFvusb_U_7b-nEd8GkIGHbylPRMH_Qdjur1IPK--HY_irIXsu1-dnEHAI6cA7ou5lJ7D5kjA1m0gLkWVt9QG0CxYlrT3FDz3B8Sny-olYcOtaJ8cxFRnafPqzejUjfih-CWw1ySn8cG1fEvu7iDsE7SOJAqwms2T--mkMvnB7lPWU6rCm0')
                //->to($devices)
                ->send($message);

            Session::flash('success','Notification sent');
        }


        return View::make('admin.pushNotifications.show');

    }


    public function getUserProfile()
    {
        return View::make('admin.profile.index');
    }

    public function editUserProfile()
    {
        return View::make('admin.profile.edit');
    }

    public function updateUserProfile()
    {
        $rules = array(
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'email' => 'required|email',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/profile/edit')->withErrors($validator);
        } else {

            $user = User::find(Auth::user()->id);
            $user->name = Input::get('name');
            $user->surname = Input::get('surname');
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->phone = Input::get('phone');


            $user->save();

            Session::flash('message', 'Successfully updated role!');
            return Redirect::to('/profile');
        }
    }

    public function getStatistics()
    {

        return View::make('admin.statistics.index', compact('admin'));
    }


}

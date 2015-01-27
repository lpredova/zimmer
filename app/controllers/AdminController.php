<?php

class AdminController extends \BaseController
{
    /**
     * Protecting admin panel from idiots,requires auth and admin role
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('getDashboard')));
    }

    /**
     * Method that shows admin panel index page
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

    /**
     * Method that formats datatables data to show users list
     * @return mixed
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


    /**
     * Method that returns view with users list
     * @return mixed
     */
    public function indexUser()
    {
        $users = User::with('role')->get();
        return View::make('admin.users.index', compact('users'));
    }

    /**
     * Method that shows form for adding new user
     * @return mixed
     */
    public function createUser()
    {
        $roles = Role::lists('name', 'id');
        return View::make('admin.users.create', compact('roles'));
    }

    /**
     * Method that saves user to DB
     * @return mixed
     */
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


    /**
     * Method that shows specific user
     * @param $id
     * @return mixed
     */
    public function showUser($id)
    {
        $user = User::where('id', '=', $id)->with('role')->get();
        return View::make('admin.users.show', compact('user'));
    }

    /**
     * Method that shows form for editing user
     * @param $id
     * @return mixed
     */
    public function editUser($id)
    {
        $user = User::find($id);
        $roles = Role::lists('name', 'id');
        return View::make('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Method that edits user
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that deletes user
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that shows view with users roles
     * @return mixed
     */
    public function indexRole()
    {
        $roles = Role::all();
        return View::make('admin.roles.index', compact('roles'));
    }


    /**
     * Method that shows view for creating users
     * @return mixed
     */
    public function createRole()
    {
        return View::make('admin.roles.create');
    }

    /**
     * Method that saves new role to DB
     * @return mixed
     */
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

    /**
     * Metohd that view with shows specific role
     * @param $id
     * @return mixed
     */
    public function showRole($id)
    {
        $role = Role::find($id);
        return View::make('admin.roles.show', compact('role'));
    }


    /**
     * Method that shows view for editing specific role
     * @param $id
     * @return mixed
     */
    public function editRole($id)
    {
        $role = Role::find($id);
        return View::make('admin.roles.edit', compact('role'));
    }

    /**
     * Method that updates specific role
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that deletes user role
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that returns view vith all countries
     * @return mixed
     */
    public function indexCountry()
    {
        $countries = Country::all();
        return View::make('admin.country.index', compact('countries'));
    }

    /**
     * Method that shows view for creating new country
     * @return mixed
     */
    public function createCountry()
    {
        return View::make('admin.country.create', compact('admin'));

    }

    /**
     * Method that saves country to DB
     * @return mixed
     */
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

    /**
     * Method that shows info about specific county
     * @param $id
     * @return mixed
     */
    public function showCountry($id)
    {
        $country = Country::find($id);
        return View::make('admin.country.show', compact('country'));
    }

    /**
     * Method that shows view for editing specific country
     * @param $id
     * @return mixed
     */
    public function editCountry($id)
    {
        $country = Country::find($id);
        return View::make('admin.country.edit', compact('country'));
    }

    /**
     * Method that updates specific country
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that deletes country
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that formats cities data for datatables
     * @return mixed
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

    /**
     * Method that shows view vith list of all cities
     * @return mixed
     */
    public function indexCity()
    {
        $city = City::with('country')->get();
        return View::make('admin.city.index', compact('city'));
    }

    /**
     * Method that shows view for creating city
     * @return mixed
     */
    public function createCity()
    {
        $country = Country::lists('name', 'id');
        return View::make('admin.city.create', compact('country'));
    }

    /**
     * Method that saves city
     * @return mixed
     */
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

    /**
     * Method that shows specific city
     * @param $id
     * @return mixed
     */
    public function showCity($id)
    {
        $city = City::with('country')->where('id', '=', $id)->get();
        return View::make('admin.city.show', compact('city'));
    }

    /**
     * Method that shows view for editing cities
     * @param $id
     * @return mixed
     */
    public function editCity($id)
    {
        $country = Country::lists('name', 'id');
        $city = City::with('country')->where('id', '=', $id)->get();
        return View::make('admin.city.edit', compact('city', 'country'));
    }

    /**
     * Method that updates cities
     * @param $id
     * @return mixed
     */
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

    /**
     * method that destroys a cities
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that shows list of apartment types
     * @return mixed
     */
    public function indexApType()
    {
        $apartment_types = ApartmentType::all();
        return View::make('admin.apartmentType.index', compact('apartment_types'));
    }

    /**
     * Method that shows view for editing apartment type
     * @return mixed
     */
    public function createApType()
    {
        return View::make('admin.apartmentType.create', compact('admin'));
    }

    /**
     * Method that saves apartment type
     * @return mixed
     */
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

    /**
     * Method that shows apartment type
     * @param $id
     * @return mixed
     */
    public function showApType($id)
    {
        $apartment_types = ApartmentType::find($id);
        return View::make('admin.apartmentType.show', compact('apartment_types'));
    }

    /**
     * Method that shows view for editing apartment type
     * @param $id
     * @return mixed
     */
    public function editApType($id)
    {
        $apartment_types = ApartmentType::find($id);
        return View::make('admin.apartmentType.edit', compact('apartment_types'));
    }

    /**
     * Method that updates apartmetn type
     * @param $id
     * @return mixed
     */
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


    /**
     * Method for destroying apartment type
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that formats the data for datatables
     * @return mixed
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

    /**
     * Method that shows view for creating apartment
     * @return mixed
     */
    public function createApartment()
    {

        $owners = User::lists('username', 'id');
        $cities = City::lists('name', 'id');
        $types = ApartmentType::lists('name', 'id');

        return View::make('admin.apartment.create', compact('owners', 'cities', 'types'));
    }

    /**
     * Method that saves apartment to DB
     * @return mixed
     */
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

    /**
     * Method that shows view for editing specific apartment
     * @param $id
     * @return mixed
     */
    public function showApartment($id)
    {
        $apartment = Apartment::with('user', 'city')->where('id', '=', $id)->get();
        return View::make('admin.apartment.show', compact('apartment'));
    }

    /**
     * Method returns view for editing specific apartment
     * @param $id
     * @return mixed
     */
    public function editApartment($id)
    {
        $owners = User::lists('username', 'id');
        $cities = City::lists('name', 'id');
        $types = ApartmentType::lists('name', 'id');
        $apartment = Apartment::find($id);
        return View::make('admin.apartment.edit', compact('apartment', 'owners', 'cities', 'types'));
    }

    /**
     * Method that updates specific apartment
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that deletes specific apartment
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that formats the data for listing as datatables
     * @return mixed
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


    /**
     * Method that shows list of all fittings
     * @return mixed
     */
    public function indexFitting()
    {
        $fittings = Fitting::all();
        return View::make('admin.fitting.index', compact('fittings'));
    }

    /**
     * Method that shows view for creating fitting
     * @return mixed
     */
    public function createFitting()
    {
        return View::make('admin.fitting.create', compact('admin'));
    }

    /**
     * Method that saves fitting
     * @return mixed
     */
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

    /**
     * Method that shows view for listing all fittings
     * @param $id
     * @return mixed
     */
    public function showFitting($id)
    {

        $fitting = Fitting::where('id', '=', $id)->get();
        return View::make('admin.fitting.show', compact('fitting'));
    }

    /**
     * Method that shows view for editig fitting
     * @param $id
     * @return mixed
     */
    public function editFitting($id)
    {

        $fitting = Fitting::find($id);
        return View::make('admin.fitting.edit', compact('fitting'));
    }

    /**
     * Method that updates specific fitting
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that deletes specific fitting
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that formats the data for the datatables
     * @return mixed
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


    /**
     * Method that shows view with all rooms
     * @return mixed
     */
    public function indexRoom()
    {
        $rooms = Room::with('apartment')->get();
        return View::make('admin.room.index', compact('rooms'));
    }

    /**
     * Method that shows view for adding new room
     * @return mixed
     */
    public function createRoom()
    {

        $apartments = Apartment::lists('name', 'id');
        return View::make('admin.room.create', compact('apartments'));
    }

    /**
     * Method that adds new room
     * @return mixed
     */
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

    /**
     * Method that shows view with all the rooms
     * @param $id
     * @return mixed
     */
    public function showRoom($id)
    {

        $room = Room::where('id', '=', $id)->with('apartment')->get();
        return View::make('admin.room.show', compact('room'));
    }

    /**
     * Method that returns view for editing rooms
     * @param $id
     * @return mixed
     */
    public function editRoom($id)
    {

        $apartments = Apartment::lists('name', 'id');
        $room = Room::where('id', '=', $id)->with('apartment')->get();
        return View::make('admin.room.edit', compact('apartments', 'room'));
    }

    /**
     * Method for updating specific room
     * @param $id
     * @return mixed
     */
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

    /**
     * Method for deleting specific room
     * @param $id
     * @return mixed
     */
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

    /**
     * Method for formating the data for datatables
     * @return mixed
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

    /**
     * Method for showing all favorites
     * @return mixed
     */
    public function indexFavorites()
    {
        return View::make('admin.favorites.index');
    }


    /**
     * Merhod for editing specific favorite
     * @param $id
     * @return mixed
     */
    public function editFavorites($id)
    {
        $favorites = DB::table('user_favorites as uf')
            ->join('apartments', 'apartments.id', '=', 'uf.apartment_id')
            ->join('users', 'users.id', '=', 'uf.user_id')
            ->where('uf.id', '=', $id)
            ->first();
        return View::make('admin.favorites.edit', compact('favorites', 'id'));
    }

    /**
     * Method for updating specific favorite
     * @param $id
     * @return mixed
     */
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

    /**
     * Method for deleting specific favorite
     * @param $id
     * @return mixed
     */
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

    /**
     * Method for formatting data for datatables
     * @return mixed
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


    /**
     * Method for showing all ratings
     * @return mixed
     */
    public function indexRatings()
    {
        $rooms = Room::with('apartment')->get();
        return View::make('admin.ratings.index', compact('rooms'));
    }

    /**
     * Method for editing specific rating
     * @param $id
     * @return mixed
     */
    public function editRatings($id)
    {
        $rating = DB::table('user_ratings as us')
            ->join('apartments', 'apartments.id', '=', 'us.apartment_id')
            ->join('users', 'users.id', '=', 'us.user_id')
            ->where('us.id', '=', $id)
            ->first();

        return View::make('admin.ratings.edit', compact('rating', 'id'));
    }

    /**
     * Method for updating specific rating
     * @param $id
     * @return mixed
     */
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

    /**
     * Method for deleting rating
     * @param $id
     * @return mixed
     */
    public function destroyRatings($id)
    {
        $rating = UserRating::find($id);
        $rating->delete();
        return Redirect::to('/admin/ratings');
    }


    /**
     * Other functionalities
     * ====================================================================
     */

    public function pushNotification()
    {
        return View::make('admin.pushNotifications.show');
    }


    /**
     * Method that takes input from the form and sends push norifications to all users
     * @return mixed
     */
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

            /**
             * Sending GCM message
             */
            $push_message = new PushController();
            $push_message->sendToEverybody($title, $text);

            Session::flash('success', 'Notification sent');
        }
        return View::make('admin.pushNotifications.show');
    }


    /**
     * Method for retrieving user profile
     * @return mixed
     */
    public function getUserProfile()
    {
        return View::make('admin.profile.index');
    }


    /**
     * Method that shows view for editing admin user profile
     * @return mixed
     */
    public function editUserProfile()
    {
        return View::make('admin.profile.edit');
    }


    /**
     * Method for updating users profile
     * @return mixed
     */
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


    /**
     * Method for getting stats about system, Todo
     * @return mixed
     */
    public function getStatistics()
    {
        return View::make('admin.statistics.index', compact('admin'));
    }


}

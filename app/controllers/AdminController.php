<?php

class AdminController extends \BaseController {


    /**
     * Protecting admin panel from idiots
     */
    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth', array('only'=>array('getDashboard')));
    }

    /**
     * Admin panel index page
     */
    public function indexAdmin()
    {
        return View::make('admin.index');
    }
    /**
     * ====================================================================
     */
    /**
     * Users CRUD
     */
    public function indexUser()
    {
        $users = User::all();
        return View::make('admin.users.index',compact('users'));
    }
    public function createUser()
    {
        $roles = Role::lists('name','id');
        return View::make('admin.users.create',compact('roles'));
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
            $user->phone = '0';
            $user->avatar = 'none';
            $user->activated = 0;
            $user->activation_token = Hash::make(Input::get('password'));
            $user->role_id = Input::get('role');;
            $user->save();

            Session::flash('message', 'Successfully updated role!');
            return Redirect::to('/admin/users/');
        }
    }


    public function showUser($id)
    {
        $user = User::find($id);
        return View::make('admin.users.show',compact('user'));
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $roles = Role::lists('name','id');


        return View::make('admin.users.edit',compact('user'),compact('roles'));
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

    public function indexRole()
	{
		$roles = Role::all();
        return View::make('admin.roles.index',compact('roles'));
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
        }
        else{
            $role = new Role();
            $role->name = Input::get('name');
            $role->save();
        }
	}
	public function showRole($id)
	{
        $role = Role::find($id);
        return View::make('admin.roles.show',compact('role'));
    }
	public function editRole($id)
	{
        $role = Role::find($id);
        return View::make('admin.roles.edit',compact('role'));
	}
	public function updateRole($id)
	{
        $rules = array('name' => 'required|alpha');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/roles/show/'.$id)->withErrors($validator);
        }
        else {
            $role = Role::find($id);
            $role->name = Input::get('name');
            $role->save();

            Session::flash('message', 'Successfully updated role!');
            return Redirect::to('/admin/roles/show/'.$id);
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
        return View::make('admin.country.index',compact('countries'));
    }
    public function createCountry()
    {
        return View::make('admin.country.create');

    }
    public function storeCountry()
    {
        $rules = array('name' => 'required|alpha|unique:country');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/countries/new')->withErrors($validator);
        }
        else{
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
        return View::make('admin.country.show',compact('country'));

    }
    public function editCountry($id)
    {
        $country = Country::find($id);
        return View::make('admin.country.edit',compact('country'));
    }
    public function updateCountry($id)
    {
        $rules = array('name' => 'required|alpha|unique:country');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/countries/new')->withErrors($validator);
        }
        else{
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

    public function indexCity()
    {
    }
    public function createCity()
    {
    }
    public function storeCity()
    {
    }
    public function showCity($id)
    {
    }
    public function editCity($id)
    {
    }
    public function updateCity($id)
    {
    }
    public function destroyCity($id)
    {
    }
    /**
     * Apartment types CRUD
     * ====================================================================
     */

    public function indexApType()
    {

    }
    public function createApType()
    {
    }
    public function storeApType()
    {
    }
    public function showApType($id)
    {
    }
    public function editApType($id)
    {
    }
    public function updateApType($id)
    {
    }
    public function destroyApType($id)
    {
    }
    /**
     * Apartments CRUD
     * ====================================================================
     */

    public function indexApartment()
    {
        $apartments = Apartment::all();
        return View::make('admin.apartment.index',compact('apartments'));
    }
    public function createApartment()
    {
    }
    public function storeApartment()
    {
    }
    public function showApartment($id)
    {
    }
    public function editApartment($id)
    {
    }
    public function updateApartment($id)
    {
    }
    public function destroyApartment($id)
    {
    }
    /**
     * Pictures CRUD
     * ====================================================================
     */

    public function indexPicture()
    {
    }
    public function createPicture()
    {
    }
    public function storePicture()
    {
    }
    public function showPicture($id)
    {
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



}

<?php

class RegistrationController extends \BaseController
{

    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    /**
     * Function that checks user login and redirects it to it's user panel
     * @return mixed
     */
    public function loginUser()
    {
        $rules = array(
            'username'    => 'required',
            'password' => 'required|min:5'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));}
        else{
            $userdata = array(
                'username' 	=> Input::get('username'),
                'password' 	=> Input::get('password')
            );

            if (Auth::attempt($userdata)) {

                switch(Auth::user()->role_id){
                    case 1:
                        return Redirect::to('/admin/main');
                        break;
                    case 2:
                        return Redirect::to('/owner');
                        break;
                    case 3:
                        return Redirect::to('/user');
                        break;
                }

            } else {
                return Redirect::to('/login');
            }
        }
    }

    /**
     * Basic logout for all types of users
     * @return mixed
     */
    public function logoutUser(){
        Auth::logout();
        return Redirect::to('/login')->with('message', 'Your are now logged out!');
    }


    /**
     * Showing forms for login and registration
     * @return mixed
     */
    public function createUser()
    {
        return View::make('pages.signupUser');
    }

    public function createOwner()
    {
        return View::make('pages.signupOwner');
    }


    /**
     * Saving registered user
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
            return Redirect::to('/signup')->withErrors($validator);
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
            $user->role_id = 3;
            $user->save();

            Session::flash('message', 'Successfully updated role!');
            return Redirect::to('/login');
        }
    }

    /**
     * Saving registered owner
     * @return mixed
     */
    public function storeOwner()
    {
        $rules = array(
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'username' => 'required|alpha|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'phone' => 'required|numeric|min:6'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/signup')->withErrors($validator);
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
            $user->role_id = 2;
            $user->save();

            Session::flash('message', 'Successfully updated role!');
            return Redirect::to('/login');
        }
    }

}

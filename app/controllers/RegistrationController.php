<?php

class RegistrationController extends \BaseController
{


    /**
     * Function that checks user login and redirects it to it's user panel
     * @return mixed
     */
    public function loginUser()
    {
        /*if (Hash::check('secret', $hashedPassword))
        {
            // The passwords match...
        }*/

        try{
            $user = User::where('username',Input::get('username'))->firstOrFail();
            $user = User::where('email',Input::get('username'))->firstOrFail();
            return Redirect::to('/discover');
        }
        catch(Exception $e){

            return Redirect::to('/login');
        }
    }



    public function createUser()
    {
        return View::make('pages.signupUser');
    }

    public function createOwner()
    {
        return View::make('pages.signupOwner');
    }

    public function storeUser()
    {
        $rules = array( 'name' =>       'required|alpha',
                        'surname'=>     'required|alpha',
                        'username'=>    'required|alpha|unique:users',
                        'email'=>       'required|email|unique:users',
                        'password'=>    'required|min:5'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/signup')->withErrors($validator);
        } else {
            $user = new User();
            $user->name = Input::get('name');
            $user->surname = Input::get('surname');
            $user->username = Input::get('username');
            $user->password =Hash::make(Input::get('password'));
            $user->email = Input::get('email');
            $user->phone = '0';
            $user->avatar = 'none';
            $user->activated = 0;
            $user->activation_token = Hash::make(Input::get('password'));
            $user->user_token = Hash::make(Input::get('username'));;
            $user->role_id = 3;
            $user->save();

            Session::flash('message', 'Successfully updated role!');
            return Redirect::to('/login');
        }
    }


    public function storeOwner()
    {
        $rules = array( 'name' =>       'required|alpha',
            'surname'=>     'required|alpha',
            'username'=>    'required|alpha|unique:users',
            'email'=>       'required|email|unique:users',
            'password'=>    'required|min:5',
            'phone' =>      'required|numeric|min:6'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/signup')->withErrors($validator);
        } else {
            $user = new User();
            $user->name = Input::get('name');
            $user->surname = Input::get('surname');
            $user->username = Input::get('username');
            $user->password =Hash::make(Input::get('password'));
            $user->email = Input::get('email');
            $user->phone = Input::get('phone');
            $user->avatar = 'none';
            $user->activated = 0;
            $user->activation_token = Hash::make(Input::get('password'));
            $user->user_token = Hash::make(Input::get('username'));;
            $user->role_id = 3;
            $user->save();

            Session::flash('message', 'Successfully updated role!');
            return Redirect::to('/login');
        }
    }

}

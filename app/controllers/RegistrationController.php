<?php

class RegistrationController extends \BaseController {

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
        $user = new User;
        $user->name = Input::post('name');
        $user->surname = Input::post('surname');
        $user->username = Input::post('username');
        $user->password = Hash::make(Input::post('password'));
        $user->email = Input::post('email');
        $user->phone = Input::post('phone');
        $user->avatar = Input::post('avatar');
        $user->role = 2;

        $user->save();

        return View::make('pages.homepage');
    }


    public function storeOwner()
    {
        $user = new User;
        $user->name = Input::post('name');
        $user->surname = Input::post('surname');
        $user->username = Input::post('username');
        $user->password = Hash::make(Input::post('password'));
        $user->email = Input::post('email');
        $user->phone = Input::post('phone');
        $user->avatar = Input::post('avatar');
        $user->role = 5;

        $user->save();

        return View::make('pages.homepage');
    }

}

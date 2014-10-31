<?php

class PublicController extends \BaseController
{

    public function getMainPage()
    {
        return View::make('pages.homepage');
    }

    public function getDiscoverPage()
    {
        return View::make('pages.discover');
    }


    public function getNearMe()
    {
        return View::make('pages.near');
    }


    public function getAbout()
    {
        return View::make('pages.about');
    }


    public function getLogin()
    {
        return View::make('pages.login');
    }

    public function getRegister()
    {
        return View::make('pages.register');
    }


}

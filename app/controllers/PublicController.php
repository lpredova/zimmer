<?php

class PublicController extends \BaseController
{

    /**
     * Since we use angular js as frontend framework we DONT! use these methods below
     */

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

    public function indexRestricted()
    {
        return View::make('pages.restricted');
    }


}

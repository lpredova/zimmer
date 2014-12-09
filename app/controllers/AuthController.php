<?php


class AuthController extends \BaseController
{

    public function token()
    {
        return csrf_token();
    }


}

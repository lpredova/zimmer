<?php


class AuthController extends \BaseController
{

    public function token()
    {
        return Response::json(['session_token'=>csrf_token()]);
    }


}

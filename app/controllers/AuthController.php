<?php

class AuthController extends \BaseController
{
    /**
     * Method that provides that external devices can comunicate with Laravel framework
     * It provides users with laravel session token which is theirs valid tag when "talking with laravel"
     * @return mixed
     */
    public function token()
    {
        return Response::json(['session_token' => csrf_token()]);
    }
}

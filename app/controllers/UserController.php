<?php

class UserController extends \BaseController {

	/**
	 * Display dashboard for user
	 * @return Response
	 */
	public function indexUser()
	{
        $user = Auth::user();
        return View::make('user.start',compact('user'));
    }


}

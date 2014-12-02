<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexUser()
	{
        $user = Auth::user();
        return View::make('user.start',compact('user'));
    }


}

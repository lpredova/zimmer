<?php

class OwnerController extends \BaseController {


    /**
     * Protecting admin panel from idiots
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('getDashboard')));
    }



	public function indexOwner()
	{
        return View::make('owner.index');
    }

	public function indexApartments()
	{
        $apartments = Apartment::with('user','city')
            ->where('owner_id','=',Auth::user()->id)
            ->orderBy('id', 'asc')
            ->get();

        return View::make('owner.apartment.index',compact('apartments'));
    }

	public function indexRooms()
	{
        $rooms = DB::table('rooms')
            ->join('apartments','rooms.apartment_id','=','apartments.id')
            ->join('users','users.id','=','apartments.owner_id')
            ->where('users.id','=',Auth::user()->id)
            ->select('rooms.id', 'rooms.name as room_name','rooms.stars','rooms.capacity',
                'rooms.description','rooms.price','apartments.name as apartment_name')
            ->get();

        return View::make('owner.room.index',compact('rooms'));
    }

	public function getStatistics()
	{
        return View::make('owner.stats.index');
    }

	public function getFavorites()
	{
        return View::make('owner.favorites.index');
    }

	public function getUserProfile()
	{
        return View::make('owner.profile.index');
    }




}

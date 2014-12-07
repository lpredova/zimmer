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
        $user = Auth::user();
        return View::make('owner.start',compact('user'));
    }


    /**
     * Apartments CRUD
     * ====================================================================
     */

    public function getApartmentData(){
        $result = DB::table('apartments')
            ->join('users','users.id','=','apartments.owner_id')
            ->where('users.id','=',Auth::user()->id)
            ->select( 'apartments.name as name',
                'apartments.address as address','users.username as owner',
                'apartments.price as price','apartments.id as edit');



        /*$result=Apartment::with('user','city')
            ->where('owner_id','=',Auth::user()->id)
            ->orderBy('id', 'asc')
            ->get();*/

        return Datatables::of($result)
            ->add_column('edit', '<a href="/owner/apartments/edit/{{ $edit }}" class="btn btn-default"><i class="icon-list-alt"></i>Edit</a>')
            ->make();
    }


	public function indexApartments()
	{
        $apartments = Apartment::with('user','city')
            ->where('owner_id','=',Auth::user()->id)
            ->orderBy('id', 'asc')
            ->get();

        return View::make('owner.apartment.index',compact('apartments'));
    }

    public function createApartment()
    {
        $types = ApartmentType::lists('name', 'id');
        $cities = City::lists('name', 'id');
        return View::make('owner.apartment.create', compact('types','cities'));
    }

    public function storeApartment()
    {
        $rules = array(
            'name' => 'required|regex:/^[A-Za-zŠĐČĆŽšđčćž ]+$/',
            'description' => 'required|regex:/^[A-Za-zŠĐČĆŽšđčćž ]+$/',
            'capacity' => 'numeric',
            'address' => 'required|regex:/^[A-Za-zŠĐČĆŽšđčćž0-9 ]+$/',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'phone_2' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'lat' => 'required|regex:/^[+-]?\d+\.\d+$/',
            'lng' => 'required|regex:/^^[+-]?\d+\.\d+$/'
        );


        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/owner/apartments/new')->withErrors($validator);
        } else {
            $apartment = new Apartment();

            $apartment->name = Input::get('name');
            $apartment->description = Input::get('description');
            $apartment->capacity = Input::get('capacity');
            $apartment->address = Input::get('address');
            $apartment->email = Input::get('email');
            $apartment->phone = Input::get('phone');
            $apartment->phone_2 = Input::get('phone_2');
            $apartment->rating = 0;
            $apartment->lng = Input::get('lng');
            $apartment->lat = Input::get('lat');
            $apartment->owner_id = Auth::user()->id;
            $apartment->type_id = Input::get('type');
            $apartment->city_id = Input::get('city');

            $apartment->save();
            Session::flash('message', 'Successfully added apartment type !');
            return Redirect::to('/owner/apartments');
        }
    }

    public function showApartment($id)
    {
        $apartment = Apartment::with('type','city')->where('id', '=', $id)->get();
        return View::make('owner.apartment.show', compact('apartment'));
    }

    public function editApartment($id)
    {
        $owners = User::lists('username', 'id');
        $cities = City::lists('name', 'id');
        $types = ApartmentType::lists('name', 'id');
        $apartment = Apartment::find($id);
        return View::make('owner.apartment.edit', compact('apartment', 'owners', 'cities', 'types'));
    }

    public function updateApartment($id)
    {
        $rules = array(
            'name' => 'required|regex:/^[A-Za-zŠĐČĆŽšđčćž ]+$/',
            'description' => 'required',
            'capacity' => 'numeric',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'phone_2' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'lat' => 'required|regex:/^[+-]?\d+\.\d+$/',
            'lng' => 'required|regex:/^^[+-]?\d+\.\d+$/'
        );


        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/owner/apartments/edit/'.$id)->withErrors($validator);
        } else {
            $apartment = Apartment::find($id);
            $apartment->name = Input::get('name');
            $apartment->description = Input::get('description');
            $apartment->capacity = Input::get('capacity');
            $apartment->address = Input::get('address');
            $apartment->email = Input::get('email');
            $apartment->phone = Input::get('phone');
            $apartment->phone_2 = Input::get('phone_2');
            $apartment->rating = 0;
            $apartment->lng = Input::get('lng');
            $apartment->lat = Input::get('lat');
            $apartment->owner_id = Input::get('owner');
            $apartment->type_id = Input::get('type');
            $apartment->city_id = Input::get('city');

            $apartment->save();
            Session::flash('message', 'Successfully added apartment type !');
            return Redirect::to('/owner/apartments');
        }
    }

    public function destroyApartment($id)
    {
        $apartment = Apartment::find($id);
        $apartment->delete();

        Session::flash('message', 'Successfully deleted the role!');
        return Redirect::to('/owner/apartments');
    }

    /**
     * Rooms CRUD
     * ====================================================================
     */
    public function getRoomData(){
        $result = DB::table('rooms')
            ->join('apartments','rooms.apartment_id','=','apartments.id')
            ->join('users','users.id','=','apartments.owner_id')
            ->where('users.id','=',Auth::user()->id)
            ->select( 'rooms.name as name',
                    'rooms.stars as stars','rooms.capacity as capacity',
                    'rooms.price as price','apartments.name as apartment_name','rooms.id as edit');

        return Datatables::of($result)
            ->add_column('edit', '<a href="/owner/rooms/edit/{{ $edit }}" class="btn btn-default"><i class="icon-list-alt"></i>Edit</a>')
            ->make();
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

    public function createRoom()
    {
        $apartments = Apartment::where('owner_id','=',Auth::user()->id)->lists('name', 'id');
        return View::make('owner.room.create', compact('apartments'));
    }

    public function storeRoom()
    {
        $rules = array(
            'apartment' => 'required|numeric',
            'name' => 'required',
            'capacity' => 'numeric',
            'stars' => 'numeric',
            'price' => 'required|numeric',
            'description' => 'required|regex:/^[A-Za-zŠĐČĆŽšđčćž ]+$/',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/owner/room/new')->withErrors($validator);
        } else {
            $room = new Room();

            $room->apartment_id = Input::get('apartment');
            $room->name = Input::get('name');
            $room->capacity = Input::get('capacity');
            $room->stars = Input::get('stars');
            $room->price = Input::get('stars');
            $room->description = Input::get('description');

            $room->save();

            Session::flash('message', 'Successfully added room !');
            return Redirect::to('/owner/room');
        }
    }

    public function showRoom($id)
    {
        $room = Room::where('id', '=', $id)->with('apartment')->get();
        return View::make('owner.room.show', compact('room'));
    }

    public function editRoom($id)
    {
        $apartments = Apartment::lists('name', 'id');
        $room = Room::where('id', '=', $id)->with('apartment')->get();
        return View::make('owner.room.edit', compact('apartments', 'room'));
    }

    public function updateRoom($id)
    {
        $rules = array(
            'apartment' => 'required|numeric',
            'name' => 'required',
            'capacity' => 'numeric',
            'stars' => 'numeric',
            'price' => 'required|numeric',
            'description' => 'required|regex:/^[A-Za-zŠĐČĆŽšđčćž ]+$/',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/owner/room/edit'.$id)->withErrors($validator);
        } else {
            $room = Room::find($id);

            $room->apartment_id = Input::get('apartment');
            $room->name = Input::get('name');
            $room->capacity = Input::get('capacity');
            $room->stars = Input::get('stars');
            $room->price = Input::get('stars');
            $room->description = Input::get('description');

            $room->save();

            Session::flash('message', 'Successfully added room !');
            return Redirect::to('/owner/room');
        }
    }


    public function destroyRoom($id)
    {
        $room = Room::find($id);
        $room->delete();

        Session::flash('message', 'Successfully deleted room!');
        return Redirect::to('/owner/room');
    }


    /**
     * Stats and favorites and user profile
     * ====================================================================
     */
	public function getStatistics()
	{
        return View::make('owner.stats.index');
    }

    /**
     * Favorites controles
     * @return mixed
     */
	public function getFavorites()
	{
        return View::make('owner.favorites.index');
    }

    /**
     * User profile manipulation
     * @return mixed
     */

	public function getUserProfile()
	{
        return View::make('owner.profile.show');
    }

	public function editUserProfile()
	{
        return View::make('owner.profile.edit');
    }

	public function updateUserProfile()
	{
        $rules = array(
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'email' => 'required|email',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/owner/profile/edit')->withErrors($validator);
        } else {

            $user = User::find(Auth::user()->id);
            $user->name = Input::get('name');
            $user->surname = Input::get('surname');
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->phone = Input::get('phone');


            $user->save();

            Session::flash('message', 'Successfully updated role!');
            return Redirect::to('/owner');
        }
    }




}

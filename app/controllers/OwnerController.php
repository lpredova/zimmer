<?php

class OwnerController extends \BaseController {


    /**
     * Protecting admin panel from idiots for auth and csrf
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('getDashboard')));
    }


    /**
     * Shows main dashoboard for apartment owner
     * @return mixed
     */
    public function indexOwner()
	{
        $user = Auth::user();
        return View::make('owner.start',compact('user'));
    }


    /**
     * Apartments CRUD
     * ====================================================================
     */

    /**
     * Formats owners list of apartments
     * @return mixed
     */
    public function getApartmentData(){
        $result = DB::table('apartments')
            ->join('users','users.id','=','apartments.owner_id')
            ->where('users.id','=',Auth::user()->id)
            ->select( 'apartments.name as name',
                'apartments.address as address','users.username as owner',
                'apartments.price as price','apartments.id as edit');

        return Datatables::of($result)
            ->add_column('edit', '<a href="/owner/apartments/edit/{{ $edit }}" class="btn btn-default"><i class="icon-list-alt"></i>Edit</a>')
            ->make();
    }


    /**
     * Shows view with apartments for that user
     * @return mixed
     */
    public function indexApartments()
	{
        $apartments = Apartment::with('user','city')
            ->where('owner_id','=',Auth::user()->id)
            ->orderBy('id', 'asc')
            ->get();

        return View::make('owner.apartment.index',compact('apartments'));
    }

    /**
     * Method that shows view for adding new apartment
     * @return mixed
     */
    public function createApartment()
    {
        $types = ApartmentType::lists('name', 'id');
        $cities = City::lists('name', 'id');
        return View::make('owner.apartment.create', compact('types','cities'));
    }

    /**
     * method that stores apatments
     * @return mixed
     */
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

    /**
     * Method that shows view with details about specific apartment
     * @param $id
     * @return mixed
     */
    public function showApartment($id)
    {
        $apartment = Apartment::with('type','city')->where('id', '=', $id)->get();
        return View::make('owner.apartment.show', compact('apartment'));
    }

    /**
     * Method that shows view for editing specific apartment
     * @param $id
     * @return mixed
     */
    public function editApartment($id)
    {
        $owners = User::lists('username', 'id');
        $cities = City::lists('name', 'id');
        $types = ApartmentType::lists('name', 'id');
        $apartment = Apartment::find($id);
        return View::make('owner.apartment.edit', compact('apartment', 'owners', 'cities', 'types'));
    }

    /**
     * Method that updates specific apartment
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that deletes specific apartment
     * @param $id
     * @return mixed
     */
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

    /**
     * Method that formats the data for the datatables
     * @return mixed
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


    /**
     * Method that shows view with all rooms
     * @return mixed
     */
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

    /**
     * Method that shows view for adding new room
     * @return mixed
     */
    public function createRoom()
    {
        $apartments = Apartment::where('owner_id','=',Auth::user()->id)->lists('name', 'id');
        return View::make('owner.room.create', compact('apartments'));
    }

    /**
     * Method that adds new room
     * @return mixed
     */
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

    /**
     * Method that shows view with all the rooms
     * @param $id
     * @return mixed
     */
    public function showRoom($id)
    {
        $room = Room::where('id', '=', $id)->with('apartment')->get();
        return View::make('owner.room.show', compact('room'));
    }

    /**
     * Method that returns view for editing rooms
     * @param $id
     * @return mixed
     */
    public function editRoom($id)
    {
        $apartments = Apartment::lists('name', 'id');
        $room = Room::where('id', '=', $id)->with('apartment')->get();
        return View::make('owner.room.edit', compact('apartments', 'room'));
    }

    /**
     * Method for updating specific room
     * @param $id
     * @return mixed
     */
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


    /**
     * Method for deleting specific room
     * @param $id
     * @return mixed
     */
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

    /**
     * Method for showing stats, Todo
     * @return mixed
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
     * Method for retrieving user profile
     * @return mixed
     */
	public function getUserProfile()
	{
        return View::make('owner.profile.show');
    }

    /**
     * Method that shows view for editing owner user profile
     * @return mixed
     */
	public function editUserProfile()
	{
        return View::make('owner.profile.edit');
    }

    /**
     * Method for updating users profile
     * @return mixed
     */
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

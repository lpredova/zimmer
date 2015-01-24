<?php

class ApiController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $apartments = Apartment::all();
        return compact('apartments');
    }

    /**
     * Method that registrates new user to online database and saves phone id
     * for recieving gcm messages
     * params for new user registraion are
     * session token, username,email,password,gcm_phone_id
     *
     * returns succes message with auth token
     */
    public function signupUser()
    {
        $rules = array(
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required',
            'gcm_phone_id' => 'required',
            '_token' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['status' => 400, 'response' => 'Bad Request']);

        } else {
            $user = new User();

            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->gcm_phone_id = Input::get('gcm_phone_id');
            $user->password = Hash::make(Input::get('password'));
            $user->role_id = "3";

            $user->save();

            /**
             * After registration we can  try to authenticate user
             * */
            try {
                if (Auth::attempt(array('username' => $user->username, 'password' => Input::get('password')), true)) {

                    $registrated_user = Auth::user();

                    /**
                     * Sending GCM message
                     */
                    $push_message = new PushController();
                    $push_message->sendThanks($registrated_user->id);

                    return Response::json([
                        'status' => 200,
                        'succes' => 'user registated',
                        'response' => $registrated_user,
                        'remember_token' => Auth::user()->remember_token
                    ]);
                } else {
                    return Response::json(['status' => 401, 'response' => 'Unauthorized']);
                }
            } catch (Exception $e) {
                return Response::json(['status' => 401, 'response' => 'Unauthorized']);
            }
        }
    }


    /**
     * Method that authenticates user
     * @return json resonse with user data and token or error code
     */
    public function loginUser()
    {
        $rules = array(
            'username' => 'required',
            'password' => 'required',
            '_token' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['status' => 400, 'response' => 'Bad Request']);

        } else {
            $username = Input::get('username');
            $password = Input::get('password');

            if (Auth::attempt(array('username' => $username, 'password' => $password), true)) {

                $user = Auth::user();
                return Response::json([
                    'status' => 200,
                    'response' => $user,
                    'remember_token' => Auth::user()->remember_token
                ]);
            } else {
                return Response::json(['status' => 401, 'response' => 'Unauthorized']);
            }
        }
    }


    /**
     * Method that returns list of users favorited apartments
     * @return JSON
     */
    public function getUserFavorites()
    {
        $rules = array(
            'username' => 'required',
            '_token' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['status' => 400, 'response' => 'Bad Request']);
        } else {

            try {
                if ($user = User::where('remember_token', '=', Input::get('_token'))->first()
                ) {
                    $userFavorites = DB::table('user_favorites as uf')
                        ->join('apartments', 'apartments.id', '=', 'uf.apartment_id')
                        ->join('users', 'users.id', '=', 'uf.user_id')
                        ->where('users.id', '=', $user->id)
                        ->get();

                    return Response::json(['status' => 200, 'response' => $userFavorites]);

                } else {
                    return Response::json(['status' => 401, 'response' => 'Unauthorized']);
                }
            } catch (Exception $e) {
                return Response::json(['status' => 400, 'response' => 'Bad Request']);
            }

        }
    }


    /**
     * Method that adds new apartment on users favorite list
     * @return JSON
     */
    public function setUserFavorites()
    {
        $rules = array(
            'username' => 'required',
            '_token' => 'required',
            'apartment' => 'required',
            'title' => '',
            'description' => '',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['status' => 400, 'response' => 'Bad Request']);
        } else {

            if ($user = User::where('remember_token', '=', Input::get('_token'))->firstOrFail()
            ) {

                $favorite = new UserFavorite();
                $favorite->user_id = $user->id;
                $favorite->apartment_id = Input::get('apartment');
                $favorite->title = 'none';
                $favorite->description = 'none';
                $favorite->save();

                return Response::json(['status' => 200, 'response' => 'OK']);

            } else {
                return Response::json(['status' => 401, 'response' => 'Unauthorized']);
            }
        }
    }

    /**
     * Method that adds new apartment on users favorite list
     * @return JSON
     */
    public function deleteUserFavorites()
    {
        $rules = array(
            'username' => 'required',
            '_token' => 'required',
            'apartment' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(['status' => 400, 'response' => 'Bad Request']);
        } else {
            try {
                if ($user = User::where('remember_token', '=', Input::get('_token'))->firstOrFail()
                ) {
                    $favorite = UserFavorite::where('apartment_id', '=', Input::get('apartment'))->where('user_id', '=',
                        $user->id);
                    $favorite->delete();
                    return Response::json(['status' => 200, 'response' => 'Favorite deleted']);
                } else {
                    return Response::json(['status' => 401, 'response' => 'Unauthorized']);
                }
            } catch (Exception $e) {
                return Response::json(['status' => 401, 'response' => 'Unauthorized']);

            }
        }
    }

    /**
     * Method that retuns users rating of some apartment
     * @return mixed
     */
    public function getUserRatings()
    {
        $rules = array(
            'username' => 'required',
            '_token' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['status' => 400, 'response' => 'Bad Request']);
        } else {

            try {
                if ($user = User::where('remember_token', '=', Input::get('_token'))->firstOrFail()
                ) {
                    $userFavorites = DB::table('user_ratings as ur')
                        ->join('apartments', 'apartments.id', '=', 'ur.apartment_id')
                        ->join('users', 'users.id', '=', 'ur.user_id')
                        ->where('users.id', '=', $user->id)
                        ->select('ur.id', 'ur.rating', 'ur.comment', 'ur.created_at', 'ur.updated_at')
                        ->get();

                    return Response::json(['status' => 200, 'response' => $userFavorites]);

                } else {
                    return Response::json(['status' => 401, 'response' => 'Unauthorized']);
                }
            } catch (Exception $e) {
                return Response::json(['status' => 400, 'response' => 'Bad Request']);
            }
        }
    }


    /**
     * Method that sets users rating for specific user
     * @return mixed
     */
    public function setUserRatings()
    {
        $rules = array(
            'username' => 'required',
            '_token' => 'required',
            'rating' => 'required|integer|between:1,5',
            'apartment' => 'required',
            'comment' => ''
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['status' => 400, 'response' => 'Bad Request']);
        } else {
            try {
                if ($user = User::where('remember_token', '=', Input::get('_token'))->first()
                ) {
                    $rating = new UserRating();
                    $rating->user_id = $user->id;
                    $rating->apartment_id = Input::get('apartment');
                    $rating->rating = Input::get('rating');
                    $rating->save();
                    return Response::json(['status' => 200, 'response' => 'OK']);

                } else {
                    return Response::json(['status' => 401, 'response' => 'Unauthorized']);
                }
            } catch (Exception $e) {
                return Response::json(['status' => 400, 'response' => 'Bad Request']);
            }
        }
    }


    /**
     *  Method for getting apartments based on their latitude and longitude
     * @return mixed
     */

    public function getLocationsLatLng()
    {
        $rules = array(
            'lat' => 'required|regex:/^[+-]?\d+\.\d+$/',
            'lng' => 'required|regex:/^[+-]?\d+\.\d+$/',
            'range' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['status' => 400, 'response' => 'Bad Request']);

        } else {

            $lat = Input::get('lat');
            $lng = Input::get('lng');
            $range = Input::get('range');

            $bounds = $this->findApartmentsNearLocation(null, $lat, $lng, $range);
            $apartments = Apartment::with('user', 'city', 'type', 'picture', 'room')
                ->whereBetween('lat', array($bounds[0], $bounds[1]))
                ->whereBetween('lng', array($bounds[2], $bounds[3]))
                ->take(30)
                ->skip(20)
                ->where('active', '=', '1')
                ->remember(10)
                ->get();

            return Response::json(['response' => $this->createResponseWithDistance($apartments, $lat, $lng)]);
        }
    }


    /**
     * Method that returns list of apartments which are listed as special offers
     * Gets user's location as parametar
     * @return mixed
     */
    public function getApartmentSpecialOffers()
    {
        $rules = array(
            'lat' => 'required|regex:/^[+-]?\d+\.\d+$/',
            'lng' => 'required|regex:/^[+-]?\d+\.\d+$/',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(['status' => 400, 'response' => 'Bad Request']);

        } else {
            $lat = Input::get('lat');
            $lng = Input::get('lng');
            try {
                $apartments = Apartment::with('user', 'city', 'type')
                    ->where('special', '=', '1')
                    ->where('active', '=', '1')
                    ->get();

                return Response::json(['response' => $this->createDetailResponseWithDistance($apartments, $lat, $lng)]);
            } catch (Exception $e) {
                return Response::json(['status' => 400, 'response' => 'Bad Request']);
            }

        }
    }

    /**
     *  * Method that returns apartments based on city where they are located
     * It takes our predefined city number as parameter
     * @return mixed
     */
    public function getLocationsPlace()
    {
        $rules = array(
            'city_code' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['status' => 400, 'response' => 'Bad Request']);

        } else {
            $city = Input::get('city_code');
            $apartments = Apartment::with('user', 'city', 'type')
                ->where('city_id', '=', $city)
                ->get();

            return Response::json(['response' => $this->createResponse($apartments)]);
        }
    }


    /**
     * Method that returns rooms,pictures and city of specified apartment
     * @return mixed
     */
    public function getApartmentDetails()
    {
        $rules = array(
            'apartment_id' => 'required|numeric',
            'lat' => 'required|regex:/^[+-]?\d+\.\d+$/',
            'lng' => 'required|regex:/^[+-]?\d+\.\d+$/',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['status' => 400, 'response' => 'Bad Request']);

        } else {
            $lat = Input::get('lat');
            $lng = Input::get('lng');
            try {

                $apartment_id = Input::get('apartment_id');
                $apartments = Apartment::with('user', 'city', 'type', 'picture', 'room')
                    ->where('id', '=', $apartment_id)
                    ->where('active', '=', '1')
                    ->get();

                return Response::json(['response' => $this->createDetailResponseWithDistance($apartments, $lat, $lng)]);
            } catch (Exception $e) {
                return Response::json(['status' => 400, 'response' => 'Bad Request']);
            }
        }
    }


    /**
     * Method that creates custom response with hand picked params
     * @param $apartments
     * @return array
     */
    private function createResponse($apartments)
    {
        $response = array();
        foreach ($apartments as $apartment) {
            $response[] = [
                'id' => $apartment->id,
                'name' => $apartment->name,
                'description' => $apartment->description,
                'capacity' => $apartment->capacity,
                'stars' => $apartment->stars,
                'address' => $apartment->address,
                'email' => $apartment->email,
                'phone' => $apartment->phone,
                'phone_2' => $apartment->phone_2,
                'rating' => $apartment->rating,
                'lat' => $apartment->lat,
                'lng' => $apartment->lng,
                'price' => $apartment->price,
                'cover_photo' => $apartment->cover_photo,
                'city' => $apartment->city->name,
                'type' => $apartment->type->name,
                'user_nickname' => $apartment->user->username,
                'user_email' => $apartment->user->email,
                'user_phone' => $apartment->user->phone,
            ];
        }
        return $response;
    }

    /**
     * Method that creates custom response with hand picked params and calculating distance from geocoordinate A to B
     * @param $apartments
     * @param $lat_user
     * @param $lng_user
     * @return array
     */
    private function createResponseWithDistance($apartments, $lat_user, $lng_user)
    {
        $response = array();
        foreach ($apartments as $apartment) {
            $response[] = [
                'id' => $apartment->id,
                'name' => $apartment->name,
                'description' => $apartment->description,
                'capacity' => $apartment->capacity,
                'stars' => $apartment->stars,
                'address' => $apartment->address,
                'email' => $apartment->email,
                'phone' => $apartment->phone,
                'phone_2' => $apartment->phone_2,
                'rating' => $apartment->rating,
                'lat' => $apartment->lat,
                'lng' => $apartment->lng,
                'price' => $apartment->price,
                'cover_photo' => $apartment->cover_photo,
                'city' => $apartment->city->name,
                'type' => $apartment->type->name,
                'user_nickname' => $apartment->user->username,
                'user_email' => $apartment->user->email,
                'user_phone' => $apartment->user->phone,
                'distance_to' => $this->distanceTo($lat_user, $lng_user, $apartment->lat, $apartment->lng)
            ];
        }
        return $response;
    }

    /**
     * Method that creates detailed response for apartment with custom picked params
     * @param $apartments
     * @return array
     */
    private function createDetailResponseWithDistance($apartments, $lat_user, $lng_user)
    {
        $response = array();
        foreach ($apartments as $apartment) {
            $response[] = [
                'id' => $apartment->id,
                'name' => $apartment->name,
                'description' => $apartment->description,
                'capacity' => $apartment->capacity,
                'stars' => $apartment->stars,
                'address' => $apartment->address,
                'email' => $apartment->email,
                'phone' => $apartment->phone,
                'phone_2' => $apartment->phone_2,
                'rating' => $apartment->rating,
                'price' => $apartment->price,
                'lat' => $apartment->lat,
                'lng' => $apartment->lng,
                'city' => $apartment->city->name,
                'type' => $apartment->type->name,
                'cover_photo' => $apartment->cover_photo,
                'pictures' => $apartment->picture,
                'rooms' => $apartment->room,
                'user_nickname' => $apartment->user->username,
                'user_avatar' => $apartment->user->avatar,
                'user_email' => $apartment->user->email,
                'user_phone' => $apartment->user->phone,
                'distance_to' => $this->distanceTo($lat_user, $lng_user, $apartment->lat, $apartment->lng)
            ];
        }
        return $response;
    }


    /**
     * @param array $filter
     * @param $lat
     * @param $lng
     * @param int $range
     * @return array
     * Method that calculates bounds inside of which we will search for apartments
     */

    private function findApartmentsNearLocation($filter = array(), $lat, $lng, $range)
    {
        $difference = 0.0007;
        $distance = $range != 0 ? ceil($range / 111) : 0;

        // build filter grid with starting locations
        $latitude_from = floatval($lat) - $difference - $distance;
        $latitude_to = floatval($lat) + $difference + $distance;
        $longitude_from = floatval($lng) - $difference - $distance;
        $longitude_to = floatval($lng) + $difference + $distance;

        $filter[] = $latitude_from;
        $filter[] = $latitude_to;
        $filter[] = $longitude_from;
        $filter[] = $longitude_to;

        return $filter;
    }

    /**
     * Method that calculates distance in km between user and apartment
     * @param $lat_user
     * @param $lng_user
     * @param $lat_ap
     * @param $lng_ap
     * @return float
     */
    private function distanceTo($lat_user, $lng_user, $lat_ap, $lng_ap)
    {

        $pi80 = M_PI / 180;
        $lat_user *= $pi80;
        $lng_user *= $pi80;
        $lat_ap*= $pi80;
        $lng_ap *= $pi80;

        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat_ap - $lat_user;
        $dlng = $lng_ap - $lng_user;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat_user) * cos($lat_ap) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;

        return number_format($km, 1);
    }


}

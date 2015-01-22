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
            try{
                if (Auth::attempt(array('username' => $user->username, 'password' => Input::get('password')), true)) {

                    $registrated_user = Auth::user();
                    return Response::json([
                        'status' => 200,
                        'succes' => 'user registated',
                        'response' => $registrated_user,
                        'remember_token' => Auth::user()->remember_token
                    ]);
                } else {
                    return Response::json(['status' => 401, 'response' => 'Unauthorized']);
                }

            }
            catch(Exception $e){
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
     * @return mixed
     * Method for getting apartments based on their latitude and longitude
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

            //range can be 1Km,5Km or 10Km
            $lat = Input::get('lat');
            $lng = Input::get('lng');
            $range = Input::get('range');

            //1 degree is 111 Km !!!
            $bounds = $this->findApartmentsNearLocation(null, $lat, $lng, $range);
            $apartments = Apartment::with('user', 'city', 'type', 'picture', 'room')
                ->whereBetween('lat', array($bounds[0], $bounds[1]))
                ->whereBetween('lng', array($bounds[2], $bounds[3]))
                ->take(30)
                ->skip(30)
                ->where('active', '=', '1')
                ->remember(10)
                ->get();

            return Response::json(['response' => ApiController::createResponse($apartments)]);
        }
    }


    public function getApartmentSpecialOffers()
    {
        try {
            $apartments = Apartment::with('user', 'city', 'type')
                ->where('special', '=', '1')
                ->where('active', '=', '1')
                ->get();

            return Response::json(['response' => ApiController::createDetailResponse($apartments)]);
        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad Request']);
        }

    }

    /**
     * @return mixed
     * Method that returns apartments based on city where they are located
     * It takes our predefined city number as parameter
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

            return Response::json(['response' => ApiController::createResponse($apartments)]);
        }
    }

    public function getApartmentDetails()
    {
        $rules = array(
            'apartment_id' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['response' => 'Bad Request']);

        } else {
            $apartment_id = Input::get('apartment_id');
            $apartments = Apartment::with('user', 'city', 'type', 'picture', 'room')
                ->where('id', '=', $apartment_id)
                ->where('active', '=', '1')
                ->get();

            return Response::json(['response' => ApiController::createDetailResponse($apartments)]);
        }
    }


    private static function createResponse($apartments)
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

    private static function createDetailResponse($apartments)
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

        //this function needs calibration
        // set radius
        //$difference = 0.07;
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
}

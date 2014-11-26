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
            $apartments = Apartment::with('user', 'city', 'type')
                ->whereBetween('lat', array($bounds[0], $bounds[1]))
                ->whereBetween('lng', array($bounds[2], $bounds[3]))
                ->get();

            return Response::json(['status' => 200, 'response' => ApiController::createResponse($apartments)]);
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

            return Response::json(['status' => 200, 'response' => ApiController::createResponse($apartments)]);
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
                'owner_id' => $apartment->owner_id,
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

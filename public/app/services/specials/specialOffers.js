zimmerApp.factory('specialOffers', ['$http', function ($http) {
    return {
        getSpecialOffers: function (geoCoordinates) {
            var params = {
                params: {
                    lat: geoCoordinates.lat,
                    lng: geoCoordinates.lng
                }
            };
            return $http.get("/api/v1/apartmentSpecialOffers", params);
        }
    };
}]);
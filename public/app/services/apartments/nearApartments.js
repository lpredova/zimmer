zimmerApp.factory('nearApartments', ['$http', '$sanitize', function ($http, $sanitize) {
    return {
        getApartments: function (geoCoordinates) {

            var params = {
                params: {
                    lat: geoCoordinates.lat,
                    lng: geoCoordinates.lng,
                    range: 100
                }

            };

            var apartments = $http.get("/api/v1/locations", params);
            return apartments;
        }
    };
}]);

zimmerApp.factory('nearApartments',['$http','$sanitize' ,function ($http, $sanitize) {
    var sanitizeCoordinates = function (geoCoordinates) {
        return {
            lat: $sanitize(geoCoordinates.lat),
            lng: $sanitize(geoCoordinates.lng),
            range: 100
        };
    };

    return {
        getApartments: function (geoCoordinates) {
            var apartments = $http.get("/api/v1/locations", sanitizeCoordinates(geoCoordinates));
            return apartments;
        }
    };
}]);

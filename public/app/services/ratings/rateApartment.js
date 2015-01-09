zimmerApp.factory('rateFactory',function ($http, $sanitize) {

    var sanitizeCredentials = function (favorite) {
        return {
            rating: $sanitize(favorite.rating),
            apartment: $sanitize(favorite.apartment),

            username: $sanitize(favorite.username),
            _token: $sanitize(favorite._token)
        };
    };

    return {
        rate: function (favorite) {
            var response = $http.post("/api/v1/setUserRatings", sanitizeCredentials(favorite));
            return response
        }
    };
});
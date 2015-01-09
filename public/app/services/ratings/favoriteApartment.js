zimmerApp.factory('favoriteFactory',function ($http, $sanitize) {

    var sanitizeCredentials = function (favorite) {
        return {
            apartment: $sanitize(favorite.apartment),
            username: $sanitize(favorite.username),
            _token: $sanitize(favorite.token)
        };
    };

    return {
        favorite: function (favorite) {
            return $http.post("/api/v1/setUserFavorites", sanitizeCredentials(favorite));
        }
    };
});
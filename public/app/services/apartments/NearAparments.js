zimmerApp.factory('NearApartments',function ($http, $sanitize) {

    var sanitizeCredentials = function (credentials) {
        return {
            username: $sanitize(credentials.username),
            password: $sanitize(credentials.password),
            _token: credentials.csrf_token
        };
    };

    return {
        login: function (credentials) {
            var login = $http.post("/Login", sanitizeCredentials(credentials));
            return login;
        }
    };
});
zimmerApp.factory('AuthService',function ($http, $sanitize) {

    var sanitizeCredentials = function (credentials) {
        return {
            username: $sanitize(credentials.username),
            password: $sanitize(credentials.password),
            _token: credentials.csrf_token
        };
    };

    return {
        login: function (credentials) {
            var login = $http.post("/login", sanitizeCredentials(credentials));
            return login;
        }
    };
});
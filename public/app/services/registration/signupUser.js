zimmerApp.factory('SignUpUser',function ($http, $sanitize) {

    var sanitizeCredentials = function (credentials) {
        return {
            ///
            name: $sanitize(credentials.name),
            surname: $sanitize(credentials.surname),
            email: $sanitize(credentials.email),
            username: $sanitize(credentials.username),
            password: $sanitize(credentials.password),
            _token: credentials.csrf_token
        };
    };

    return {
        signup: function (credentials) {
            var registration = $http.post("/register/user", sanitizeCredentials(credentials));
            return registration;
        }
    };
});
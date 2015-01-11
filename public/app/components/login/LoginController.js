zimmerApp.controller('loginCtrl', ['$cookieStore', '$scope', '$location', '$window', 'AuthService',
    function ($cookieStore, $scope, $location, $window, AuthService) {

        /**
         * Getting laravel session token for login request
         * @type {XMLHttpRequest}
         */
        var xhReq = new XMLHttpRequest();
        xhReq.open("GET", "http://" + window.location.hostname + ":" + window.location.port + "/auth/token", false);
        xhReq.send(null);

        var json = xhReq.responseText, obj = JSON.parse(json);

        $scope.error = false
        $scope.credentials = {
            username: '',
            password: '',
            csrf_token: obj.session_token
        };

        $scope.login = function (credentials) {
            AuthService.login($scope.credentials)
                .success(function (data) {
                    if (data.code == 200) {
                        var url = 'http://' + window.location.hostname + ":" + window.location.port + data.url

                        $cookieStore.put("username", data.username);
                        $cookieStore.put("token", data.token);
                        $window.location.href = url
                    }
                    else {
                        $location.path('/login');
                        $scope.error = "Wrong username or password"
                    }

                })
                .error(function (err) {
                    console.log('error')
                });
        }
    }]);

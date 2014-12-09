zimmerApp.controller('loginCtrl',
    function ($scope, $location, $window, AuthService) {

        var xhReq = new XMLHttpRequest();
        xhReq.open("GET", "http://" + window.location.hostname + ":8000/auth/token", false);
        xhReq.send(null);

        $scope.error = false
        $scope.credentials = {
            username: '',
            password: '',
            csrf_token: xhReq.responseText
        };

        $scope.login = function (credentials) {

            AuthService.login($scope.credentials)
                .success(function (data) {
                    if (data.code==200) {
                        var url = 'http://'+window.location.hostname + ':8000' + data.url
                        $window.location.href=url
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
    });

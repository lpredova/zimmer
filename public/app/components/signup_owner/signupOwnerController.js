/**
 * Created by lovro on 08/12/14.
 */



zimmerApp.controller('SignUpOwnerCtrl',  ['$scope', 'SignUpOwner', '$timeout', '$location',
    function ($scope, SignUpOwner, $timeout, $location) {

        var xhReq = new XMLHttpRequest();
        xhReq.open("GET", "http://" + window.location.hostname + ":" + window.location.port + "/auth/token", false);
        xhReq.send(null);

        $scope.error = false;
        $scope.credentials = {
            name: '',
            surname: '',
            username: '',
            email: '',
            phone: '',
            password: '',
            confirmPassword: '',
            csrf_token: xhReq.responseText
        };

        $scope.register = function (credentials) {

            console.log('ajmooo');


            if (credentials.password === credentials.confirmPassword) {

                console.log('ideee');
                SignUpOwner.signup(credentials).then(
                    function (data) {
                        console.log(data.data);

                        if (data.data.code == 200) {
                            $scope.success = true;
                            $timeout(function () {
                                $location.path('/login')
                            }, 5000)
                        }
                        else {
                            $scope.fail = true;
                            $timeout(function () {
                                $scope.fail = false
                            }, 5000)
                        }
                    },
                    function (reason) {
                        $scope.fail = true;

                        $timeout(function () {
                            $scope.fail = false
                        }, 5000)

                    })
            }
            else {
                console.log('err');
                $scope.error = "Please check your password and password confirm";
                $timeout(function () {
                    $scope.error = false
                }, 5000)
            }
        }
    }]);


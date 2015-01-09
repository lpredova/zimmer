zimmerApp.controller('specialCtrl',['$scope','specialOffers',
    function ($scope,specialOffers) {
        $scope.dataLoaded = false

        specialOffers.getSpecialOffers()
            .success(function(data){
                $scope.specials = data.response

                /**
                 * Showing initial notice below the form
                 */
                $scope.beginWriting = function () {
                    $scope.showNotice = true;
                    $scope.showContinueNotice = false;

                    var x = document.getElementById("search-icon-x");
                    x.style.height = 128 + "px";
                    x.style.bottom = 0;
                    x.style.top = 2 + "%";
                }

                /**
                 * after input filed loses focus then kill em all
                 */
                $scope.stopWriting = function () {

                    var x = document.getElementById("search-icon-x");
                    x.style.height = 130 + "px";
                    x.style.bottom = 0 + "%";
                    x.style.top = 0;


                    $scope.showNotice = false;
                    $scope.showContinueNotice = false;

                }

                $scope.clearInput = function () {
                    $scope.new_name = "";
                    $scope.name = "LOVRO";
                    $scope.showContinueNotice = false;
                    $scope.showX = false


                    var x = document.getElementById("input-id");
                    x.style.fontSize = 4 + "em";
                }




                $scope.dataLoaded = true

            })
            .error(function () {
                console.log('error')
            });




    }]);
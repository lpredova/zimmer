zimmerApp.controller('specialCtrl',['$scope','specialOffers',
    function ($scope,specialOffers) {
        $scope.dataLoaded = false

        specialOffers.getSpecialOffers()
            .success(function(data){
                $scope.specials = data.response
                $scope.dataLoaded = true

            })
            .error(function () {
                console.log('error')
            });

    }]);
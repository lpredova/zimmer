zimmerApp.controller('homeCtrl', ['$scope', '$cookieStore', '$rootScope',
    function ($scope, $cookieStore, $rootScope) {
        $rootScope.saved_username = $cookieStore.username
    }]);
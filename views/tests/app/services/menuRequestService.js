myApp.service('menuRequestService', ['$http', function ($http) {
    return function () {
        return $http({
            method: "POST",
            url: "/getMenuRequestData"
        });
    }
}]);
'use strict';

// service that makes request to put data about passed tests
myApp.service('passedTestsService', ['$http', function ($http) {
    return function (emailValue) {
        return $http({
            method: "POST",
            url: "/getPassedTests",
            data: {
                email: emailValue
            }
        });
    }
}]);
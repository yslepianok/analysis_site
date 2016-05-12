'use strict';

// service that makes request to put data about passed tests
myApp.service('testDataService', ['$http', function ($http) {
    return function (emailValue, testNameValue, testResultsValue) {
        return $http({
            method: "POST",
            url: "/testInformation",
            data: {
                email: emailValue,
                testName: testNameValue,
                testResults: testResultsValue
            }
        });
    }
}]);
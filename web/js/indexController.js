var myApp = angular.module('indexApp', []);

myApp.controller('indexController', ['$scope', '$http', function($scope, $http) {
    $http.get("../testing/tests").then(function (response) {
        $scope.testsData = response.data;
    });
}]);

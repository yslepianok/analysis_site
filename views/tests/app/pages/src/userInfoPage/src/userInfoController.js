'use strict';

myApp.controller('userInfoController', ['$scope', 'CONSTANTS', function ($scope, CONSTANTS) {
    var userInfo = JSON.parse(localStorage.getItem(CONSTANTS.LOCAL_STORAGE_KEY));
    $scope.username = userInfo.email;
    $scope.birthDate = userInfo.birthDate;
    $scope.firstName = userInfo.firstName;
    $scope.lastName = userInfo.lastName;
    $scope.relations = userInfo.relations;
    
}]);
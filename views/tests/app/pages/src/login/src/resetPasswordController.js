'use strict';

myApp.controller('resetPasswordController', ['$scope', '$state', 'resetPasswordService', function ($scope, $state, resetPasswordService) {
    $scope.email = "";
    $scope.submit = function() {
        // ... logic to reset password
        resetPasswordService.sendEmail();
        $state.go("loginPageState");
    }
}]);
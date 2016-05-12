'use strict';

myApp.controller('loginController', ['$scope', 'loginService', 'resetPasswordService','registrationCompleteService', '$translate', '$state','CONSTANTS', function ($scope, loginService, resetPasswordService,registrationCompleteService, $translate, $state, CONSTANTS) {
    $scope.emailHasBeenSent = resetPasswordService.emailHasBeenSent;
    $scope.registrationComplete = registrationCompleteService.registrationComplete;
    $scope.loginFailed = false;

    var updateEmailHasBeenSentStatus = function() {
        $scope.emailHasBeenSent = resetPasswordService.emailHasBeenSent;
    }

    var updateRegistrationCompleteStatus = function() {
        $scope.registrationComplete = registrationCompleteService.registrationComplete;
    }
    resetPasswordService.registerObserver(updateEmailHasBeenSentStatus);
    registrationCompleteService.registerObserver(updateRegistrationCompleteStatus);
    
    $scope.submit = function() { 
        loginService($scope.email, $scope.password).then(function successCallback(response) {
            if (!_.isEmpty(response.data)) {
                localStorage.setItem(CONSTANTS.LOCAL_STORAGE_KEY, JSON.stringify(response.data));
                $state.go('mainPageState.userProfile');
            } else { 
                $scope.loginFailed = true;
            }
        }, function errorCallback(response) {
            throw "request failed";
        });
        
    }
}]);
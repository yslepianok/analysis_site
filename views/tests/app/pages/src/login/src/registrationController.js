'use strict';

myApp.controller('registrationController', ['$scope', '$timeout', '$http', '$state', 'registrationCompleteService', function ($scope, $timeout, $http, $state, registrationCompleteService) {
    
    $scope.errorMessage = "";
    $scope.firstName = "";
    $scope.secondName = "";
    $scope.date = "";
    $scope.email = "";

    var existedEmail = false;
    
    $scope.submit = function() {
        if (!($scope.firstPassword === $scope.secondPassword)) { 
            showErrorMessage("Пароли не совпадают. Введите пароль еще раз");
        } else if (!$scope.registrationForm.$valid) { 
            showErrorMessage("Введены неверные данные. убедитесь что все поля не подсвечены красным");
        } else if (existedEmail) {
            showErrorMessage("Такой пользователь уже существует. Введите другой email");
        } else {
            $http({
              method: 'POST',
              url: '/userRegistration',
              data: {
                  firstName: $scope.firstName,
                  lastName: $scope.secondName,
                  birthDate: $scope.date,
                  email: $scope.email,
                  password: $scope.firstPassword
              }
            }).then(function successCallback(response) {
                if (response) {
                    registrationCompleteService.registrationCompleteFn();
                    $state.go("loginPageState");
                }
                // this callback will be called asynchronously
                // when the response is available
            }, function errorCallback(response) {
                showErrorMessage("Произошла ошибка на сервере, попробуйте еще раз чуть позже");
            });
        }
    }

    $scope.checkEmail = function() {

        if ($scope.registrationForm.email.$valid) {
            $http({
                method: 'POST',
                url: '/checkEmail',
                data: {
                    email: $scope.email,
                }
            }).then(function successCallback(response) {
                if (response.data) {
                    showErrorMessage("Такой пользователь уже существует. Введите другой email");
                    existedEmail = true;
                } else {
                    existedEmail = false;
                }
                // this callback will be called asynchronously
                // when the response is available
            }, function errorCallback(response) {

            });
        }

    }

    function showErrorMessage(errorMessage) { 
        $scope.errorMessage = errorMessage;
        $timeout(function() {
            $scope.errorMessage = "";
        }, 3000);
    }
}]);
var myApp = angular.module('authApp', []);

myApp.controller('authController', ['$scope', '$location', '$http', function($scope, $location, $http) {

  $scope.sign_login = 0;
  $scope.flag = 1;
  $scope.error = null;
  $scope.used = {
    "username" : 0,
    "email" : 0,
  }

  $scope.authData = {
    "username" : "",
    "email" : "",
    "password" : "",
    "birthDate" : "",
  }

  $scope.empty = [0,0,0,0];

  $scope.swap = function(value) {
    $scope.sign_login = value;
    for (var i = 0; i < 3; i++) {
      $scope.empty[i] = 0;
    }
  }

  $scope.login = function() {
    let user_info = document.getElementsByName('login');
    $scope.flag = 1;
    if (user_info[0].value === "") {
      $scope.empty[0] = 1;
      $scope.flag = 0;
    }
    if (user_info[1].value === "") {
      $scope.empty[2] = 1;
      $scope.flag = 0;
    }
    if ($scope.flag == 1) {
      $scope.authData.username = user_info[0].value;
      $scope.authData.password = user_info[1].value;
      $http({
  			method: 'POST',
  			url: 'sign',
  			data: $scope.authData,
  			headers: 'Content-Type : application/json'
  		}).then(function successCallback(response) {
          if (response.data === "success") {
            //$scope.sign_login = 2;
            window.location.href = '/';
            window.location.reload();
          }
  		  }, function errorCallback(response) {
  		    console.log("Fail connect");
  		  });
    }
  }

  $scope.registration = function() {
    let user_info = document.getElementsByName('register');
    $scope.flag = 1;
    for (var i = 0; i < user_info.length; i++) {
      if (user_info[i].value === "") {
        $scope.empty[i] = 1;
        $scope.flag = 0;
      }
    }
    if ($scope.flag == 1) {
      $scope.authData.username = user_info[0].value;
      $scope.authData.email = user_info[1].value;
      $scope.authData.password = user_info[2].value;
      $scope.authData.birthDate = user_info[3].value;
      console.log($scope.authData);
      $http({
  			method: 'POST',
  			url: 'registration',
  			data: $scope.authData,
  			headers: 'Content-Type : application/json'
  		}).then(function successCallback(response) {
        if (response.data === "success") {
          $scope.sign_login = 2;
          $scope.error = null;
        }
  		  }, function errorCallback(response) {
          console.log(response.data);
          $scope.error = response.data.message;
  		  });
    }
  }

  $scope.check = function (field, n) {
    let value = document.getElementsByName('register')[n].value;
    if (value == "") {
      return;
    }
    $http({
      method: 'POST',
      url: 'check',
      data: {'field': field, 'value' : value},
      headers: 'Content-Type : application/json'
    }).then(function successCallback(response) {
        if (response.data == false) {
          $scope.used[field] = 1;
        }
        else {
          $scope.used[field] = 0;
        }
      }, function errorCallback(response) {
      });
  }


}]);

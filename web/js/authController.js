var myApp = angular.module('authApp', []);

myApp.controller('authController', ['$scope', '$location', '$http', function($scope, $location, $http) {

  $scope.sign_login = 0;
  $scope.flag = 1;
  $scope.rules = 1;
  $scope.used = {
  	"username" : 0,
  	"email" : 0
  }
  $scope.logError = null;
  $scope.regError = null;

  $scope.fio = null;

  $scope.empty = [0,0,0,0];

  $scope.swap = function(value) {
    $scope.sign_login = value;
    for (var i = 0; i < 3; i++) {
      $scope.empty[i] = 0;
    }
    $scope.logError = null;
    $scope.regError = null;
  }

  $scope.login = function(username, password) {
    $scope.flag = 1;
    if (typeof username == "undefined") {
      $scope.empty[0] = 1;
      $scope.flag = 0;
      $scope.logError = null;
    }
    else {
      $scope.empty[0] = 0;	
    }
    if (typeof password == "undefined") {
      $scope.empty[2] = 1;
      $scope.flag = 0;
      $scope.logError = null;
    }
    else {
    	$scope.empty[2] = 0;
    }
    if ($scope.flag == 1) {
      $http({
  			method: 'POST',
  			url: 'sign',
  			data: {
  			  "username" : username,
  			  "password" : password
  			},
  			headers: 'Content-Type : application/json'
  		}).then(function successCallback(response) {
          if (response.data === "success") {
            window.location.href = '/';
            window.location.reload();
          }
  		  }, function errorCallback(response) {
  		    $scope.logError = 1;
  		  });
    }
  }

  $scope.registration = function(username, email, password, fio, birthDate) {
    $scope.flag = 1;
    if (typeof username == "undefined") {
      $scope.empty[0] = 1;
      $scope.flag = 0;
    }
    else {
      $scope.empty[0] = 0;
    }
    if (typeof email == "undefined") {
      $scope.empty[1] = 1;
      $scope.flag = 0;
    }
    else {
      $scope.empty[1] = 0;
    }
    if (typeof password == "undefined") {
      $scope.empty[2] = 1;
      $scope.flag = 0;
    }
    else {
      $scope.empty[2] = 0;
    }
    if (typeof email == "undefined") {
      $scope.empty[3] = 1;
      $scope.flag = 0;
    }
    else {
      $scope.empty[3] = 0;
    }            
    if ($scope.flag == 1 && $scope.rules == 1) {
      $http({
  			method: 'POST',
  			url: 'registration',
  			data: {
  			  "username" : username,
  			  "email" : email,
          "password" : password,
          "fio" : fio,
  			  "birthDate" : birthDate
  			},
  			headers: 'Content-Type : application/json'
  		}).then(function successCallback(response) {
        if (response.data === "success") {
          $scope.sign_login = 2;
          $scope.regError = null;
        }
  		  }, function errorCallback(response) {
          console.log(response.data);
          $scope.RegError = response.data.message;
  		  });
    }
  }

  $scope.checkUserEmail = function (value, field) {
    $http({
      method: 'POST',
      url: 'check',
      data: {'field': field, 'value' : value},
      headers: 'Content-Type : application/json'
    }).then(function successCallback(response) {
        if (response.data == false) {
          $scope.used[field] = 1;
          $scope.rules = 0;
        }
        else {
          $scope.used[field] = 0;
          $scope.rules = 1;
        }
      }, function errorCallback(response) {
      });
  }

  $scope.doPasConfirm = function(field1, field2) {
  	let text = document.getElementById('pasConfirmText');
  	if (field1 !== field2) {
  		text.innerHTML = "Пароли не совпадают";
  		text.style.color = "red";
  		$scope.rules = 0;
  	}
  	else {
  		text.innerHTML = "Пароли совпадают";
  		text.style.color = "green";
  		$scope.rules = 1;
  	}
  }

  $scope.validateInputData = function(value, field) {
  	let text,
  		regExp;
  	switch (field) {
  	  case "username" : text = document.getElementById('username');
  	  regExp = /[^a-zA-Z0-9_]/g;
  	  if (value.match(regExp) || value.length < 5 || value.length > 25) {
  	    text.style.display = "block";
  	    $scope.rules = 0;
  	    $scope.used[field] = 0;	
  	  }
  	  else {
  	  	text.style.display = "none";
  	  	$scope.checkUserEmail(value, 'username');
  	   	$scope.rules = 1;
  	  }
  	  break;
  	  case "email" : text = document.getElementById('email');
  	    regExp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  	    if (!regExp.test(value)) {
  	      text.style.display = "block";
  	      $scope.rules = 0;
  	      $scope.used[field] = 0;
  	    }
  	    else {
  	      text.style.display = "none";
  	      $scope.checkUserEmail(value, 'email');
  	      $scope.rules = 1;
  	    }
  	  break;
  	  case "password" : text = document.getElementById('password');
  	    regExp = /[^a-zA-Z0-9]/g;
  	    if (value.match(regExp) || value.length < 5 || value.length > 25) {
  	      text.style.display = "block";
  	      $scope.rules = 0;
  	    }
  	    else {
  	      text.style.display = "none";
  	      $scope.rules = 1;
  	    }
  	  break;
  	  case "birthDate" : text = document.getElementById('birthDate');
  	    regExp = /(\d{4})-(\d{2})-(\d{2})/;
  	    if (!value.match(regExp)) {
  	      text.style.display = "block";
  	      $scope.rules = 0;
  	    }
  	    else {
  	      text.style.display = "none";
  	      $scope.rules = 1;
  	    }
  	  break;
  	}
  }

}]);

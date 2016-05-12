'use strict';

// service that makes request to get data about users 
myApp.service('loginService', ['$http', function ($http) {
  return function (emailValue, passwordValue) {
    return $http({
        method: "POST",
        url: "/userEntry",
        data: {
            email: emailValue,
            password: passwordValue
        }
    });
  }
}]);
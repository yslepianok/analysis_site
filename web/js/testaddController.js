var myApp = angular.module('testaddApp', []);

myApp.controller('testaddController', ['$scope', '$http', function($scope, $http) {

  $scope.work = "";
  $http.get("../testing/tests").then(function (response) {
      $scope.testsData = response.data;
  });

  $scope.workWithTest = function(operation) {
    if (operation === "Import") {
      console.log(operation + " Test");
      $scope.work = "import";
    }
    else {
      console.log(operation + " Test");
      $scope.work = "export";
    }
  }

  $scope.exportTest = function(test) {
    let urlT = "test?name=" + test;
    $http({
      method: 'GET',
      url: urlT,
      headers : 'Content-Type : application/json'
    }).then(function successCallback(response) {
        console.log(response.data);
        document.getElementById('exportTest').innerHTML = JSON.stringify(response.data);
      }, function errorCallback(response) {
        console.log("Fail connect");
      });
  }

  $scope.importTest = function() {
    let object = document.getElementById('importTest').value;
    console.log(object);
    $http({
      method: 'POST',
      url: 'insertdb',
      data: object,
      headers: 'Content-Type : application/json'
    }).then(function successCallback(response) {
        console.log(response.data);
      }, function errorCallback(response) {
        console.log(response.data);
      });
  }

}]);

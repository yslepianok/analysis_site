var myApp = angular.module('profileApp', []);

myApp.controller('profileController', ['$scope', '$location', '$http', function($scope, $location, $http) {

  $scope.relative = 0;
  $scope.addRelative = -1;
  $scope.error = null;
  $scope.relatives = [];
  $scope.changeFlag = 0;

  $http.get("../authentication/getuserinfo").then(function (response) {
      $scope.userInfo = response.data;
      for (let i = 0; i < $scope.userInfo.userToUser.length; i++) {
        let nameR = "";
        let birthDateR = "";
        for (let j = 0; j <$scope.userInfo.relations.length; j++) {
          if ($scope.userInfo.userToUser[i].relation_id == $scope.userInfo.relations[j].id) {
            nameR = $scope.userInfo.relations[j].name;
          }
        }
        for (let j = 0; j < $scope.userInfo.relatives.length; j++) {
          if ($scope.userInfo.userToUser[i].user_related_id == $scope.userInfo.relatives[j].id) {
            birthDateR = $scope.userInfo.relatives[j].birth_date;
          }
        }
        $scope.relatives[$scope.relatives.length] = {
          name : nameR,
          birth_date : birthDateR
        }
      }
    },
    function errorCallback(response){
    console.log('Fail connection');
    }
  );

  $scope.funAdd = function(value) {
    if (value == 2) {
      $scope.addRelative = -1;
      return;
    }
    if (value == 1) {
      let birthDate = document.getElementById('birthDate').value;
      if ($scope.relative == 0 || birthDate == "") {
        $scope.error = 1;
        return;
      }
      $scope.error = null;
      $http({
        method: 'POST',
        url: 'addrelative',
        data: {'user_id': $scope.userInfo.userInfo.id, 'relative_id' : $scope.relative.id, 'birthDate' : birthDate},
        headers: 'Content-Type : application/json'
      }).then(function successCallback(response) {
          $scope.error = null;
          $scope.relatives[$scope.relatives.length] = {
            name : $scope.relative.name,
            birth_date : birthDate
          }
        }, function errorCallback(response) {
          $scope.error = response.data.message;
          $scope.addRelative = value*(-1);
        });
    }
    $scope.addRelative = value*(-1);
  }

  $scope.itemSelected = function(value) {
    $scope.relative = value;
  }

  $scope.change = function() {
    $scope.changeFlag = 1;
  }

}]);

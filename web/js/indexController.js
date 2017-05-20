var myApp = angular.module('indexApp', []);

myApp.controller('indexController', ['$scope', '$http', function($scope, $http) {
    $http.get("../testing/tests").then(function (response) {
        $scope.testsData = response.data;
    });

    $scope.itemSelected = function(test){
  		console.log("test "+test.name);
      data = {
        test_id : test.id,
        test_name : test.name
      }
       $http.post('selected', data);/*.then(
	       function(response){
	         console.log("success "+response)
	       },
	       function(response){
           console.log("fail "+response)
	       }
    )*/
  	};
}]);

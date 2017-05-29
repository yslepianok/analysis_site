var myApp = angular.module('antropometricApp', []);

myApp.controller('antropometricController', ['$scope', '$http', function($scope, $http) {
    $http.get("../testing/test?name=antropometric").then(function (response) {
        $scope.testData = response.data;
    });

  $scope.url = 'testingresults';

	$scope.answers = {
    matrix:{
      '1.1':0,'1.2':0,'1.3':0,'1.4':0,'1.5':0,'2.1':0,'2.2':0,'2.3':0,'2.4':0,'2.5':0,
      '3.1':0,'3.2':0,'3.3':0,'3.4':0,'3.5':0,'4.1':0,'4.2':0,'4.3':0,'4.4':0,'4.5':0,
      '5.1':0,'5.2':0,'5.3':0,'5.4':0,'5.5':0,'6.1':0,'6.2':0,'6.3':0,'6.4':0,'6.5':0,
      '7.1':0,'7.2':0,'7.3':0,'7.4':0,'7.5':0,'8.1':0
    },
    raw:{}
  };
	$scope.currentTest = 0;
	$scope.flag = 0;

	$scope.itemSelected = function(answer){
    cells = angular.fromJson(answer.cells);
    angular.forEach(cells, function(value, key) {
        $scope.answers.matrix[key] += cells[key];
    });
    $scope.currentTest++;
	};

	$scope.start = angular.element(document.querySelector('.st'));

	$scope.Start = function()
	{
			$scope.flag = 1;
			$scope.flag2 = 1;
			$scope.currentTest = 0;
      $scope.answers ={
        matrix:{
          '1.1':0,'1.2':0,'1.3':0,'1.4':0,'1.5':0,'2.1':0,'2.2':0,'2.3':0,'2.4':0,'2.5':0,
          '3.1':0,'3.2':0,'3.3':0,'3.4':0,'3.5':0,'4.1':0,'4.2':0,'4.3':0,'4.4':0,'4.5':0,
          '5.1':0,'5.2':0,'5.3':0,'5.4':0,'5.5':0,'6.1':0,'6.2':0,'6.3':0,'6.4':0,'6.5':0,
          '7.1':0,'7.2':0,'7.3':0,'7.4':0,'7.5':0,'8.1':0
        },
        raw:{}
      };
	}

	$scope.saveResults = function () {
		data = {
			user_id:1,
			testing_id:$scope.testData.id,
			data:$scope.answers
		};
		$http.post('saveresults', data).then(
	       function(response){
	         console.log("success "+response)
	       },
	       function(response){
           console.log("fail "+response)
	       }
    	);
	}

}]);

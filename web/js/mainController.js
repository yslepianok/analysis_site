var myApp = angular.module('mainApp', []);

myApp.controller('mainController', ['$scope', '$http', function($scope, $http) {
    $http.get("testing/test?name=colors").then(function (response) {
        $scope.tests = response.data;
    });

  $scope.url = 'testingresults';

	$scope.answers = [];
	/*$scope.currentTest = 0;
	$scope.flag = 0;
	$scope.flag1 = 0;
	$scope.flag2 = 0;
	$scope.sex = -1;*/

	/*$scope.itemSelected = function(testIndex, itemIndex){
		if(testIndex!=4)
		{
			if($scope.flag1==0)
			{
				console.log("test "+testIndex+" answer "+itemIndex);
				$scope.answers[testIndex] = itemIndex;
				$scope.currentTest++;
			}
			else
			{
				testIndex = 4;
				console.log("test "+testIndex+" answer "+itemIndex);
				$scope.answers[testIndex] = itemIndex;
				$scope.currentTest++;
				$scope.flag1 = 0;
			}
		}
		else{
			console.log("test "+testIndex+" Sex "+itemIndex);
			$scope.answers[testIndex] = itemIndex;
			$scope.sex = itemIndex;
			$scope.flag1=1;
		}
	};*/

	$scope.start = angular.element(document.querySelector('.st'));

	$scope.Start = function()
	{
			/*$scope.flag = 1;
			$scope.flag2 = 1;
			$scope.currentTest = 0;*/
	}

	$scope.saveResults = function () {
		/*data = {
			user_id:1,
			testing_id:1,
			raw_data:answers
		};
		$http.post('testingresults', data).then(
	       function(response){
	         // success callback
	       },
	       function(response){
	         // failure callback
	       }
    	);*/
	}

}]);

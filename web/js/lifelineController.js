var myApp = angular.module('lifelineApp', []);

myApp.controller('lifelineController', ['$scope', '$http', function($scope, $http) {
    $http.get("../testing/test?name=lifeline").then(function (response) {
        $scope.testData = response.data;
    });

  $scope.url = 'testingresults';

	$scope.answers = {
		matrix:{
			'1.1':0,'1.2':0,'1.3':0,'1.4':0,'1.5':0,
			'2.1':0,'2.2':0,'2.3':0,'2.4':0,'2.5':0,
			'3.1':0,'3.2':0,'3.3':0,'3.4':0,'3.5':0,
			'4.1':0,'4.2':0,'4.3':0,'4.4':0,'4.5':0,
			'5.1':0,'5.2':0,'5.3':0,'5.4':0,'5.5':0,
			'6.1':0,'6.2':0,'6.3':0,'6.4':0,'6.5':0,
			'7.1':0,'7.2':0,'7.3':0,'7.4':0,'7.5':0,
			'8.1':0
		},
		raw:{}
	};
	$scope.currentTest = 0;
	$scope.flag = 0;
	$scope.t = [[0],[0],[0],[0],[0],[0],[0],[0]];
	
	$scope.itemSelected = function(answer) {
		if ($scope.currentTest < 6)
			$scope.t[$scope.currentTest] = answer.weight;
		else {
			$scope.t[$scope.currentTest] = parseInt(answer.name);
			$scope.t[$scope.t[$scope.currentTest]] += answer.weight; 
		}	
		
		console.log("test "+answer.question_id+"answer "+answer.id);
		$scope.answers.raw[answer.question_id] = answer.id;

		$scope.currentTest++;
	};

	$scope.start = angular.element(document.querySelector('.st'));

	$scope.Start = function(){
		console.log("in start lifeline testing");
		$scope.flag = 1;
		$scope.flag2 = 1;
		$scope.currentTest = 0;
	}

	$scope.treatment = function (){
		var tt = [[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0]];
		var actCells = [
			[8,1,7,3],
			[7,2,7,4],
			[4,1,5,5],
			[6,5,7,5],
			[3,5,3,3],
			[3,1,5,2],
			[6,4,2,5],
			[1,4,4,5],
			[2,3,2,2],
			[5,4,6,2],
			[6,1,2,4],
			[7,1,1,5],
			[3,2,2,1],
			[4,2,5,3],
			[6,3,1,3],
			[5,1,3,4],
			[1,1,4,4],
			[4,3,1,2]
		];
		tt[1] = $scope.t[0];
		tt[0] = $scope.t[1];
		tt[2] = $scope.t[2];
		tt[4] = $scope.t[3];
		tt[9] = $scope.t[4];
		tt[7] = $scope.t[5];
		for (var i = 0; i < 18; i++) {
			$scope.answers.matrix[""+actCells[i][0]+"."+actCells[i][1]] += tt[i]*$scope.testData.weight;
			$scope.answers.matrix[""+actCells[i][2]+"."+actCells[i][3]] += tt[i]*$scope.testData.weight;
		}

	}
	
	$scope.saveResults = function () {
		$scope.treatment();
		data = {
			user_id:localStorage.getItem('userId'),
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

var myApp = angular.module('preferences_of_school_subjectsApp', []);

myApp.controller('preferences_of_school_subjectsController', ['$scope', '$http', function($scope, $http) {
    $http.get("../testing/test?name=preferences_of_school_subjects").then(function (response) {
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
	$scope.Disc = [
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0]
	];
	$scope.itemSelected = function(answer){
		if ($scope.currentTest % 2 == 0)
			$scope.Disc[$scope.currentTest/2][0]=parseInt(answer.name);
		else
			$scope.Disc[($scope.currentTest-1)/2][1]=parseInt(answer.name);
		
		console.log("test "+answer.question_id+"answer "+answer.id);
		$scope.answers.raw[answer.question_id] = answer.id;

		$scope.currentTest++;
	};

	$scope.start = angular.element(document.querySelector('.st'));

	$scope.Start = function(){
		console.log("in start preferences_of_school_subjects testing");
		$scope.flag = 1;
		$scope.flag2 = 1;
		$scope.currentTest = 0;
	}

	$scope.treatment = function (){
		var t = [[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0]];
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
		var school = [
			[0,0,0,0,0,0,0,0,10,0,0,0,0,10,30,0,50,0],
			[10,0,0,0,0,10,30,0,0,0,0,0,20,0,0,30,0,0],
			[0,20,0,30,10,0,0,30,0,0,0,0,0,0,0,0,0,10],
			[0,0,0,40,10,0,0,0,0,0,0,0,20,30,0,0,0,0],
			[0,0,0,10,0,0,0,0,0,0,0,0,90,0,0,0,0,0],
			[5,5,0,30,30,20,0,0,0,0,0,0,10,0,0,0,0,0],
			[0,0,0,10,0,0,0,0,0,0,0,0,90,0,0,0,0,0],
			[0,0,0,0,0,10,0,0,0,0,0,0,0,0,10,20,50,10],
			[10,10,60,0,0,0,0,0,0,10,10,0,0,0,0,0,0,0],
			[0,0,0,0,0,0,0,0,0,20,0,30,0,0,0,20,30,0],
			[0,0,0,0,0,0,0,0,0,0,0,0,10,0,0,90,0,0],
			[0,0,0,0,0,0,0,0,20,0,0,0,10,20,0,40,10,0],
			[0,0,0,0,0,0,10,0,0,0,0,0,70,10,0,10,0,0],
			[0,0,0,10,0,0,0,10,0,0,0,0,0,0,0,0,0,80],
			[0,10,0,70,10,10,0,0,0,0,0,0,0,0,0,0,0,0],
			[30,0,30,0,0,0,0,0,0,10,20,10,0,0,0,0,0,0],
			[0,0,0,0,10,0,0,10,0,0,0,0,0,0,0,0,0,80]
		];
		for (var j = 0, x = 0, y = 0; j < 18; j++) {
			for (var i = 0; i < 17; i++){
				x += (0.75*$scope.Disc[i][0] + 0.25*$scope.Disc[i][1])*school[i][j];
				y += school[i][j];
			}
			t[j] = x/y;
			console.log($scope.testData.weight);
			$scope.answers.matrix[""+actCells[j][0]+"."+actCells[j][1]] += t[j]*$scope.testData.weight;
			$scope.answers.matrix[""+actCells[j][2]+"."+actCells[j][3]] += t[j]*$scope.testData.weight;
		}
	}
	
	$scope.saveResults = function () {
		$scope.treatment();
		data = {
			user_id:localStorage.getItem('userId'),
			testing_id:$scope.testData.id,
			data:$scope.answers
		};
		console.log(data);
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

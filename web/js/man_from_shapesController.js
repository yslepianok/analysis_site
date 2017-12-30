var myApp = angular.module('man_from_shapesApp', []);

myApp.controller('man_from_shapesController', ['$scope', '$http', function($scope, $http) {
    $http.get("../testing/test?name=man_from_shapes").then(function (response) {
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
	$scope.crt = [];
	
	$scope.itemSelected = function(answer){
		$scope.crt[$scope.currentTest]=parseInt(answer.name);
		
		console.log("test "+answer.question_id+"answer "+answer.id);
		$scope.answers.raw[answer.question_id] = answer.id;

		$scope.currentTest++;
	};

	$scope.start = angular.element(document.querySelector('.st'));

	$scope.Start = function(){
		console.log("in start man_from_shapes testing");
		$scope.flag = 1;
		$scope.flag2 = 1;
		$scope.currentTest = 0;
	}
	
	$scope.treatment = function () {
		var C = $scope.crt[0];
		var R = $scope.crt[1];
		var T = $scope.crt[2];
		var c = C/(C+R+T);
		var r = R/(C+R+T);
		var t = T/(C+R+T);
		var dp = 0.28;
		var up = 0.38;
		var U = 0;
		while (U == 0 && up>dp){
			if ((c<=dp && r<=dp && t>=up)||((dp<c && c<=up && dp<r && r<=up && dp<t && t<=up) && ((C+R+T)<12)))
				U = 1;
			else if (c<=dp && r>up && t<=dp)
				U = 2;
			else if (c<=dp && r>up && t>up)
				U = 3;
			else if (c>up && r<=dp && t<=dp)
				U = 4;
			else if (c>up && r<=dp && t>up)
				U = 5;
			else if (c>up && r>up && t<=dp)
				U = 6;
			else if ((dp<c && c<=up && dp<r && r<=up && dp<t && t<=up) && ((C+R+T)>=12))
				U = 7;
			else 
				U = 0;
			if (U == 0){
				up -= 0.01;
				dp += 0.01; 
			}
		}
		if (U>0){
			for (var j = 1; j<6; j++){
				$scope.answers.matrix[U+"."+j] += 3/5;
				console.log("Matrix cell "+"["+U+"."+j+"]"+" Added "+3/5+" = "+$scope.answers.matrix[U+"."+j]);
			}
		}
		if ((U == 1) && (c<=dp && r<=dp && t<=up))
			U = 6;
		else if (U == 2)
			U = 5;
		else if (U == 3)
			U = 4;
		else if (U == 4)
			U = 3;
		else if (U == 5)
			U = 2;
		else if ((U == 6) || (U == 7))
			U = 1;
		else 
			U = 7;
		for (var j = 1; j<6; j++){
			$scope.answers.matrix[U+"."+j] -= 3/5;
			console.log("Matrix cell "+"["+U+"."+j+"]"+" Subed "+3/5+" = "+$scope.answers.matrix[U+"."+j]);
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

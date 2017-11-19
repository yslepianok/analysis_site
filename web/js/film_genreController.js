var myApp = angular.module('film_genreApp', []);

myApp.controller('film_genreController', ['$scope', '$http', function($scope, $http) {
    $http.get("../testing/test?name=film_genre").then(function (response) {
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
	$scope.Dop = [
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0],
		[0,0]
	];

	$scope.itemSelected = function(answer){
		if ($scope.currentTest % 2 == 0)
			$scope.Dop[$scope.currentTest/2][0]=parseInt(answer.name);
		else
			$scope.Dop[($scope.currentTest-1)/2][1]=parseInt(answer.name);
		
		console.log("test "+answer.question_id+"answer "+answer.id);
		$scope.answers.raw[answer.question_id] = answer.id;

		$scope.currentTest++;
	};

	$scope.start = angular.element(document.querySelector('.st'));

	$scope.Start = function(){
		console.log("in start film_genre testing");
		$scope.flag = 1;
		$scope.flag2 = 1;
		$scope.currentTest = 0;
	}

	$scope.treatment = function (){
		var T = {
			matrix:{
				'-1-11-11':1.1,'1-1-111':1.2,'-111-11':1.3,'-1-1-111':1.4,'11111':1.5,
				'-1-111-1':2.1,'11-11-1':2.2,'1-111-1':2.3,'1-11-1-1':2.4,'-11-1-1-1':2.5,
				'-11-1-11':3.1,'1-1111':3.2,'1-11-11':3.3,'11-111':3.4,'-1-1111':3.5,
				'11-1-1-1':4.1,'111-1-1':4.2,'1-1-1-1-1':4.3,'-1-1-1-1-1':4.4,'-1111-1':4.5,
				'-11111':5.1,'11-1-11':5.2,'111-11':5.3,'1-1-1-11':5.4,'-1-1-1-11':5.5,
				'1-1-11-1':6.1,'-1-1-11-1':6.2,'1111-1':6.3,'-111-1-1':6.4,'-1-11-1-1':6.5,
				'-11-11-1':7.3,'-11-111':7.4
			}
		};
		var invers = {
			matrix:{
				'1.1':2.2,'1.2':6.4,'1.3':6.1,'1.4':4.2,'1.5':4.4,
				'2.1':5.2,'2.2':1.1,'2.3':3.1,'2.4':7.4,'2.5':3.2,
				'3.1':2.3,'3.2':2.5,'3.3':7.3,'3.4':6.5,'3.5':4.1,
				'4.1':3.5,'4.2':1.4,'4.3':5.1,'4.4':1.5,'4.5':5.4,
				'5.1':4.3,'5.2':2.1,'5.3':6.2,'5.4':4.5,'5.5':6.3,
				'6.1':1.3,'6.2':5.3,'6.3':5.5,'6.4':1.2,'6.5':3.4,
				'7.3':3.3,'7.4':2.4
			}
		};
		var t = [];
		var cell = [];
		var dp;
		var sumt0 = -1;
		var flag = 0;
		
		while (sumt0>2 || sumt0<0){
			for (var i = 0; i<6; i++){
				if (sumt0 == -1)
					dp = ($scope.Dop[i][1]-$scope.Dop[i][0])/($scope.Dop[i][1]+$scope.Dop[i][0]);
				if (($scope.Dop[i][1] == $scope.Dop[i][0]) && (sumt0 == -1))
					t[i] = 0;
				else if	(Math.abs(dp)>0.2)
					t[i] = Math.sign(dp);
				else
					t[i] = 0;
			}
			sumt0 = 0;
			for (var i = 0; i<5; i++){
				if (t[i] == 0) sumt0++;
			}
			if (sumt0>2)
				dp -= 0.05;
		}
		console.log("summ = "+sumt0);
		console.log("T = "+T.matrix[""+t[0]+t[1]+t[2]+t[3]+t[4]]);
		if (sumt0 == 0){
			flag = 1;
			cell[0] = T.matrix[""+t[0]+t[1]+t[2]+t[3]+t[4]];
			console.log("cell = "+cell[0]);
		}
		else
		if (sumt0 == 1){
			flag = 2;
			for (var i = 0; i<5; i++){
				if (t[i] == 0){
					switch(i){
						case 0:
							cell[0] = T.matrix["1"+t[1]+t[2]+t[3]+t[4]];
							cell[1] = T.matrix["-1"+t[1]+t[2]+t[3]+t[4]];
							break;
						case 1:
							cell[0] = T.matrix[""+t[0]+"1"+t[2]+t[3]+t[4]];
							cell[1] = T.matrix[""+t[0]+"-1"+t[2]+t[3]+t[4]];
							break;
						case 2:
							cell[0] = T.matrix[""+t[0]+t[1]+"1"+t[3]+t[4]];
							cell[1] = T.matrix[""+t[0]+t[1]+"-1"+t[3]+t[4]];
							break;
						case 3:
							cell[0] = T.matrix[""+t[0]+t[1]+t[2]+"1"+t[4]];
							cell[1] = T.matrix[""+t[0]+t[1]+t[2]+"-1"+t[4]];
							break;
						case 4:
							cell[0] = T.matrix[""+t[0]+t[1]+t[2]+t[3]+"1"];
							cell[1] = T.matrix[""+t[0]+t[1]+t[2]+t[3]+"-1"];
							break;
					}
					break;
				}
			}
		}
		else
		if (sumt0 == 2){
			flag = 4;
			for (var i = 0, n = 0; i<5; i++){
				if (t[i] == 0){
					switch(i){
						case 0:
							cell[n] = T.matrix["1"+t[1]+t[2]+t[3]+t[4]];
							cell[n+1] = T.matrix["-1"+t[1]+t[2]+t[3]+t[4]];
							break;
						case 1:
							cell[n] = T.matrix[""+t[0]+"1"+t[2]+t[3]+t[4]];
							cell[n+1] = T.matrix[""+t[0]+"-1"+t[2]+t[3]+t[4]];
							break;
						case 2:
							cell[n] = T.matrix[""+t[0]+t[1]+"1"+t[3]+t[4]];
							cell[n+1] = T.matrix[""+t[0]+t[1]+"-1"+t[3]+t[4]];
							break;
						case 3:
							cell[n] = T.matrix[""+t[0]+t[1]+t[2]+"1"+t[4]];
							cell[n+1] = T.matrix[""+t[0]+t[1]+t[2]+"-1"+t[4]];
							break;
						case 4:
							cell[n] = T.matrix[""+t[0]+t[1]+t[2]+t[3]+"1"];
							cell[n+1] = T.matrix[""+t[0]+t[1]+t[2]+t[3]+"-1"];
							break;
					}
					n += 2;
				}
			}
		}
		
		switch(flag){
			case 1:
				$scope.answers.matrix[cell[0]] += 1;
				console.log("matrix+ = "+$scope.answers.matrix[cell[0]]);
				$scope.answers.matrix[invers.matrix[cell[0]]] -= 1;
				console.log("matrix- = "+$scope.answers.matrix[invers.matrix[cell[0]]]);
				break;
			case 2:
				$scope.answers.matrix[cell[0]] += 0.5;
				$scope.answers.matrix[cell[1]] += 0.5;
				$scope.answers.matrix[invers.matrix[cell[0]]] -= 0.5;
				$scope.answers.matrix[invers.matrix[cell[1]]] -= 0.5;
				break;
			case 4:
				for (var i =0; i<4; i++){
					$scope.answers.matrix[cell[i]] += 0.25;
					$scope.answers.matrix[invers.matrix[cell[i]]] -= 0.25;
				}
				break;
		}
	}
	
	$scope.saveResults = function () {
		$scope.treatment();
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

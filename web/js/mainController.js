var myApp = angular.module('mainApp', []);

myApp.controller('mainController', ['$scope', '$http', function($scope, $http) {
    $scope.tests = [
    {
		text:"Выберите один из вариантов, который наиболее похож на ваш.",
		items: [
			"img/testimg/test1/h_fingers_1.jpg",
			"img/testimg/test1/h_fingers_2.jpg",
			"img/testimg/test1/h_fingers_3.jpg"
		]
	},
	{
		text:"Выберите один из вариантов, который наиболее похож на ваш.",
		items: [
			"img/testimg/test2/f_fingers_1.jpg",
			"img/testimg/test2/f_fingers_2.jpg",
			"img/testimg/test2/f_fingers_3.jpg",
			"img/testimg/test2/f_fingers_4.jpg",
			"img/testimg/test2/f_fingers_5.jpg"
		]
	},
	{
		text:"Выберите один из вариантов, который наиболее похож на ваш.",
		items: [
			"img/testimg/test3/eyes_1.jpg",
			"img/testimg/test3/eyes_2.jpg",
			"img/testimg/test3/eyes_3.jpg",
			"img/testimg/test3/eyes_4.jpg",
			"img/testimg/test3/eyes_5.jpg"
		]
	},
	{
		text:"Выберите один из вариантов, который наиболее похож на ваш.",
		items: [
			"img/testimg/test4/nail_1.jpg",
			"img/testimg/test4/nail_2.jpg",
			"img/testimg/test4/nail_3.jpg",
			"img/testimg/test4/nail_4.jpg",
			"img/testimg/test4/nail_5.jpg"
		]
	},
	{
		text:"Выберите ваш пол.",
		items : [		
			"img/testimg/test5/man.jpg",
			"img/testimg/test5/woman.jpg"	  	
		]
	},
			{
		text:"Выберите один из вариантов, который наиболее похож на ваш.",
		items: [
			"img/testimg/test6/head_1.jpg",
			"img/testimg/test6/head_2.jpg",
			"img/testimg/test6/head_3.jpg",
			"img/testimg/test6/head_4.jpg",
			"img/testimg/test6/head_5.jpg"
		]
	}
	];

	$scope.bodys = [
	{
		text:"Выберите один из вариантов, который наиболее похож на ваш",
		items: [
			"img/testimg/test5/man_1.jpg",
			"img/testimg/test5/man_2.jpg",
			"img/testimg/test5/man_3.jpg",
			"img/testimg/test5/man_4.jpg",
			"img/testimg/test5/man_5.jpg"
		]
	},
	{
		text:"Выберите один из вариантов, который наиболее похож на ваш",
		items: [
			"img/testimg/test5/woman_1.jpg",
			"img/testimg/test5/woman_2.jpg",
			"img/testimg/test5/woman_3.jpg",
			"img/testimg/test5/woman_4.jpg",
			"img/testimg/test5/woman_5.jpg"
		]
	}	
	];

    $scope.url = 'testingresults';

	$scope.answers = [];
	$scope.currentTest = 0;
	$scope.flag = 0;
	$scope.flag1 = 0;
	$scope.flag2 = 0;
	$scope.sex = -1;

	$scope.itemSelected = function(testIndex, itemIndex){
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
	};

	$scope.start = angular.element(document.querySelector('.st'));

	$scope.Start = function()
	{
			$scope.flag = 1;
			$scope.flag2 = 1;
			$scope.currentTest = 0;
	}

	$scope.saveResults = function () {
		data = {
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
    	);
	}

}]);
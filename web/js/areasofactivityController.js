var myApp = angular.module('areasofactivityApp', []);

myApp.controller('areasofactivityController', ['$scope', '$http', function($scope, $http) {
    $http.get("../areasofactivity/activity").then(function (response) {
        $scope.Data = response.data;
    });

  $scope.flag = 0;

	$scope.result ={
    matrix:{
      '1.1':0,'1.2':0,'1.3':0,'1.4':0,'1.5':0,'1.6':0,'1.7':0,'1.8':0,'1.9':0,'1.10':0,
      '1.11':0,'1.12':0,'1.13':0,'1.14':0,'1.15':0,'1.16':0,'1.17':0,'1.18':0
    },
  };

  $scope.usertotesting = [];


	$scope.getInformation = function () {
    $http.get("../areasofactivity/information?user_id=1").then(function (response) {
        $scope.usertotesting = response.data;
        var value =[];

        for(j=0;j<$scope.usertotesting.length;j++){
          value[j] = angular.fromJson($scope.usertotesting[j].calculated_results);
          for(i=0;i<18;i++){
            $scope.result.matrix['1.'+(i+1)] += value[j][$scope.Data[i].pair_one];
            $scope.result.matrix['1.'+(i+1)] += value[j][$scope.Data[i].pair_two];
          }
        }
        console.log("works");
        for(i=0;i<17;i++)
          for(j=i;j<18;j++)
            if($scope.result.matrix['1.'+(i+1)]<$scope.result.matrix['1.'+(j+1)]){
              var buf1 = $scope.result.matrix['1.'+(i+1)];
              var buf2 = $scope.Data[i];
              $scope.result.matrix['1.'+(i+1)] = $scope.result.matrix['1.'+(j+1)];
              $scope.result.matrix['1.'+(j+1)] = buf1;
              $scope.Data[i] = $scope.Data[j];
              $scope.Data[j] = buf2;
            }
        $scope.flag = 1;
      },
      function(response){
        console.log("not get information!");
      });
	}

}]);

'use strict';

myApp.controller('addRelationController',[ '$scope', '$uibModalInstance', 'CONSTANTS', '$rootScope', '$http', function ($scope, $uibModalInstance, CONSTANTS, $rootScope, $http) {

    $scope.relationOptions = ['Мама', 'Отец', 'Брат'];
    $scope.relationType = {
        type: null
    }
    $scope.ok = function () {
        
        if ($scope.addARelationForm.$valid) { // if form is valid
            var userInfo = JSON.parse(localStorage.getItem(CONSTANTS.LOCAL_STORAGE_KEY));
            var relationInstance = {
                relationType: $scope.relationType.type,
                birthDate: $scope.date,
                firstName: $scope.firstName,
                lastName: $scope.lastName,
            };
            
            $http({
              method: 'POST',
              url: '/addRelation',
              data: {
                  email: userInfo.email,
                  relation: relationInstance
              }
            }).then(function successCallback(response) {
                userInfo.relations.push(relationInstance);
                localStorage.setItem(CONSTANTS.LOCAL_STORAGE_KEY, JSON.stringify(userInfo));
                $rootScope.$emit('relationsUpdated', userInfo.relations);
                
              }, function errorCallback(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
            });
            $uibModalInstance.close();
            
            
            
        }
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    

}]);
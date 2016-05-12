'use strict';

myApp.controller('removeRelationController',[ '$scope', '$uibModalInstance', 'CONSTANTS', '$rootScope', 'index', function ($scope, $uibModalInstance, CONSTANTS, $rootScope, index) {

    
    $scope.ok = function () {
        var userInfo = JSON.parse(localStorage.getItem(CONSTANTS.LOCAL_STORAGE_KEY));
        
        userInfo.relations = _.remove(userInfo.relations, function(n) {
          return n != userInfo.relations[index];
        });
        localStorage.setItem(CONSTANTS.LOCAL_STORAGE_KEY, JSON.stringify(userInfo));
        $rootScope.$emit('relationRemoved', userInfo.relations);
        $uibModalInstance.close();
        
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    

}]);
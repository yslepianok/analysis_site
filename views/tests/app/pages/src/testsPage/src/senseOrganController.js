(function () {

    'use strict';

    myApp.controller('senseOrganController', senseOrganController);
    
    senseOrganController.$inject = ['$scope', '$uibModalInstance', 'CONSTANTS'];
    
    function senseOrganController($scope, $uibModalInstance, CONSTANTS) {
        $scope.senseList = ['слух', 'обоняние', 'осязание', 'вкус', 'зрение'];
        $scope.testName = "sens_organ_test";
        $scope.gradationDescription = [{color: "red",
                                        value: "слабый"
                                        },{
                                        color: "white",
                                        value: "средний"
                                        },{
                                        color: "green",
                                        value: "сильный"
                                        }];
        $scope.modalInstance = $uibModalInstance;
        $scope.testDescription = "Цель применения теста: выявление индивидуально-типологических различий органов чувств. Инструкция проведения теста. Выделите свой самый сильный (+) и самый слабый (–) орган чувств, используя радиокнопки.. Используя градации:";
        $scope.content = CONSTANTS.STRING;
        
    }

})();
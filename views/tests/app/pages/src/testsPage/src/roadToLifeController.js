(function () {

    'use strict';

    myApp.controller('roadToLifeController', roadToLifeController);
    
    roadToLifeController.$inject = ['$scope', '$uibModalInstance', 'CONSTANTS','preferencesService'];
    
    function roadToLifeController($scope, $uibModalInstance, CONSTANTS, preferencesService) {
        $scope.roadsImgPathList = ['app/common/images/roadToLife1.png', 
                                  'app/common/images/roadToLife2.png', 
                                  'app/common/images/roadToLife3.png', 
                                  'app/common/images/roadToLife4.png', 
                                  'app/common/images/roadToLife5.png',
                                  'app/common/images/roadToLife6.png'];
        $scope.testName = "road_to_life_test";
        $scope.testDescription = "Цель применения теста: проверка (уточнение) прогноза темперамента на основании психоло-гического теста, выполненного в тесте 6. Инструкция проведения теста. Выберите рисунки, на которых изображены наиболее привлекательная (+) и непривлекатель-ная (–), для Вас дороги. Используя градации";
        $scope.gradationDescription = [{color: "red",
                                        value: "непривлекательная "
                                        },{
                                        color: "white",
                                        value: "нейтральная"
                                        },{
                                        color: "green",
                                        value: "привлекательная"
                                        }];
        $scope.modalInstance = $uibModalInstance;
        $scope.content = CONSTANTS.IMG;
        $scope.outputData = outputData;
        
        function outputData(selectedColors, selectedPosButton, selectedNegButton) { 
            var T = preferencesService.outputDataFormat(selectedColors, selectedPosButton, selectedNegButton);
            var TT = [];
            for (var i = 0; i<18;i++) {
                TT[i] = 0;
            }
            TT[2] = T[1];
            TT[1] = T[2];
            TT[3] = T[3];
            TT[5] = T[4];
            TT[10] = T[5];
            TT[8] = T[6];
            return [T,TT];
            
        }
        console.log($scope.testName);
    }

})();
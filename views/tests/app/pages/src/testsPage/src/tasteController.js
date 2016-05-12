(function () {

    'use strict';

    myApp.controller('tasteController', tasteController);
    
    tasteController.$inject = ['$scope', '$uibModalInstance', 'CONSTANTS'];
    
    function tasteController($scope, $uibModalInstance, CONSTANTS) { 
        $scope.tasteList = ['соленый','острый','сладкий','горький','кислый'];
        $scope.testName = "taste_test";
        $scope.testDescription = "Цель применения теста: выявление индивидуально-типологических вкусовых различий. Инструкция проведения теста. Попытайтесь почувствовать самую первую подсознательную реакцию, отвечая на вопрос: какой привкус еды или напитка самый любимый (+) и нелюбимый (–), используя радиокнопки. Поставьте около каждого из 5 оттенков вкуса свои оценки предпочтений:";
        $scope.gradationDescription = [{color: "red",
                                        value: "не нравится"
                                        },{
                                        color: "white",
                                        value: "нейтрально"
                                        },{
                                        color: "green",
                                        value: "нравится"
                                        }];
        $scope.modalInstance = $uibModalInstance;
        $scope.content = CONSTANTS.STRING;
    }

})();
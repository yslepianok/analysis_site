(function () {

    'use strict';

    myApp.controller('elementsPrfController', elementsPrfController);
    
    elementsPrfController.$inject = ['$scope', '$uibModalInstance', 'CONSTANTS'];
    
    function elementsPrfController($scope, $uibModalInstance, CONSTANTS) { 
        $scope.elementsList = ['Вода','Металл(воздух)','Земля','Огонь','Дерево(Эфир)'];
        $scope.testName = "elements_preference";
        $scope.testDescription = "Цель применения теста: выявление индивидуально-типологических различий восприятия сти-хий. Инструкция проведения теста. Попытайтесь почувствовать самую первую подсознательную реакцию, отвечая на вопрос: ка-кой из пяти элементов стихий самый любимый (+) и нелюбимый (–), используя радиокнопки. Поставьте около каждого из 5 элементов стихий свои оценки предпочтений:";
        $scope.gradationDescription = [{color: "red",
                                        value: "негативное"
                                        },{
                                        color: "white",
                                        value: "нейтральное"
                                        },{
                                        color: "green",
                                        value: "позитивное"
                                        }];
        $scope.modalInstance = $uibModalInstance;
        $scope.content = CONSTANTS.STRING;
    }

})();
(function () {

    'use strict';

    myApp.controller('transformationPrfController', transformationPrfController);
    
    transformationPrfController.$inject = ['$scope', '$uibModalInstance', 'CONSTANTS'];
    
    function transformationPrfController($scope, $uibModalInstance, CONSTANTS) { 
        $scope.transformationList = ['естественное количественное накопление (или освобождение от лишнего)',
                                     'планомерный рост (или увядание)',
                                     'качественное развитие (или деградация)',
                                     'рождение (или смерть)',
                                     'появление (или исчезновение)'];
        $scope.testName = "transformation_preferences";
        $scope.testDescription = "Цель применения теста: выявление индивидуально-типологических различий восприятия превращений. Инструкция проведения теста.     Попытайтесь почувствовать самую первую подсознательную реакцию, отвечая на вопрос: ка-кая из пяти пар превращений (в прямом и обратном виде) самая интересная (+) и неинтересная (–). Поставьте около каждой из 5 пар превращений свои оценки предпочтений: ";
        $scope.gradationDescription = [{color: "red",
                                        value: "негативно"
                                        },{
                                        color: "white",
                                        value: "нейтрально"
                                        },{
                                        color: "green",
                                        value: "позитивно"
                                        }];
        $scope.modalInstance = $uibModalInstance;
        $scope.content = CONSTANTS.STRING;
    }

})();
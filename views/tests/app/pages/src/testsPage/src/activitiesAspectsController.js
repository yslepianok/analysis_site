(function () {

    'use strict';

    myApp.controller('activitiesAspectsController', activitiesAspectsController);
    
    activitiesAspectsController.$inject = ['$scope', '$uibModalInstance', 'CONSTANTS'];
    
    function activitiesAspectsController($scope, $uibModalInstance, CONSTANTS) { 
        $scope.ActivityList = ['ориентируюсь (принимаю решение)',
                               'верю в дело',
                               'желаю и переживаю эмоции',
                               'люблю и выстраиваю взаимоотношения',
                               'воспринимаю и действую'];
        $scope.testName = "activities_aspects";
        $scope.testDescription = "Цель применения теста: выявление индивидуально-типологических различий выполнения ас-пектов деятельности. Инструкция проведения теста. Попытайтесь почувствовать самую первую подсознательную реакцию, отвечая на вопрос: ка-кой из пяти аспектов деятельности наиболее (+) естественен и наименее (–) естественен для Вас. Поставьте около каждого из 5 аспектов деятельности оценки предпочтений того, как он Вам дается:";
        $scope.gradationDescription = [{color: "red",
                                        value: "тяжело"
                                        },{
                                        color: "white",
                                        value: "нейтрально"
                                        },{
                                        color: "green",
                                        value: "легко"
                                        }];
        $scope.modalInstance = $uibModalInstance;
        $scope.content = CONSTANTS.STRING;
    }

})();
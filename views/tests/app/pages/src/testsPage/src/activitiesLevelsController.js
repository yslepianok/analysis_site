(function () {

    'use strict';

    myApp.controller('activitiesLevelsController', activitiesLevelsController);
    
    activitiesLevelsController.$inject = ['$scope', '$uibModalInstance', 'CONSTANTS'];
    
    function activitiesLevelsController($scope, $uibModalInstance, CONSTANTS) { 
        $scope.ActivityList = ['Живу',
                               'Общаюсь',
                               'Думаю',
                               'Вступаю в коллективные взаимодействия',
                               'Личностно развиваюсь',
                               'Следую своим ценностным установкам', 
                               'одухотворяюсь (истиной, гармонией, красотой)'];
        $scope.testName = "activities_levels";
        $scope.testDescription = "Цель применения теста: выявление индивидуально-типологических различий выполнения уровней деятельности. Инструкция проведения теста. Попытайтесь почувствовать самую первую подсознательную реакцию, отвечая на вопрос: ка-кой из семи уровней деятельности наиболее естественен (+) и наименее естественен (–) для Вас. Поставьте около каждого из 7 уровней деятельности оценки предпочтений того, как он Вам дается:";
        $scope.gradationDescription = [{color: "red",
                                        value: "тяжело"
                                        },{
                                        color: "white",
                                        value: "найтрально"
                                        },{
                                        color: "green",
                                        value: "легко"
                                        }];
        $scope.modalInstance = $uibModalInstance;
        $scope.content = CONSTANTS.STRING;
        
    }

})();
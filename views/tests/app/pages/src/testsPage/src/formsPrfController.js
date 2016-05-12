(function () {

    'use strict';

    myApp.controller('formsPrfController', formsPrfController);
    
    formsPrfController.$inject = ['$scope', '$uibModalInstance', 'CONSTANTS'];
    
    function formsPrfController($scope, $uibModalInstance, CONSTANTS) { 
        $scope.formImgPathList = ['app/common/images/strangeshape.png', 
                                  'app/common/images/circle.png', 
                                  'app/common/images/rectangle.png', 
                                  'app/common/images/triangle.png', 
                                  'app/common/images/verticalrectangle.png'];
        $scope.testName = "form_preferences";
        $scope.testDescription = "Цель применения теста: выявление индивидуально-типологических различий восприятия форм. Инструкция проведения теста. Попытайтесь почувствовать самую первую подсознательную реакцию, отвечая на вопрос: ка-кая из пяти форм самая привлекательная (+) и непривлекательная (–): Поставьте около каждой из 5 форм свои оценки предпочтений:";
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
        $scope.content = CONSTANTS.IMG;
    }

})();
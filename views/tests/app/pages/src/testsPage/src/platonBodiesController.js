(function () {

    'use strict';

    myApp.controller('platonBodiesController', platonBodiesController);
    
    platonBodiesController.$inject = ['$scope', '$uibModalInstance', 'CONSTANTS'];
    
    function platonBodiesController($scope, $uibModalInstance, CONSTANTS) { 
        $scope.bodyList = [{
            name: "Икосаэдр",
            imgPath: "app/common/images/ikosaedr.png"
        },{
            name: "Октаэдр",
            imgPath: "app/common/images/oktaedr.png"
        },{
            name: "Гексаедр (куб)",
            imgPath: "app/common/images/geksaedr.png"
        },{
            name: "Тэтраэдр",
            imgPath: "app/common/images/tetraedr.png"
        },{
            name: "Додекаедр",
            imgPath: "app/common/images/dodekaedr.png"
        },{
            name: "Сфера с точкой",
            imgPath: "app/common/images/spherewithpoint.png"
        }];
        
        $scope.testName = "platoon_bodies_test";
        $scope.testDescription = "Цель применения теста: выявление индивидуально-типологических различий восприятия Платоновых тел. Инструкция проведения теста. Попытайтесь почувствовать самую первую подсознательную реакцию, отвечая на вопрос: ка-кое из первых пяти геометрических тел самое привлекательное (+) и наименее привлекательное (–) для Вас. Поставьте около каждого из 6 тел свои оценки предпочтений:";
        $scope.gradationDescription = [{color: "red",
                                        value: "негативное"
                                        },{
                                        color: "white",
                                        value: "нейтрально"
                                        },{
                                        color: "green",
                                        value: "позитивное"
                                        }];
        $scope.modalInstance = $uibModalInstance;
        $scope.content = CONSTANTS.IMG;
    }

})();
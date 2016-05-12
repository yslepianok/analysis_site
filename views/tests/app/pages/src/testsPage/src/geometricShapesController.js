(function () {

    'use strict';

    myApp.controller('geometricShapesController', geometricShapesController);
    
    geometricShapesController.$inject = ['$scope', '$uibModalInstance', 'CONSTANTS'];
    
    function geometricShapesController($scope, $uibModalInstance, CONSTANTS) {
        $scope.shapesList = [{
            imgPath: "app/common/images/shape1.png"
        },{
            imgPath: "app/common/images/shape2.png"
        },{
            imgPath: "app/common/images/shape3.png"
        },{
            imgPath: "app/common/images/shape4.png"
        },{
            imgPath: "app/common/images/shape5.png"
        },{
            imgPath: "app/common/images/shape6.png"
        },{
            imgPath: "app/common/images/shape7.png"
        },{
            imgPath: "app/common/images/shape8.png"
        },{
            imgPath: "app/common/images/shape9.png"
        },{
            imgPath: "app/common/images/shape10.png"
        },{
            imgPath: "app/common/images/shape11.png"
        },{
            imgPath: "app/common/images/shape12.png"
        },{
            imgPath: "app/common/images/shape13.png"
        },{
            imgPath: "app/common/images/shape14.png"
        },{
            imgPath: "app/common/images/shape15.png"
        },{
            imgPath: "app/common/images/shape16.png"
        },{
            imgPath: "app/common/images/shape17.png"
        },{
            imgPath: "app/common/images/shape18.png"
        }];

        $scope.testName = "geometricShapes";
        $scope.testDescription = "Цель применения теста: выявление индивидуально-типологических различий восприятия геометрических фигур.Инструкция проведения теста.Поставьте около каждой из 18 геометрических фигур свои оценки предпочтений:";
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
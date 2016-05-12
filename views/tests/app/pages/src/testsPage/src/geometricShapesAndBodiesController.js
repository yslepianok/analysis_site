(function () {

    'use strict';

    myApp.controller('geometricShapesAndBodiesController', geometricShapesAndBodiesController);
    
    geometricShapesAndBodiesController.$inject = ['$scope', '$uibModalInstance', 'CONSTANTS','preferencesService'];
    
    function geometricShapesAndBodiesController($scope, $uibModalInstance, CONSTANTS, preferencesService) {
        $scope.shapesList = [{
            imgPath: "app/common/images/gshape1.png"
        },{
            imgPath: "app/common/images/gshape2.png"
        },{
            imgPath: "app/common/images/gshape3.png"
        },{
            imgPath: "app/common/images/gshape4.png"
        },{
            imgPath: "app/common/images/gshape5.png"
        },{
            imgPath: "app/common/images/gshape6.png"
        },{
            imgPath: "app/common/images/gshape7.png"
        },{
            imgPath: "app/common/images/gshape8.png"
        },{
            imgPath: "app/common/images/gshape9.png"
        },{
            imgPath: "app/common/images/gshape10.png"
        },{
            imgPath: "app/common/images/gshape11.png"
        },{
            imgPath: "app/common/images/gshape12.png"
        }];

        $scope.testName = "geometric_shapes_and_bodies";
        $scope.testDescription = "Цель применения теста: выявление индивидуально-типологических различий восприятия геометрических фигур и тел. Инструкция проведения теста. Выберите из 12 геометрических фигур и тел для Вас самую привлекательную и наименее привлекательную фигуру.  Поставьте около каждой из 12 геометрических фигур и тел свои оценки предпочтений:";
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
        
        $scope.outputData = outputData;
        
        function outputData(selectedColors, selectedPosButton, selectedNegButton) { 
            var T16 = preferencesService.outputDataFormat(selectedColors, selectedPosButton, selectedNegButton);
            var jp = T16[12];
            var jjp = makeJJ(jp);
            
            
            var jn = T16[13];
            var jjn = makeJJ(jn);
            
            function makeJJ(j) { 
                var jj = 0;
                if (j === 1 || j === 3) {
                    jj = 1;
                } else if(j === 9 || j === 11) { 
                    jj = 2;
                } else if(j === 2 || j === 4) { 
                    jj = 3;
                } else if(j === 5 || j === 7) { 
                    jj = 4;
                } else if(j === 6 || j === 8) { 
                    jj = 5;
                } else if(j === 10 || j === 12) { 
                    jj = 6;
                }
                return jj;
            }
            var j = jp;
            var TT16 = [];
            if (j == 1 || j == 3) { 
                TT16[16] = TT16[17] = TT16[18] = 1;
            } else if (j === 2 || j === 4) { 
                TT16[7] = TT16[8] = TT16[9] = 1;
            } else if (j === 6 || j === 8) { 
                TT16[4] = TT16[5] = TT16[6] = 1;
            } else if (j === 5 || j === 7) { 
                TT16[13] = TT16[14] = TT16[15] = 1;
            } else if (j === 10 || j === 12) { 
                TT16[1] = TT16[2] = TT16[3] = 1;
            } else if (j === 9 || j === 11) { 
                TT16[10] = TT16[11] = TT16[12] = 1;
            }
            
            TT16[19] = jjp;
            
            j = jn;
            var TT16 = [];
            for (var i = 0; i<20; i++) {
                TT16[i] = 0;
            }
            if (j == 1 || j == 3) { 
                TT16[16] = TT16[17] = TT16[18] = -1;
            } else if (j === 2 || j === 4) { 
                TT16[7] = TT16[8] = TT16[9] = -1;
            } else if (j === 6 || j === 8) { 
                TT16[4] = TT16[5] = TT16[6] = -1;
            } else if (j === 5 || j === 7) { 
                TT16[13] = TT16[14] = TT16[15] = -1;
            } else if (j === 10 || j === 12) { 
                TT16[1] = TT16[2] = TT16[3] = -1;
            } else if (j === 9 || j === 11) { 
                TT16[10] = TT16[11] = TT16[12] = -1;
            }
            
            TT16[20] = jjn;
            
            function makeTT(j) { 
                var TT16 = [];
                if (j == 1 || j == 3) { 
                    TT16[16] = TT16[17] = TT16[18] = 1;
                } else if (j === 2 || j === 4) { 
                    TT16[7] = TT16[8] = TT16[9] = 1;
                } else if (j === 6 || j === 8) { 
                    TT16[4] = TT16[5] = TT16[6] = 1;
                } else if (j === 5 || j === 7) { 
                    TT16[13] = TT16[14] = TT16[15] = 1;
                } else if (j === 10 || j === 12) { 
                    TT16[1] = TT16[2] = TT16[3] = 1;
                } else if (j === 9 || j === 11) { 
                    TT16[10] = TT16[11] = TT16[12] = 1;
                }
            }
            return [T16,TT16];
            //TODO: expend functionality
            
        }
    }

})();
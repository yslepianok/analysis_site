(function () {

    'use strict';

    myApp.controller('personPictureController', personPictureController);
    
    personPictureController.$inject = ['$scope', '$timeout', 'testDataService', 'CONSTANTS', '$uibModalInstance'];
    
    function personPictureController($scope, $timeout, testDataService, CONSTANTS, $uibModalInstance) { 
        
        $scope.shapes = ['Круги','Прямоугольники','Треугольники'];
        $scope.testName = "person_picture_test";
        $scope.submitForm = submitForm;
        $scope.numShapes = [];
        $scope.isValid = true;
        
        function submitForm() {
            if (isValid()) {
                var userInfo = JSON.parse(localStorage.getItem(CONSTANTS.LOCAL_STORAGE_KEY));
                var outputData = formDataBeforeRequest();
                testDataService(userInfo.email, $scope.testName, $scope.numShapes).then(function successCallback(response) {
                    $uibModalInstance.close();
                }, function errorCallback(response) {
                    throw "request failed";
                });   
            } else { 
                showInvalidMessage();
            }
            
        }
        
        function isValid() { 
            var sum = 0;
            var valid = false;
            for (var i = 0; i<$scope.shapes.length ; i++) { 
                sum += $scope.numShapes[i];
            }
            if (sum >= 8 && sum <= 15) {
                valid = true;
            }
            return valid;
        }  
        
        function showInvalidMessage() {
            $scope.isValid = false;
            $timeout(function() {
                $scope.isValid = true;
            },3000)
        }
        
        function formDataBeforeRequest() {
            var T5 = [];
            var C = $scope.numShapes[0];
            var R = $scope.numShapes[1];
            var T = $scope.numShapes[2];
            var c = C/(C + R + T);
            var r = R/(C + R + T);
            var t = T/(C + R + T);
            var up = 0.38;
            var dp = 0.28;
            
            var U = defineU();
            
            
            
            if (U===0) { 
               do { 
                  changeDPUP();
                  U = defineU();
               } while( (up>dp) || (U=0) )
                
            } else if (U>0) { 
                T5[U] = T5[U] + 3;
            }
            
            U = defineU2();
            T5[U] = T5[U] - 3;
            
            return T5;
            
            
            
            function changeDPUP() { 
                up = up - 0.01;
                dp = dp + 0.01;
            }
            
            function defineU() { 
                var U; 
                if ((c<=dp && r<=dp && t>=up) || (dp<c && c<up && dp<r && r<=up && dp<t && t<=up) && ((C+R+T)<12)) {
                    U = 1;
                } else if (c<=dp && r>up && t<=dp) { 
                    U = 2;
                } else if (c<=dp && r>up && t>up) {
                    U = 3;
                } else if (c>dp && r<=up && t<=up) {
                    U = 4;
                } else if (c>dp && r<=up && t>up) {
                    U = 5;
                } else if (c>dp && r>up && t<=up) {
                    U = 6;
                } else if ((dp<c && c<=up && dp<r && r<=up && dp<t && t<=up) && ((C+R+T)>=12)) {
                    U = 7;
                } else {
                    U = 0;
                }
                return U;
            }
                           
            function defineU2() { 
                var U2;
                if (U == 1 && (c<=dp && r<=dp && t<=up)) {
                    U2 = 6;
                } else if (U == 2) { 
                    U2 = 5;
                } else if (U == 3) { 
                    U2 = 4;
                } else if (U == 4) { 
                    U2 = 3;
                } else if (U == 5) { 
                    U2 = 2;
                } else if (U == 6 || U == 7) { 
                    U2 = 1;
                } else { 
                    U2 = 7;
                }
                return U2;
            }
            
        }       
        
    }

})();
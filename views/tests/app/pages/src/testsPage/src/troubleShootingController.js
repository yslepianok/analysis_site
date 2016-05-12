(function () {

    'use strict';

    myApp.controller('troubleShootingController', troubleShootingController);
    
    troubleShootingController.$inject = ['$scope', '$timeout', 'testDataService', 'CONSTANTS', '$uibModalInstance'];
    
    function troubleShootingController($scope, $timeout, testDataService, CONSTANTS, $uibModalInstance) { 
        $scope.troubleList = ['Жду быстрых результатов',
                              'Перестаю верить в себя',
                              'Застреваю в прошлом',
                              'Зацикливаюсь в своих ошибках',
                              'Боюсь будущего',
                              'Пропивлюсь переменам',
                              'Быстро опускаю руки',
                              'Считаю себя слабым',
                              'Думаю, что мир мне чем-то обязан',
                              'Страх перед неудачей больше, чем жажда успеха',
                              'Не прдставляю себе всех своих возможностей', 
                              'Чувствую, что мне есть что терять',
                              'Решение проблем требует слишком много работы',
                              'Считаю свою проблему уникальной, поэтому неразрешимой',
                              'Неудача для меня – сигнал к отступлению',
                              'Жалею себя'];
        $scope.isValid = true;
        $scope.invalidMessage = "";
        $scope.submitForm = submitForm;
        $scope.arrButtons = [[],[]];
        $scope.setButton = setButton;
        $scope.testName = "troubleshooting";

        
        function submitForm() { 
            if (getLength($scope.arrButtons[0]) == 5 && getLength($scope.arrButtons[1]) == 5) {
                var userInfo = JSON.parse(localStorage.getItem(CONSTANTS.LOCAL_STORAGE_KEY));
                var outputData = outputDataFnc($scope.arrButtons);
                console.log(outputData);
                testDataService(userInfo.email, $scope.testName, outputData).then(function successCallback(response) {
                    $uibModalInstance.close();
                }, function errorCallback(response) {
                    throw "request failed";
                });
            } else {
                showInvalidMessage("Вы отметили недостаточно пунктов. Читайте описание выше"); 
            }
            
        }
        
        function setButton(arrIndex, btnIndex) { 
            var selected = $scope.arrButtons[arrIndex][btnIndex]; 
            if (getLength($scope.arrButtons[arrIndex]) <= 4 || selected) { 
                if (selected) {
                    $scope.arrButtons[arrIndex][btnIndex] = false;
                } else { 
                    $scope.arrButtons[arrIndex][btnIndex] = true;
                }
            } else {
                showInvalidMessage("Вы можете отметить только пять пунктов. Для того, чтобы снять пункт, нажмите еще раз нажатую кнопку"); 
            }
        }
        
        
        function getLength(arr) { 
            var length = 0;
            for (var item in arr) { 
                if (arr[item]) { 
                    length ++;
                }
            }
            return length;
        }
        
        function showInvalidMessage(message) {
            $scope.invalidMessage = message;
            $scope.isValid = false;
            $timeout(function() {
                $scope.isValid = true;
                $scope.invalidMessage = "";
            },3000)
        }
        
        function outputDataFnc(arrButtons) { 
            var jp = 0;
            var TT18 = [];
            for (var i = 0; i<7; i++) {
                for (var j = 0; j<5; j++) {
                    if (TT18[i] == undefined) {
                        TT18[i] = [];
                    }
                    TT18[i][j] = 0;
                }
            }
            for (var i = 0;i<5; i++) { 
                jp = arrButtons[0][i];
                if (jp === 1) { 
                    TT18[7][4] = TT18[7][4] - 2;
                    TT18[6][2] = TT18[6][2] - 2;
                } else if ( jp === 2) {
                    TT18[6][4] = TT18[6][4] - 2;
                    TT18[2][1] = TT18[2][1] - 2;
                } else if ( jp === 3) {
                    TT18[5][3] = TT18[5][3] - 2;
                    TT18[3][5] = TT18[3][5] - 2;
                } else if ( jp === 4) {
                    TT18[3][1] = TT18[3][1] - 2;
                    TT18[1][4] = TT18[1][4] - 2;
                } else if ( jp === 5) {
                    TT18[6][4] = TT18[6][4] - 2;
                    TT18[7][5] = TT18[7][5] - 2;
                } else if ( jp === 6) {
                    TT18[7][2] = TT18[7][2] - 2;
                    TT18[6][2] = TT18[6][2] - 2;
                } else if ( jp === 7) {
                    TT18[3][5] = TT18[3][5] - 2;
                    TT18[4][3] = TT18[4][3] - 2;
                } else if ( jp === 8) {
                    TT18[7][1] = TT18[7][1] - 2;
                    TT18[1][3] = TT18[1][3] - 2;
                } else if ( jp === 9) {
                    TT18[7][1] = TT18[7][1] - 2;
                    TT18[2][2] = TT18[2][2] - 2;
                } else if ( jp === 10) {
                    TT18[4][2] = TT18[4][2] - 2;
                    TT18[7][2] = TT18[7][2] - 2;
                } else if ( jp === 11) {
                    TT18[7][4] = TT18[7][4] - 2;
                    TT18[6][2] = TT18[6][2] - 2;
                } else if ( jp === 12) {
                    TT18[7][2] = TT18[7][2] - 2;
                    TT18[4][2] = TT18[4][2] - 2;
                } else if ( jp === 13) {
                    TT18[6][4] = TT18[6][4] - 2;
                    TT18[2][2] = TT18[2][2] - 2;
                } else if ( jp === 14) {
                    TT18[3][4] = TT18[3][4] - 2;
                    TT18[7][1] = TT18[7][1] - 2;
                } else if ( jp === 15) {
                    TT18[7][2] = TT18[7][2] - 2;
                    TT18[1][5] = TT18[1][5] - 2;
                } else if ( jp === 16) {
                    TT18[7][3] = TT18[7][3] - 2;
                    TT18[2][5] = TT18[2][5] - 2;
                }
            }
            for (var i = 0;i<5; i++) { 
                jp = arrButtons[1][i];
                if (jp === 1) { 
                    TT18[7][4] = TT18[7][4] + 2;
                    TT18[6][2] = TT18[6][2] + 2;
                } else if ( jp === 2) {
                    TT18[6][4] = TT18[6][4] + 2;
                    TT18[2][1] = TT18[2][1] + 2;
                } else if ( jp === 3) {
                    TT18[5][3] = TT18[5][3] + 2;
                    TT18[3][5] = TT18[3][5] + 2;
                } else if ( jp === 4) {
                    TT18[3][1] = TT18[3][1] + 2;
                    TT18[1][4] = TT18[1][4] + 2;
                } else if ( jp === 5) {
                    TT18[6][4] = TT18[6][4] + 2;
                    TT18[7][5] = TT18[7][5] + 2;
                } else if ( jp === 6) {
                    TT18[7][2] = TT18[7][2] + 2;
                    TT18[6][2] = TT18[6][2] + 2;
                } else if ( jp === 7) {
                    TT18[3][5] = TT18[3][5] + 2;
                    TT18[4][3] = TT18[4][3] + 2;
                } else if ( jp === 8) {
                    TT18[7][1] = TT18[7][1] + 2;
                    TT18[1][3] = TT18[1][3] + 2;
                } else if ( jp === 9) {
                    TT18[7][1] = TT18[7][1] + 2;
                    TT18[2][2] = TT18[2][2] + 2;
                } else if ( jp === 10) {
                    TT18[4][2] = TT18[4][2] + 2;
                    TT18[7][2] = TT18[7][2] + 2;
                } else if ( jp === 11) {
                    TT18[7][4] = TT18[7][4] + 2;
                    TT18[6][2] = TT18[6][2] + 2;
                } else if ( jp === 12) {
                    TT18[7][2] = TT18[7][2] + 2;
                    TT18[4][2] = TT18[4][2] + 2;
                } else if ( jp === 13) {
                    TT18[6][4] = TT18[6][4] + 2;
                    TT18[2][2] = TT18[2][2] + 2;
                } else if ( jp === 14) {
                    TT18[3][4] = TT18[3][4] + 2;
                    TT18[7][1] = TT18[7][1] + 2;
                } else if ( jp === 15) {
                    TT18[7][2] = TT18[7][2] + 2;
                    TT18[1][5] = TT18[1][5] + 2;
                } else if ( jp === 16) {
                    TT18[7][3] = TT18[7][3] + 2;
                    TT18[2][5] = TT18[2][5] + 2;
                }
            }
            return [arrButtons,TT18];
        }
    }

})();
(function () {
    'use strict';

    myApp.directive('testDirective', testDirective);

    testDirective.$inject = ['preferencesService', '$timeout', 'testDataService', 'CONSTANTS'];
    
    function testDirective(preferencesService, $timeout, testDataService, CONSTANTS) { // declaring directive
        var directive = {
            restrict: 'E', // allowed to use only as a element
            templateUrl: "app/directives/src/testDirective/tpl/testDirective.tpl.html",
            scope: {
                testName: "@",
                testDescription: "@",
                gradationDescription: "=",
                itemList: "=",
                modalInstance: "=",
                content: "@",
                outputData: '&'
            },
            controller: controllerFunc
        };

        return directive;

        function controllerFunc($scope, $element, $attrs) {
            $scope.submitForm = submitForm;
            $scope.isValid = true;
            $scope.selectedColors = [];
            $scope.selectColor = selectColor;
            $scope.selectPositiveLetter = selectPositiveLetter;
            $scope.selectNegativeLetter = selectNegativeLetter;
            $scope.selectedPosButton = -1;
            $scope.selectedNegButton = -1;
            $scope.contentUrl = "";
            $scope.ifString = ifString;
            defineContent();

            function submitForm() {
                if (preferencesService.isFormValid($scope.selectedPosButton, $scope.selectedNegButton, $scope.selectedColors, $scope.itemList.length)) {
                    console.log($element);
                    console.log("form has been submitted");
                    var T2;
                    if ($attrs.outputData) {
                        T2 = $scope.outputData({ selectedColors: $scope.selectedColors, selectedPosButton: $scope.selectedPosButton, selectedNegButton: $scope.selectedNegButton});
                    } else {
                        T2 = preferencesService.outputDataFormat($scope.selectedColors, $scope.selectedPosButton, $scope.selectedNegButton);
                    }
                    var userInfo = JSON.parse(localStorage.getItem(CONSTANTS.LOCAL_STORAGE_KEY));
                    testDataService(userInfo.email, $scope.testName, T2).then(function successCallback(response) {
                        $scope.modalInstance.close();
                    }, function errorCallback(response) {
                        throw "request failed";
                    });
                    console.log(T2);
                } else {
                    showInvalidMessage();
                    console.log("form hasn't been submitted");
                }
            }

            function selectColor(letterIndex, gradationIndex) {
                $scope.selectedColors[letterIndex] = gradationIndex;
            }

            function selectNegativeLetter(index) {
                $scope.selectedNegButton = index;
            }

            function selectPositiveLetter(index) {
                $scope.selectedPosButton = index;
            }

            function showInvalidMessage() {
                $scope.isValid = false;
                $timeout(function() {
                    $scope.isValid = true;
                },3000)
            }
            
            function defineContent() { 
                switch ($scope.content) {
                  case CONSTANTS.IMG:
                    $scope.contentUrl = "app/common/tpls/img.tpl.html";
                    break;
                  case CONSTANTS.STRING:
                    $scope.contentUrl = "app/common/tpls/string.tpl.html";
                    break;
                  default: 
                    console.log("please define the type of content for the directive");
                }

            }
            
            function ifString(item) { 
                return (typeof item == "string");
            }
        }

    };

})();
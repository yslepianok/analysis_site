(function () {
    'use strict';

    myApp.directive('testDirectiveWithEvaluationWithTwoCol', testDirective);

    testDirective.$inject = ['preferencesService', '$timeout', 'testDataService', 'CONSTANTS'];

    function testDirective(preferencesService, $timeout, testDataService, CONSTANTS) { // declaring directive
        var directive = {
            restrict: 'E', // allowed to use only as a element
            templateUrl: "app/directives/src/testDirectiveWithEvaluationWithTwoCol/tpl/testDirectiveWithEvaluationWithTwoCol.tpl.html",
            replace: true,
            scope: {
                testName: "@",
                testDescription: "@",
                itemList: "=",
                titleList: "=",
                modalInstance: "=",
                outputData: '&'

            },
            controller: controllerFunc
        };

        return directive;

        function controllerFunc($scope, $element, $attrs) {
            $scope.submitForm = submitForm;
            $scope.isValid = true;
            $scope.grades = [[]];

            function submitForm() {
                if ($scope[$scope.testName].$valid) {
                    var userInfo = JSON.parse(localStorage.getItem(CONSTANTS.LOCAL_STORAGE_KEY));
                    var T1;
                    if ($attrs.outputData) {
                        T1 = $scope.outputData({ grades: $scope.grades });
                    } else {
                        T1 = $scope.grades;
                    }
                    testDataService(userInfo.email, $scope.testName, T1).then(function successCallback(response) {
                        $scope.modalInstance.close();
                    }, function errorCallback(response) {
                        throw "request failed";
                    });
                } else {
                    showInvalidMessage();
                }
            }

            $scope.range = rangeFnc;

            function showInvalidMessage() {
                $scope.isValid = false;
                $timeout(function() {
                    $scope.isValid = true;
                },3000)
            }

            function rangeFnc(n) {
                return new Array(n);
            };

        }

    };

})();
(function () {

    'use strict';

    myApp.controller('roleInFilmController', roleInFilmController);
    
    roleInFilmController.$inject = ['$scope','$timeout','preferencesService','testDataService', 'CONSTANTS', '$uibModalInstance'];
    
    function roleInFilmController($scope, $timeout, preferencesService, testDataService, CONSTANTS, $uibModalInstance) {
        
        $scope.roleList = [
            {
                title: 'Режиссер-массовок',
                description: ''
            }, {
                title: 'Реквезитор, Режиссер монтажа',
                description: 'с лат. необходимое, отве-чает за хранение, получение на складе, ремонт и транспортировку реквизита'
            }, {
                title: 'Костюмер, гример',
                description: ''
            }, {
                title: 'Директор картины',
                description: 'Отвечает за бухгалтерию'
            }, {
                title: 'Режиссер по работе с актерами',
                description: ''
            }, {
                title: 'режиссер-постановщик трюков',
                description: ''
            }, {
                title: 'Продюссер',
                description: 'художе-ственный и финансовый руководитель: выбирает сценарий и режиссера, осу-ществляет производство и контроль'
            }, {
                title: 'Кинодистрибьютер',
                description: 'Отвечает за прокат фильма'
            }, {
                title: 'Киномаркетолог',
                description: ''
            }, {
                title: 'Актер',
                description: ''
            }, {
                title: 'Монтажер',
                description: ''
            }, {
                title: 'Звукооператор, кинооператор, оператор, каскадер, участник массовок',
                description: ''
            }, {
                title: 'Постановщик, сценарист, хореограф, кинокомпозитор',
                description: ''
            }, {
                title: 'Оператор-постановщик',
                description: 'главный оператор'
            }, {
                title: 'Звукорежиссер, звукоинжинер',
                description: ''
            }, {
                title: 'Кинокритик',
                description: ''
            }, {
                title: 'Организатор показа через сайт или кинотеатр',
                description: ''
            }, {
                title: 'зритель',
                description: ''
            }

        ];
        
        $scope.gradations = preferencesService.gradations;
        $scope.selectedColors = preferencesService.selectedColors;
        $scope.selectPositiveLetter = selectPositiveLetter;
        $scope.selectNegativeLetter = selectNegativeLetter;
        $scope.selectedPosButton = -1;
        $scope.selectedNegButton = -1;
        $scope.selectColor = preferencesService.selectColor;
        $scope.submitForm = submitForm;
        $scope.isValid = true;
        $scope.testName = "role_in_films_preference";

        function selectNegativeLetter(index) {
            $scope.selectedNegButton = index;
        }

        function selectPositiveLetter(index) {
            $scope.selectedPosButton = index;
        }

        function submitForm() {
            if (preferencesService.isFormValid($scope.selectedPosButton, $scope.selectedNegButton, $scope.selectedColors, $scope.roleList.length)) {
                console.log("form has been submitted");
                var T4 = preferencesService.outputDataFormat($scope.selectedColors, $scope.selectedPosButton, $scope.selectedNegButton);
                var userInfo = JSON.parse(localStorage.getItem(CONSTANTS.LOCAL_STORAGE_KEY));
                testDataService(userInfo.email, $scope.testName, T4).then(function successCallback(response) {
                    $uibModalInstance.close();
                }, function errorCallback(response) {
                    throw "request failed";
                });
            } else {
                showInvalidMessage();
                console.log("form hasn't been submitted");
            }

        }

        function showInvalidMessage() {
            $scope.isValid = false;
            $timeout(function() {
                $scope.isValid = true;
            },3000)
        }
        
    }

})();
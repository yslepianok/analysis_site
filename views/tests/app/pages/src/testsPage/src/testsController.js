'use strict';

myApp.controller('testsController',['$scope', '$uibModal', 'passedTestsService', 'CONSTANTS', function ($scope, $uibModal, passedTestsService, CONSTANTS) {

    $scope.tests = {
        'colorPrf': {
           title: 'Тест на предпочтение цвета', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/colorPrf.tpl.html',
           controller: 'colorPreferenceController'
        },
        'vowelLtr': {
           title: 'Тест на предпочтение гласных букв', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/vowelLtr.tpl.html',
           controller: 'vowelLetterController'
        },
        'schoolClasses': {
           title: 'Тест на предпочтение школьных предметов', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/schoolClasses.tpl.html',
           controller: 'schoolClassesController' 
        },
        'roleInFilm': {
           title: 'Тест на предпочтение ролей в кинопроизводстве', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/roleInFilm.tpl.html',
           controller: 'roleInFilmController' 
        },
        'personPicture': {
           title: 'Конструктивный рисунок человека из геометрических фигур', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/personPicture.tpl.html',
           controller: 'personPictureController' 
        },
        'temperament': {
           title: 'Тест на темперамент', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/temperament.tpl.html',
           controller: 'temperamentController' 
        },
        'rouadToLife': {
           title: 'Тест "Дорога жизни"', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/roadToLife.tpl.html',
           controller: 'roadToLifeController' 
        },
        'senseOrgan': {
           title: 'Тест "органы чувств"', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/senseOrgan.tpl.html',
           controller: 'senseOrganController' 
        },
        'taste': {
           title: 'Тест "вкус"', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/taste.tpl.html',
           controller: 'tasteController' 
        },
        'elementsPrf': {
           title: 'Тест "стихии"', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/elementsPrf.tpl.html',
           controller: 'elementsPrfController' 
        },
        'formsPrf': {
           title: 'Тест "формы"', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/formsPrf.tpl.html',
           controller: 'formsPrfController' 
        },
        'transformationPrf': {
           title: 'Тест "превращения"', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/transformationPrf.tpl.html',
           controller: 'transformationPrfController' 
        },
        'platonBodies': {
           title: 'Тест "платоновы тела"', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/platonBodies.tpl.html',
           controller: 'platonBodiesController' 
        },
        'activitiesAspects': {
           title: 'Тест "Аспекты деятельности"', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/activitiesAspects.tpl.html',
           controller: 'activitiesAspectsController' 
        },
        'activitiesLevels': {
           title: 'Тест "Уровни деятельности"', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/activitiesLevels.tpl.html',
           controller: 'activitiesLevelsController' 
        },
        'geometricShapesAndBodies': {
           title: 'Тест "Геометрические фигуры и тела"', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/geometricShapesAndBodies.tpl.html',
           controller: 'geometricShapesAndBodiesController' 
        },
        'geometricShapes': {
           title: 'Тест "Геометрические фигуры"', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/geometricShapes.tpl.html',
           controller: 'geometricShapesController' 
        },
        'troubleShooting': {
           title: 'Тест "Помехи в разрешении проблем"', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/troubleShooting.tpl.html',
           controller: 'troubleShootingController' 
        },
        'filmGenres': {
           title: 'Тест "Предпочтение жанров фильмов"', 
           templateUrl: 'app/pages/src/testsPage/src/tpl/filmGenres.tpl.html',
           controller: 'filmGenresController'
        },
        'tvshowsPreferences': {
            title: 'Тест "Предпочтение рубрик передач"',
            templateUrl: 'app/pages/src/testsPage/src/tpl/tvshowsPreferences.tpl.html',
            controller: 'tvshowsPreferencesController'
        }
        
        
    }
    
    $scope.open = openFnc;
    $scope.passedTest = passedTestFnc;
    
    function getPassedTests() { 
        var userInfo = JSON.parse(localStorage.getItem(CONSTANTS.LOCAL_STORAGE_KEY));
        console.log(userInfo.email);
        passedTestsService(userInfo.email).then(function successCallback(response) {
            //console.log(response);
        }, function errorCallback(response) {
            throw "request failed";
        });   
    }
    
    function passedTestFnc(index) { 
        return true;
    }
    
    
    function openFnc(test) {
        if (test) { 
            var modalInstance = $uibModal.open({
                templateUrl: test.templateUrl,
                controller: test.controller
            });
        } else { 
            throw "please pass the test instance into function";
        }
    };

}]);
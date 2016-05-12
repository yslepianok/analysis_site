'use strict';

var myApp = angular.module('myApp', ['ui.router','ngAnimate','pascalprecht.translate','ngIdle','720kb.datepicker','ui.bootstrap']);

myApp.run(['Idle', '$rootScope', '$translate',  function(Idle, $rootScope, $translate){
    Idle.watch(); // start observing user site usage (for expired session)
    angular.element(document).on("click", function (e) {
        $rootScope.$broadcast("documentClicked", angular.element(e.target));
    });
    $rootScope.changeLanguage = function (language) { // change language
        $translate.use(language);
    }
}]);

myApp.constant("CONSTANTS", {
    "LOCAL_STORAGE_KEY": "userInfo",// constant to set and get info about user in localStorage 
    "IMG": "IMG",
    "STRING": "STRING"
});

myApp.config(["$stateProvider", "$urlRouterProvider", "$locationProvider","$translateProvider", "IdleProvider", "KeepaliveProvider", "CONSTANTS", 
             function ($stateProvider, $urlRouterProvider, $locationProvider, $translateProvider, IdleProvider, KeepaliveProvider, CONSTANTS) {

    // translation configuration
    $translateProvider.useStaticFilesLoader({
        prefix: 'lang/lang-',
        suffix: '.json'
    });
    
    // russian is more preferable 
    $translateProvider.preferredLanguage('ru');
    $translateProvider.useSanitizeValueStrategy('escape');
    
    // configuration for expired session
    IdleProvider.idle(1000); // in seconds
    IdleProvider.timeout(5); // in seconds
    

    if (localStorage.getItem(CONSTANTS.LOCAL_STORAGE_KEY)) { // if user is not authorized 
        $urlRouterProvider.otherwise("/mainPage/userProfile");
    } else {
        $urlRouterProvider.otherwise("/loginPage");
        
    }
	
    $stateProvider
        .state('mainPageState', {
            url: "/mainPage",
            abstract: true,
            templateUrl: "../app/pages/src/mainPage/src/tpl/mainPage.tpl.html",
            controller: 'mainPageController'
            
        })
        .state('mainPageState.userProfile', {
            url: "/userProfile",
            templateUrl: "../app/pages/src/userInfoPage/src/tpl/userInfo.tpl.html",
            controller: 'userInfoController'
        })
        .state('mainPageState.editProfile', {
            url: "/editProfile",
            templateUrl: "../app/pages/src/editProfilePage/src/tpl/editProfile.tpl.html",
            controller: 'editProfileController'
        })
        .state('mainPageState.tests', {
            url: "/tests",
            templateUrl: "../app/pages/src/testsPage/src/tpl/tests.tpl.html",
            controller: 'testsController'
        })
        .state('mainPageState.svgGraph', {
            url: "/svgGraph",
            templateUrl: "../app/pages/src/svgGraphPage/src/tpl/svgGraph.tpl.html",
            controller: 'svgController'
        })
        .state('loginPageState', {
            url : "/loginPage",
            templateUrl : "app/pages/src/login/src/tpl/loginPage.tpl.html",
            controller : "loginController"
        })
        .state('registrationPageState', {
            url : "/registration",
            templateUrl : "app/pages/src/login/src/tpl/registrationPage.tpl.html",
            controller : "registrationController"
        })
        .state('forgotPasswordPageState', {
            url: "/forgotPasswordPage",
            templateUrl: "app/pages/src/login/src/tpl/forgotPasswordPage.tpl.html",
            controller: 'resetPasswordController'
        });
}]);
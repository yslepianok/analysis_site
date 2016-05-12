myApp.directive("drpdown", ['$rootScope', 'menuRequestService', function ($rootScope, menuRequestService) {

    return {
        restrict: "E",
        templateUrl: "app/pages/src/mainPage/src/directives/drpdown/tpl/dropDownDirective.tpl.html",
        link: function (scope, element, attrs, ctrl) {
            $rootScope.$on("documentClicked", function (inner, target) {

                var notDrpdownButtonIcon = angular.element(target[0])[0].className != "caret";
                var notMenuItem = angular.element(target[0])[0].className != "menuItem ng-binding"
                var notDrpdownButton = !(angular.element(target[0]).parent().hasClass("btn-group") || angular.element(target[0]).parent().hasClass("open"));
                if (notDrpdownButton && notMenuItem && notDrpdownButtonIcon) {
                    scope.$apply(function () {
                        scope.openDropdown = false;
                    });
                }
            });
            scope.sendRequestMenu = function (item) {
                var menuItemElement = angular.element(document.getElementById(item.menuId));
                var classMarkers = ["glyphicon-ok green", "glyphicon-loading-mask", "glyphicon-remove red"];
                classMarkers.forEach(function (item, i, arr) {
                    if (menuItemElement.hasClass(item)) {
                        menuItemElement.removeClass(item);
                    }
                });
                menuItemElement.addClass("glyphicon-loading-mask");
                menuRequestService().then(function successCallback(response) {
                    menuItemElement.removeClass("glyphicon-loading-mask");
                    if (response.data) {
                        menuItemElement.addClass("glyphicon-ok green");
                    } else {
                        menuItemElement.addClass("glyphicon-remove red");
                    }
                }, function errorCallback(response) {
                    throw "request failed";
                });
            }

        }
    }

}]);
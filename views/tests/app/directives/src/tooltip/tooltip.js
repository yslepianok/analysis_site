'use strict';

myApp.directive('customTooltip',[function () { // declaring directive
    return {
        restrict: 'A', // allowed to use only as a attribute
        link: function (scope, element, attrs, ctrl) {
            $(element).attr('title', scope.role.description);
            $(element).tooltip();
        }
    };
}]);
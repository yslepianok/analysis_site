myApp.controller("drpdownController", ['$scope', 'menuRequestService', function ($scope, menuRequestService) {
    $scope.menu = [{
        menuLabel: "menu item 1",
        menuId: "menuId1",
	}, {
        menuLabel: "menu item 2",
        menuId: "menuId2",
	}, {
        menuLabel: "menu item 3",
        menuId: "menuId3"
	}];
    $scope.openDropdown = false;
    $scope.dropdownToggle = function () {
        if ($scope.openDropdown) {
            $scope.openDropdown = false;
        } else {
            $scope.openDropdown = true;
        }

    }

}]);
myApp.controller('svgController', ['$scope', function ($scope) {
    var lines = [];
    $scope.lines = lines;
    $scope.XOffset = 40; // space between top and horizontal line 
    $scope.YOffset = 20; // space between left and vertical line
    $scope.points = 5; // how many markers should be on vertical and horizontal lines
    $scope.lengthX = 500; // length of horizontal line
    $scope.lengthY = 300; // length of vertical line
    $scope.blockX = ($scope.lengthX) / $scope.points;
    $scope.blockY = ($scope.lengthY) / $scope.points;
    $scope.pointsOffsetX = 0; // start point to calculate x markers
    $scope.getPointsArray = function (num) {
        return new Array(num);
    }

}]);
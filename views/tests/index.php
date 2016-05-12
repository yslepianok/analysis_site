<?php
/* @var $this yii\web\View */
?>
<link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/dist/css/bootstrap.css">
<!--custom styles-->
<link rel="stylesheet" type="text/css" href="../app/common/css/styles.css">
<!-- styles of angular datepicker -->
<link rel="stylesheet" type="text/css" href="../bower_components\angularjs-datepicker\dist\angular-datepicker.min.css">

<div ng-app="myApp">
    <div ui-view></div>


<!--angular including-->
<script src="..\bower_components\angular\angular.js"></script>
<!-- angular ui router including-->
<script src="..\bower_components\angular-ui-router\release\angular-ui-router.js"></script>
<!--angular animate including-->
<script src="..\bower_components\angular-animate\angular-animate.js"></script>
<!-- localization library including -->
<script src="..\bower_components\angular-translate\angular-translate.js"></script>
<!-- library that deals with expired session including -->
<script src="..\bower_components\ng-idle\angular-idle.js"></script>
<!-- library that loads static files for translatin including -->
<script src="..\bower_components\angular-translate-loader-static-files\angular-translate-loader-static-files.js"></script>
<!-- lodash library including -->
<script src="..\bower_components\lodash\lodash.js"></script>
<!-- angular datepicker including -->
<script src="..\bower_components\angularjs-datepicker\dist\angular-datepicker.min.js"></script>
<!-- angular ui-bootstrap including -->
<script src="..\bower_components\angular-bootstrap\ui-bootstrap.js"></script>
<!-- jquery including -->
<script src="..\bower_components\jquery\dist\jquery.js"></script>
<!-- bootstrap including -->
<script src="..\bower_components\bootstrap\dist\js\bootstrap.js"></script>



<!-- main script -->
<script src="..\jsApp.js"></script>

<!--directives including-->
<script src="..\app\directives\src\dateValidator\dateValidator.js"></script>
<script src="..\app\directives\src\descriptionValidator\descriptionValidator.js"></script>
<script src="..\app\directives\src\testDirective\testDirective.js"></script>
<script src="..\app\directives\src\testDirectiveWithEvaluation\testDirectiveWithEvaluation.js"></script>
<script src="..\app\directives\src\testDirectiveWithEvaluationWithTwoCol\testDirectiveWithEvaluationWithTwoCol.js"></script>
<script src="..\app\pages\src\mainPage\src\directives\drpdown\drpdown.js"></script>
<script src="..\app\pages\src\editProfilePage\src\directives\checkrelation\checkrelation.js"></script>
<script src="..\app\directives\src\tooltip\tooltip.js"></script>

<!--controllers including-->
<script src="..\app\pages\src\editProfilePage\src\editProfileController.js"></script>
<script src="..\app\pages\src\login\src\loginController.js"></script>
<script src="..\app\pages\src\login\src\registrationController.js"></script>
<script src="..\app\pages\src\mainPage\src\mainPageController.js"></script>
<script src="..\app\pages\src\userInfoPage\src\userInfoController.js"></script>
<script src="..\app\pages\src\login\src\resetPasswordController.js"></script>
<script src="..\app\pages\src\mainPage\src\drpdownController.js"></script>
<script src="..\app\pages\src\editProfilePage\src\addRelationController.js"></script>
<script src="..\app\pages\src\editProfilePage\src\removeRelationController.js"></script>
<script src="..\app\pages\src\testsPage\src\testsController.js"></script>
<script src="..\app\pages\src\testsPage\src\colorPreferenceController.js"></script>
<script src="..\app\pages\src\testsPage\src\vowelLetterController.js"></script>
<script src="..\app\pages\src\testsPage\src\activitiesAspectsController.js"></script>
<script src="..\app\pages\src\testsPage\src\activitiesLevelsController.js"></script>
<script src="..\app\pages\src\testsPage\src\elementsPrfController.js"></script>
<script src="..\app\pages\src\testsPage\src\filmGenresController.js"></script>
<script src="..\app\pages\src\testsPage\src\formsPrfController.js"></script>
<script src="..\app\pages\src\testsPage\src\geometricShapesAndBodiesController.js"></script>
<script src="..\app\pages\src\testsPage\src\geometricShapesController.js"></script>
<script src="..\app\pages\src\testsPage\src\personPictureController.js"></script>
<script src="..\app\pages\src\testsPage\src\platonBodiesController.js"></script>
<script src="..\app\pages\src\testsPage\src\roleInFilmController.js"></script>
<script src="..\app\pages\src\testsPage\src\schoolClassesController.js"></script>
<script src="..\app\pages\src\testsPage\src\senseOrganController.js"></script>
<script src="..\app\pages\src\testsPage\src\tasteController.js"></script>
<script src="..\app\pages\src\testsPage\src\temperamentController.js"></script>
<script src="..\app\pages\src\testsPage\src\transformationPrfController.js"></script>
<script src="..\app\pages\src\testsPage\src\troubleShootingController.js"></script>
<script src="..\app\pages\src\testsPage\src\vowelLetterController.js"></script>
<script src="..\app\pages\src\testsPage\src\roadToLifeController.js"></script>
<script src="..\app\pages\src\testsPage\src\tvshowsPreferences.js"></script>



<!--services including-->
<script src="..\app\services\loadingMaskService.js"></script>
<script src="..\app\services\loginService.js"></script>
<script src="..\app\services\resetPasswordService.js"></script>
<script src="..\app\services\preferencesService.js"></script>
<script src="..\app\services\menuRequestService.js"></script>
<script src="..\app\services\registrationCompleteService.js"></script>
<script src="..\app\services\testDataService.js"></script>
<script src="..\app\services\passedTestsService.js"></script>
<script src="..\app\services\outputLogicService.js"></script>
</div>
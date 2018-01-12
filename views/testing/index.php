<?php
use yii\bootstrap\Nav;
?>

<script type="text/javascript" src="../js/indexController.js"></script>
<div  ng-app="indexApp">
	<div ng-controller="indexController">
		<div ng-if="testsData.length != 0" ng-repeat="test in testsData" class="col-xs-6 col-md-3" style="background-color : lightgrey; text-align : center;">
			<?php
			echo Nav::widget([
					'items' => [
							['label' => '{{test.description}}', 'url' => ['testing/{{test.name}}']],
						]
			]);
			?>
		</div>
		<h2 ng-if="testsData.length == 0">Поздравляем, Вы прошли все доступные тесты!</h2>
	</div>
</div>

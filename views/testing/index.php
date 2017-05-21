<?php
use yii\bootstrap\Nav;
?>

<script type="text/javascript" src="../js/indexController.js"></script>
<div  ng-app="indexApp">
	<div ng-controller="indexController">
		<div ng-repeat="test in testsData" class="col-xs-6 col-md-3" style="width : 15%; background-color : lightgrey; text-align : center;">
			<?php
			echo Nav::widget([
					//'options' => ['class' => 'navbar-nav'],
					'items' => [
							['label' => '{{test.name}}', 'url' => ['testing/{{test.name}}']],
						]
			]);
			?>
		</div>
	</div>
</div>

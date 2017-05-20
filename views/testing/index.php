<script type="text/javascript" src="../js/indexController.js"></script>
<div  ng-app="indexApp">
	<div ng-controller="indexController">
		<div class="test_el thumbnail" ng-repeat="test in testsData" class="col-xs-6 col-md-3" ng-click="itemSelected(test)">
			{{test.name}}
		</div>
	</div>
</div>

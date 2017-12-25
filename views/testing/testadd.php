
<script type="text/javascript" src="../js/testaddController.js"></script>
<div  ng-app="testaddApp">
	<div ng-controller="testaddController">
    <input class="" type="button" name="" value="Import" ng-click="workWithTest('Import')">
    <input class="" type="button" name="" value="Export" ng-click="workWithTest('Export')">
		<br><br>
    <div class="" ng-if="work=='export'">
			<div>
				 <a ng-repeat="test in testsData" ng-click="exportTest(test.name)">{{test.name}}</a>
			</div>
			<br>
			<textarea id="exportTest" rows="22" cols="100"></textarea>
    </div>
		<div class="" ng-if="work=='import'">
			<textarea id="importTest" rows="22" cols="100"></textarea>
		</div>
		<br>
		<button type="button" ng-if="work=='import'" ng-click="importTest()">{{work}}</button>
	</div>
</div>

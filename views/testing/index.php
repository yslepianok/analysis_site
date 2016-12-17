
<div  ng-app="mainApp">
	<div ng-controller="mainController">
		<div class="allcenter">
			<H1 class="z1">Тестирование по антропометрическим данным</H1>
		</div>
		<div class="allcenter" ng-if="flag==0 || currentTest >= tests.length">
			<a class="st" id="start1" ng-click="Start()">
				Начать тест
			</a>
		</div>
		<div ng-repeat="test in tests" ng-if="$index==currentTest && flag==1">
			<p class="allcenter">Тест {{$index+1}} из {{tests.length}}</p>
			<p class="test-description">{{test.text}}</p>
			<div class="test_el" ng-repeat="item in test.items" class="col-xs-6 col-md-3">
				<a class="thumbnail" ng-click="itemSelected($parent.$index, $index)">
					<img ng-src="{{item}}">	
				</a>									
			</div>
			<div ng-repeat="body in bodys" ng-if="flag1==1 && $index==sex">
				<div class="test_el" ng-repeat="item in body.items" class="col-xs-6 col-md-3">
				   	<a class="thumbnail" ng-click="itemSelected($parent.$index, $index)">
						<img ng-src="{{item}}">	
					</a>	
				</div>
			</div>					
		</div>
		<div class="allcenter" ng-if="currentTest >= tests.length">
				<h3>Поздравляем! Вы ответили на все вопросы тестов. Ваши результаты:</h3>
				<h4 ng-repeat="answer in answers track by $index">
					Тест {{$index+1}} - ответ {{answer+1}}
				</h4>

				<button ng-click="saveResults()"> Save results</button>
		</div>
	</div>
</div>
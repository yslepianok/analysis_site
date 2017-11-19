
<script type="text/javascript" src="../js/man_from_shapesController.js"></script>
<div  ng-app="man_from_shapesApp">
	<div ng-controller="man_from_shapesController">
		<div class="allcenter">
			<h1 class="z1">Тестирование по конструктивному рисунку человека из геометрических фигур</h1>
		</div>
		<div class="allcenter" ng-if="flag==0 || currentTest >= testData.questions.length">
			<a class="st" id="start1" ng-click="Start()">
				Начать тест
			</a>
		</div>

    <!-- Начало логики цикла с вопросами-->
		<div ng-repeat="question in testData.questions" ng-if="$index==currentTest && flag==1">
			<p class="allcenter">Вопрос {{$index+1}} из {{testData.questions.length}}</p>
			<center><img ng-if="question.url" src="{{question.url}}" alt="question.text" width="484" height="150"></center>
			<p class="test-description">{{question.text}}</p>
			<div class="test_el thumbnail" ng-repeat="answer in question.answers" class="col-xs-6 col-md-3" ng-click="itemSelected(answer)">
        {{answer.text}}
        <img ng-if="answer.url" src="{{answer.url}}" alt="answer.text">
			</div>
		</div>
    <!-- Конец логики цикла с вопросами-->

		<div class="allcenter" ng-if="currentTest >= testData.questions.length">
				<h3>Поздравляем! Вы ответили на все вопросы тестов. Ваши результаты:</h3>
				<h4 ng-repeat="answer in answers.raw track by $index">
					Тест {{$index+1}} - ответ {{answer+1}}
				</h4>
				<button ng-click="saveResults()">Save results</button>
		</div>
	</div>
</div>
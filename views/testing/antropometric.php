
<script type="text/javascript" src="../js/antropometricController.js"></script>
<div  ng-app="antropometricApp">
	<div ng-controller="antropometricController">
		<div class="allcenter">
			<h1 class="z1">{{testData.comment}}</h1>
		</div>
		<div class="allcenter" ng-if="flag==0 || currentTest >= testData.questions.length">
			<a class="st" id="start1" ng-click="Start()">
				Начать тест
			</a>
		</div>
    <!-- Начало логики цикла с вопросами-->
		<div ng-repeat="question in testData.questions" ng-if="$index==currentTest && flag==1">
			<p class="allcenter">Вопрос {{$index+1}} из {{testData.questions.length}}</p>
			<p class="test-description">{{question.text}}</p>
      <div class="allcenter">
				<img ng-if="question.url" src="{{question.url}}" alt="question.text">
			</div>
			<div class="row" style="display:flex;justify-content:center">
				<div class="test_el thumbnail text-center" ng-repeat="answer in question.answers" ng-click="itemSelected(answer)">
					{{answer.text}}
					<img ng-if="answer.url" src="{{answer.url}}" alt="answer.text">
				</div>
			</div>
		</div>
    <!-- Конец логики цикла с вопросами-->

		<div class="allcenter" ng-if="currentTest >= testData.questions.length">
			<h3>Вы ответили на все вопросы тестов.</h3>
			<button ng-click="saveResults()"> Назад к списку тестов</button>
		</div>
	</div>
</div>

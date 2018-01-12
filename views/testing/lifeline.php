<script type="text/javascript" src="../js/lifelineController.js"></script>
<div  ng-app="lifelineApp">
	<div ng-controller="lifelineController">
		<div class="allcenter">
			<p class="h1">Дорога жизни</p>
		</div>
		<div class="allcenter" ng-if="flag==0 || currentTest >= testData.questions.length">
			<button type="button" class="btn btn-primary btn-lg btn-block" ng-click="Start()" style="font-weight: bold; font-size: 24px;" >Начать тест</button>
		</div>

    <!-- Начало логики цикла с вопросами-->
		<div class="allcenter" ng-repeat="question in testData.questions" ng-if="$index==currentTest && flag==1">
			<p class="bg-info" style="font-weight: bold; font-size: 14px;">Вопрос {{$index+1}} из {{testData.questions.length}}</p>
			<center><img ng-if="question.url" src="{{question.url}}" alt="question.text"></center>
			<p class="bg-info test-description">{{question.text}}</p>
			<div class="btn-group" ng-repeat="answer in question.answers">
				<button type="button" class="btn btn-success btn-lg" ng-click="itemSelected(answer)">{{answer.text}}</button>
				<img ng-if="answer.url" src="{{answer.url}}" alt="answer.text">
			</div>
		</div>
    <!-- Конец логики цикла с вопросами-->

		<div class="allcenter" ng-if="currentTest >= testData.questions.length">
			<h3>Вы ответили на все вопросы тестов.</h3>
			<button ng-click="saveResults()"> Назад к списку тестов</button>
		</div>
	</div>
</div>
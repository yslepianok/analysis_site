<script type="text/javascript" src="../js/man_from_shapesController.js"></script>
<div  ng-app="man_from_shapesApp">
	<div ng-controller="man_from_shapesController">
		<div class="allcenter">
			<p class="h1">Тестирование по конструктивному рисунку человека из геометрических фигур</p>
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
			<h3>Поздравляем! Вы ответили на все вопросы теста.</h3>
			<!-- Кнопка, вызывающее модальное окно -->
			<a href="#myModal" class="btn btn-warning btn-lg" data-toggle="modal">Ваши результаты</a>  
			<!-- HTML-код модального окна -->
			<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- Заголовок модального окна -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Результаты</h4>
						</div>
						<!-- Основное содержимое модального окна -->
						<div class="modal-body" ng-repeat="answer in answers.raw track by $index">
							Тест {{$index+1}} - ответ {{answer+1}}
						</div>
						<!-- Футер модального окна -->
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
						</div>
					</div>	
				</div>
			</div>
			<br><br>
			<button type="button" class="btn btn-primary btn-lg" ng-click="saveResults()">Сохранить результат</button>
		</div>
	</div>
</div>

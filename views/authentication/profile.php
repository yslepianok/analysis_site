
<script type="text/javascript" src="../js/profileController.js"></script>
<div  ng-app="profileApp">
	<div ng-controller="profileController">
		<div class="">
			<h1>{{userInfo.user.username}}</h1>
			<h3>{{userInfo.userInfo.birth_date}}</h3><br>
			<div class="" ng-repeat="relative in relatives">
				<h4>{{relative.name}}, {{relative.birth_date}}</h4><br>
				<!--<input class="thumbnail" type="button" name="" value="Изменить" ng-click="change()">

				<div class="" ng-if="changeFlag==1">
					<select ng-options="element.name for element in userInfo.relations" ng-model="item"
						ng-change="itemSelected(item)">
					</select>
					<label for="">Birth date</label>
					<input type="text" id="birthDate" value=""><br>
					<input type="button" name="" value="Сохранить изменения" ng-click="saveChange(0)">
					<input type="button" name="" value="Не сохранять" ng-click="saveChange(1)">
					<label ng-if="error==1" style="color: red;">Заполните поля</label>
					<label ng-if="error!=null && error!=1" style="color: red;">{{error}}</label>
				</div>-->

			</div>
			<input class="thumbnail" type="button" name="" value=" + Добавить родственника" ng-if="addRelative==-1" ng-click="funAdd(-1)">
			<div class="" ng-if="addRelative==1">
				<select ng-options="element.name for element in userInfo.relations" ng-model="item"
					ng-change="itemSelected(item)">
				</select>
				<label for="">Birth date</label>
				<input type="text" id="birthDate" value=""><br>
				<input type="button" name="" value="Сохранить данные" ng-click="funAdd(1)">
				<input type="button" name="" value="Отмена" ng-click="funAdd(2)">
				<label ng-if="error==1" style="color: red;">Заполните поля</label>
				<label ng-if="error!=null && error!=1" style="color: red;">{{error}}</label>
			</div>
		</div>
	</div>
</div>

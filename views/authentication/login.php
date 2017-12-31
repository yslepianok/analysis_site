
<script type="text/javascript" src="../js/authController.js"></script>
<style type="text/css">
  .error {
    color : red;
    font-weight: bold;
  }

  .do-not-show {
    display: none;
  }
</style>
<div  ng-app="authApp">
	<div ng-controller="authController">
    <div class="" ng-if="sign_login==0">
      <label for="">Username</label>
      <input class="thumbnail" type="text" ng-model="logUsername" value="">
      <p ng-if="empty[0]!=0" class="error">Введите имя пользователя</p>
      <label for="">Password</label>
      <input class="thumbnail" type="password" ng-model="logPassword" value="">
      <p ng-if="empty[2]!=0" class="error">Введите пароль</p>
      <p ng-if="logError==1" class="error">Не верное имя пользователя или пароль</p>
      <button ng-click="login(logUsername, logPassword)">Войти</button>
      <a ng-click="swap(1)">У меня нет аккаунта</a>
    </div>

    <div class="" ng-if="sign_login==1">
      <label for="">Username</label>
      <input class="thumbnail" type="text" value="" ng-model="username" ng-change="validateInputData(username, 'username');">
      <p ng-if="empty[0]!=0" class="error">Введите имя пользователя</p>
      <p ng-if="used.username==1" class="error">Пользователь с таким именем уже существует</p>
      <p id="username" class="error do-not-show">Длина от 5 до 25 символов латинского алфавита, цифр и "_"</p>

      <label for="">Email</label>
      <input class="thumbnail" type="text" value="" ng-model="email" ng-change="validateInputData(email, 'email');">
      <p ng-if="empty[1]!=0" class="error">Введите адресс электронной почты</p>
      <p ng-if="used.email==1" class="error">Пользователь с такой электронной почтой уже существует</p>
      <p id="email" class="error do-not-show">Некорректный адресс электронной почты!</p>

      <label for="">Password</label>
      <input class="thumbnail" type="password" value="" ng-model="pass" ng-change="validateInputData(pass, 'password'); doPasConfirm(pass,passConfirm);">
      <p ng-if="empty[2]!=0" class="error">Введите пароль</p>
      <p id="password" class="error do-not-show">Длина от 7 до 25 символов латинского алфавита и цифр</p>

      <label for="">Password confirmation</label>
      <input class="thumbnail" type="password" value="" ng-model="passConfirm" ng-change="doPasConfirm(pass, passConfirm)">
      <p id="pasConfirmText" class="error"></p>

      <label for="">BirthDate</label>
      <input class="thumbnail" type="text" value="" ng-model="birthDate" ng-change="validateInputData(birthDate, 'birthDate')">
      <p ng-if="empty[3]!=0">Введите дату рождения</p>
      <p id="birthDate" class="error do-not-show">гггг-мм-дд (только цифры и "-")</p>

      <p ng-if="regError!=null" class="error">{{error}}</p>
      <button ng-click="registration(username, email, pass, birthDate)">Зарегистрироваться</button>
      <a ng-click="swap(0)">Вернуться к авторизации</a>
    </div>
		<div class="" ng-if="sign_login==2">
			<p style="font-size : 50px;">Аккаунт <i>{{username}}</i> создан успешно.</p>
		</div>
	</div>
</div>


<script type="text/javascript" src="../js/authController.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


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
      <input class="thumbnail" type="text" ng-model="logUsername" value="" autocomplete="off">
      <p ng-if="empty[0]!=0" class="error">Введите имя пользователя</p>

      <label for="">Password</label>
      <input class="thumbnail" type="password" ng-model="logPassword" value="">
      <p ng-if="empty[2]!=0" class="error">Введите пароль</p>
      <p ng-if="logError==1" class="error">Неверное имя пользователя или пароль</p>

      <button ng-click="login(logUsername, logPassword)">Войти</button>
      <a ng-click="swap(1)">У меня нет аккаунта</a>
    </div>

    <div class="" ng-if="sign_login==1">
      <label for="">Username</label>
      <input class="thumbnail" type="text" value="" ng-model="username" ng-change="validateInputData(username, 'username');">
      <p ng-if="empty[0]!=0" class="error">Введите имя пользователя</p>
      <p ng-if="used.username==1" class="error">Пользователь с таким именем уже существует</p>
      <p id="username" class="error do-not-show">
        Длина от 5 до 25 символов.<br>
        Допустимы символы латинского алфавита, цифры и "_".
      </p>

      <label for="">Email</label>
      <input class="thumbnail" type="text" value="" ng-model="email" ng-change="validateInputData(email, 'email');">
      <p ng-if="empty[1]!=0" class="error">Введите адресс электронной почты</p>
      <p ng-if="used.email==1" class="error">Пользователь с такой электронной почтой уже существует</p>
      <p id="email" class="error do-not-show">Некорректный адресс электронной почты!</p>

      <label for="">Пароль</label>
      <input class="thumbnail" type="password" value="" ng-model="pass" ng-change="validateInputData(pass, 'password'); doPasConfirm(pass,passConfirm);">
      <p ng-if="empty[2]!=0" class="error">Введите пароль</p>
      <p id="password" class="error do-not-show">
        Длина от 7 до 25 символов.<br>
        Допустимы символы латинского алфавита и цифры.
      </p>

      <label for="">Подтверждение пароля</label>
      <input class="thumbnail" type="password" value="" ng-model="passConfirm" ng-change="doPasConfirm(pass, passConfirm)">
      <p id="pasConfirmText" class="error"></p>

      <label for="">ФИО (по желанию)</label>
      <input class="thumbnail" type="text" value="" ng-model="fio">

      <label for="birthDate">Дата рождения</label>
      <input id="birthDateInput" class="thumbnail" type="text" ng-model="birthDate">
      <p ng-if="empty[3]!=0">Введите дату рождения</p>
      <p class="error do-not-show">гггг-мм-дд (только цифры и "-")</p> 

      <p ng-if="regError!=null" class="error">{{error}}</p>
      <button ng-click="registration(username, email, pass, fio, birthDate)">Зарегистрироваться</button>
      <a ng-click="swap(0)">Вернуться к авторизации</a>
    </div>
		<div ng-if="sign_login==2">
			<p style="font-size : 50px;">Аккаунт <i>{{username}}</i> создан успешно.</p>
		</div>
	</div>
</div>

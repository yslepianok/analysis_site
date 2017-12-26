
<script type="text/javascript" src="../js/authController.js"></script>
<div  ng-app="authApp">
	<div ng-controller="authController">
    <div class="" ng-if="sign_login==0">
      <label for="">Username</label>
      <input class="thumbnail" type="text" name="login" value="">
      <p ng-if="empty[0]!=0">Enter username</p>
      <label for="">Password</label>
      <input class="thumbnail" type="password" name="login" value="">
      <p ng-if="empty[2]!=0">Enter password</p><br>
      <button ng-click="login()">Войти</button>
      <a ng-click="swap(1)">У меня нет аккаунта</a>
    </div>

    <div class="" ng-if="sign_login==1">
      <label for="">Username</label>*
      <input class="thumbnail" type="text" name="register" value="" ng-blur="check('username',0)">
      <p ng-if="empty[0]!=0">Enter username</p>
      <p ng-if="used.username==1" style="color:red;">Username is used</p>
      <label for="">Email</label>*
      <input class="thumbnail" type="text" name="register" value="" ng-blur="check('email',1)">
      <p ng-if="empty[1]!=0">Enter email</p>
      <p ng-if="used.email==1" style="color:red;">Email is used</p>
      <label for="">Password</label>*
      <input class="thumbnail" type="password" name="register" value="">
      <p ng-if="empty[2]!=0">Enter password</p>
      <label for="">BirthDate</label>*
      <input class="thumbnail" type="text" name="register" value="">
      <p ng-if="empty[3]!=0">Enter birthDate</p><br>
      <label ng-if="error" style="color:red;">{{error}}</label><br>
      <button ng-click="registration()">Зарегистрироваться</button>
      <a ng-click="swap(0)">Вернуться к авторизации</a>
    </div>
		<div class="" ng-if="sign_login==2">
			<p style="font-size : 50px;">Аккаунт <i>{{authData.username}}</i> создан успешно.</p>
		</div>
	</div>
</div>

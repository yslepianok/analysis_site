<?php

namespace app\controllers;

use Faker\Provider\DateTime;

use Yii;

use app\models\User;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;


class AuthenticationController extends \yii\web\Controller
{
  public function beforeAction($action)
  {
      if ($action->id == 'sign') {
          $this->enableCsrfValidation = false;
      }
      if ($action->id == 'registration') {
          $this->enableCsrfValidation = false;
      }
      if ($action->id == 'check') {
          $this->enableCsrfValidation = false;
      }
      return parent::beforeAction($action);
  }

  public function actionLogin()
  {
    $session = Yii::$app->session;
    $user = new User();
    if (!$session->get('user')) {
      return $this->render('login',[
      'userModel' => $user]);
    }
    else {
      return $this->goBack();
    }
  }

  public function actionRegistration()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      return $this->goBack();
    }
    $this->enableCsrfValidation = false;
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $request = \Yii::$app->request;
    $data = json_decode($request->rawBody);

    $user = new User();
    $user->username = $data->username;
    $user->password = $data->password;
    $user->email = $data->email;
    $user->birthDate = $data->birthDate;

    if (!$user->save()){
      \Yii::$app->response->statusCode=500;
      //return "Error with saving data";
      return $user->errors;
    }
    else
    {
      return "success";
    }
  }

  public function actionSign()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      return $this->redirect(Yii::$app->homeUrl);
    }
    $this->enableCsrfValidation = false;
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $request = \Yii::$app->request;
    $data = json_decode($request->rawBody);
    $user =  User::find()->where(['username' => $data->username])->one();
    if(!empty($user))
    {
      if ($user->password == $data->password) {
        if (!$session->isActive) {
          $session->open();
          $session->set('user', $user);
        }
        else {
          $session->set('user', $user);
        }
        return "success";
      }
      return "passwordErr";
    }
    return "usernameErr";
  }

  public function actionLogout()
  {
    $session = Yii::$app->session;
    $session->remove('user');
    $session->close();
    $session->destroy();
    return $this->redirect(Yii::$app->homeUrl);
  }

  public function actionCheck()
  {
    $this->enableCsrfValidation = false;
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $request = \Yii::$app->request;
    $data = json_decode($request->rawBody);
    $user =  User::find()->where([$data->field => $data->value])->one();
    if (!empty($user)) {
      return false;
    }
    return true;
  }
  public function actionProfile() {
    return $this->render('profile');
  }
}

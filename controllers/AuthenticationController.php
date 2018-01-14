<?php

namespace app\controllers;

use Faker\Provider\DateTime;

use Yii;

use app\models\User;
use app\models\UserInfo;
use app\models\UserToUser;
use app\models\UserRelation;
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
      if ($action->id == 'addrelative') {
          $this->enableCsrfValidation = false;
      }
      return parent::beforeAction($action);
  }

  public function actionGetuserinfo() {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $response = [];
      $user = new User();
      $user = $session->get('user');
      $userInfo =  UserInfo::find()->where(['user_id' => $user->id])->one();
      $userToUser = UserToUser::find()->where(['user_id' => $userInfo->id])->all();
      $relatives = [];
      for ($i=0; $i < count($userToUser); $i++) {
        $relatives[$i] = UserInfo::find()->where(['id' => $userToUser[$i]->user_related_id])->one();
      }
      $userRelation = UserRelation::find()->all();
      $response['user'] = $user;
      $response['userInfo'] = $userInfo;
      $response['userToUser'] = $userToUser;
      $response['relations'] = $userRelation;
      $response['relatives'] = $relatives;
      return $response;
    }
    else {
      return $this->goBack();
    }
  }

  public function actionAddrelative() {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      $this->enableCsrfValidation = false;
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $request = \Yii::$app->request;
      $data = json_decode($request->rawBody);
      $userInfo = new UserInfo();
      $userInfo->birth_date = $data->birthDate;
      $userInfo->user_id = ($session->get('user')->id)*(-1);
      if ($userInfo->save()) {
        $userToUser = new UserToUser();
        $userToUser->user_id = $data->user_id;
        $userInfo = UserInfo::find()->where(['user_id' => ($session->get('user')->id)*(-1)])->andWhere(['birth_date' => $data->birthDate])->one();
        $userToUser->user_related_id = $userInfo->id;
        $userToUser->relation_id = $data->relative_id;
        if ($userToUser->save()) {
          return "success";
        }
        else {
          \Yii::$app->response->statusCode=500;
          //return "Error with saving data";
          return $userToUser->errors;
        }
        return $userToUser;
      }
      else {
        \Yii::$app->response->statusCode=500;
        //return "Error with saving data";
        return $userInfo->errors;
      }
    }
    else {
      return $this->goBack();
    }
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
    $userInfo = new UserInfo();
    $user->username = $data->username;
    $user->password = $data->password;
    $user->email = $data->email;
    $user->fio = $data->fio;
    $userInfo->birth_date = $data->birthDate;

    if (!$user->save()){
      \Yii::$app->response->statusCode=500;
      //return "Error with saving data";
      return $user->errors;
    }
    else
    {
      $user = User::find()->where(['username' => $data->username])->one();
      $userInfo->user_id = $user->id;
      if(!$userInfo->save()) {
        \Yii::$app->response->statusCode=500;
        //return "Error with saving data";
        return $userInfo->errors;
      }
      return 'success';
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
    }
    \Yii::$app->response->statusCode=500;
    return;
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

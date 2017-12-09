<?php

namespace app\controllers;

use Faker\Provider\DateTime;

use Yii;

use yii\filters\AccessControl;

use yii\helpers\Json;

use yii\web\Controller;

use yii\filters\VerbFilter;

use app\models\UserToTesting;

use app\models\User;

use app\models\ActivityType;


class AreasofactivityController extends \yii\web\Controller
{
  public function beforeAction($action)
  {
      if ($action->id == 'information') {
          $this->enableCsrfValidation = false;
      }
      if ($action->id == 'activity') {
          $this->enableCsrfValidation = false;
      }
      if ($action->id == 'rsfromdate') {
        $this->enableCsrfValidation = false;
    }
      return parent::beforeAction($action);
  }

  public function actionInformation()
  {
    $this->enableCsrfValidation = false;
    $user_id = Yii::$app->request->get('user_id');
    $inform =  UserToTesting::find()->where(['user_id' => $user_id])->all();

    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    if (!empty($inform))
      return  $inform;
    else
      return "You do not test!";
  }

  public function actionActivity()
  {
    $this->enableCsrfValidation = false;
    $activity =  ActivityType::find()->all();

    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    if (!empty($activity))
      return  $activity;
    else
      return "Error!";
  }

  public function actionIndex()
  {
      return $this->render('index');
  }

  public function actionRsfromdate()
  {
    $this->enableCsrfValidation = false;
    if (!Yii::$app->user->identity) {
      $resp = \Yii::$app->response;
      $resp->format = \yii\web\Response::FORMAT_JSON;
      $resp->setStatusCode(401);
      $resp->data = ["status"=>"you are not authorised to do this"];
      return $resp->send();
    } else {
      $user_id = Yii::$app->user->identity->id;
      $user = User::find()->where(["id" => $user_id])->one();
      Yii::warning('Found user: ');
      Yii::warning($user);
      // $inform =  UserToTesting::find()->where(['user_id' => $user_id])->all();

      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      if (!empty($inform))
        return  $inform;
      else
        return "You do not test!";
    }
  }
}

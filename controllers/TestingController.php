<?php

namespace app\controllers;

use Faker\Provider\DateTime;

use Yii;

use yii\filters\AccessControl;

use yii\helpers\Json;

use yii\web\Controller;

use yii\filters\VerbFilter;

use app\models\Test;
use app\models\Question;
use app\models\Answer;


class TestingController extends \yii\web\Controller
{
  public function actionTest()
  {
    $this->enableCsrfValidation = false;
    $testName = Yii::$app->request->get('name');
    $test =  Test::find()->where(['name' => $testName])->with('questions','questions.answers')->all();

    $test = $test[0]->toArray();

    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    return $test;
  }

  public function actionT(){
    return 10;
  }

}

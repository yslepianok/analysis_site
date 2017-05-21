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
use app\models\UserToTesting;


class TestingController extends \yii\web\Controller
{
  public function beforeAction($action)
  {
      if ($action->id == 'saveresults') {
          $this->enableCsrfValidation = false;
      }
      if ($action->id == 'selected') {
          $this->enableCsrfValidation = false;
      }
      return parent::beforeAction($action);
  }

  public function actionTest()
  {
    $this->enableCsrfValidation = false;
    $testName = Yii::$app->request->get('name');
    $test =  Test::find()->where(['name' => $testName])->with('questions','questions.answers')->all();

    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    if (!empty($test))
      return  $test[0];
    else
      return "no such test";
  }

  public function actionTests()
  {
    $this->enableCsrfValidation = false;
    $test =  Test::find()->all();
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    if (!empty($test))
      return  $test;
    else
      return "no such test";
  }

  public function actionSelected()
  {
    $this->enableCsrfValidation = false;
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $request = \Yii::$app->request;
    $data = json_decode($request->rawBody);

    if (!$data)
    {
      \Yii::$app->response->statusCode=400;
      return "Wrong request";
    }

    $test = new Test();
    $test->name = $data->test_name;
    if (!$test)
    {
      \Yii::$app->response->statusCode=400;
      return $test->errors;
    }
    return $test->name;
  }

  public function actionSaveresults()
  {
    $this->enableCsrfValidation = false;
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $request = \Yii::$app->request;
    $data = json_decode($request->rawBody);

    if (!$data)
    {
      \Yii::$app->response->statusCode=400;
      return "Wrong request";
    }

    $results = new UserToTesting();
    $results->user_id = $data->user_id;
    $results->testing_id = $data->testing_id;
    $results->raw_results = json_encode($data->data->raw);
    $results->calculated_results = json_encode($data->data->matrix);

    if (!$results->save()){
      \Yii::$app->response->statusCode=500;
      //return "Error with saving data";
      return $results->errors;
    }
    else
    {
      return $result;
    }
  }

  public function actionIndex()
  {
      return $this->render('index');
  }

  public function actionColors()
  {
      return $this->render('colors');
  }
}

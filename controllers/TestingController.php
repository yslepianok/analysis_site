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
      if ($action->id == 'test') {
          $this->enableCsrfValidation = false;
      }
      if ($action->id == 'insertdb') {
          $this->enableCsrfValidation = false;
      }
      return parent::beforeAction($action);
  }

  public function actionTest()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
        $this->enableCsrfValidation = false;
        $testName = Yii::$app->request->get('name');
        $test =  Test::find()->where(['name' => $testName])->with('questions','questions.answers')->all();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if (!empty($test))
          return  $test[0];
        else
          return $testName;
    }
    return $this->redirect(Yii::$app->homeUrl);
  }

  public function actionTests()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
        $this->enableCsrfValidation = false;
        $test =  Test::find()->select('name, comment')->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (!empty($test))
          return  $test;
        else
          return "no such test";
      }
    return $this->redirect(Yii::$app->homeUrl);
  }

  public function actionSaveresults()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
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
          return $results;
        }
    }
    return $this->redirect(Yii::$app->homeUrl);
  }

  public function actionInsertdb()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      if ($session->get('user')->scope == "admin") {
        $this->enableCsrfValidation = false;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = \Yii::$app->request;
        $data = json_decode($request->rawBody);
        for ($k=0;$k<count($data);$k++)
        {
          $chk = Test::findOne(['name' => $data->name]);
          if ($chk) {
            //Delete test if exists
            $cnt = question::find()->where(['test_id' => $chk->id])->count();
            for ($p=0; $p < $cnt; $p++) {
              $q = question::findone(['test_id' => $chk->id]);
              answer::deleteall(['question_id' => $q->id]);
              $q->delete();
            }
            $chk->delete();
          }
          $test = new test();
          $test->name = $data->name;
          $test->weight = $data->weight;
          $test->comment = $data->comment;
          if (!$test->save())
          {
            \Yii::$app->response->statusCode=500;
            return $test->errors;
          }
          $test = Test::findOne(['name' => $data->name]);
          for ($i=0;$i<count($data->questions);$i++)
          {
            $question = new question();
            $question->test_id = $test->id;
            $question->name = $data->questions[$i]->name;
            $question->url = $data->questions[$i]->url;
            $question->text = $data->questions[$i]->text;
            if (!$question->save())
            {
            \Yii::$app->response->statusCode=500;
            return $question->errors;
            }
            $question = question::findOne(['name' => $data->questions[$i]->name]);
            for ($j=0;$j<count($data->questions[$i]->answers);$j++)
            {
              $answer = new answer();
              $answer->question_id = $question->id;
              $answer->name = $data->questions[$i]->answers[$j]->name;
              $answer->url = $data->questions[$i]->answers[$j]->url;
              $answer->text = $data->questions[$i]->answers[$j]->text;
              $answer->cells = $data->questions[$i]->answers[$j]->cells;
              $answer->weight = $data->questions[$i]->answers[$j]->weight;
              if (!$answer->save())
              {
                \Yii::$app->response->statusCode=500;
                return $answer->errors;
              }
            }
          }
        }
        return 'Тест добавлен успешно';
      }

    }
    return $this->redirect(Yii::$app->homeUrl);
  }

  public function actionIndex()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      return $this->render('index');
    }
    return $this->redirect(Yii::$app->homeUrl);
  }
  public function actionTestadd()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      if ($session->get('user')->scope == "admin") {
        return $this->render('testadd');
      }

    }
    return $this->redirect(Yii::$app->homeUrl);
  }
  public function actionAntropometric()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      return $this->render('antropometric');
    }
    return $this->redirect(Yii::$app->homeUrl);
  }
  public function actionColors()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      return $this->render('colors');
    }
    return $this->redirect(Yii::$app->homeUrl);
  }

  public function actionSence()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      return $this->render('sence');
    }
    return $this->redirect(Yii::$app->homeUrl);
  }

  public function actionTaste()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      return $this->render('taste');
    }
    return $this->redirect(Yii::$app->homeUrl);
  }

  public function actionPlatonic_solids()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      return $this->render('platonic_solids');
    }
    return $this->redirect(Yii::$app->homeUrl);
  }

  public function actionElements()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      return $this->render('elements');
    }
    return $this->redirect(Yii::$app->homeUrl);
  }

  public function actionAspects()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      return $this->render('aspects');
    }
    return $this->redirect(Yii::$app->homeUrl);
  }

  public function actionActivity_levels()
  {
    $session = Yii::$app->session;
    if ($session->get('user')) {
      return $this->render('activity_levels');
    }
    return $this->redirect(Yii::$app->homeUrl);
  }

  public function actionMan_from_shapes()
 {
   $session = Yii::$app->session;
   if ($session->get('user')) {
     return $this->render('man_from_shapes');
   }
   return $this->redirect(Yii::$app->homeUrl);
 }

  public function actionTemperament()
 {
   $session = Yii::$app->session;
   if ($session->get('user')) {
     return $this->render('temperament');
   }
   return $this->redirect(Yii::$app->homeUrl);
 }

  public function actionFilm_genre()
 {
   $session = Yii::$app->session;
   if ($session->get('user')) {
     return $this->render('film_genre');
   }
   return $this->redirect(Yii::$app->homeUrl);
 }
 public function actionPreferences_of_school_subjects()
{
  $session = Yii::$app->session;
  if ($session->get('user')) {
    return $this->render('preferences_of_school_subjects');
  }
  return $this->redirect(Yii::$app->homeUrl);
}
public function actionLifeline()
{
 $session = Yii::$app->session;
 if ($session->get('user')) {
   return $this->render('lifeline');
 }
 return $this->redirect(Yii::$app->homeUrl);
}
}

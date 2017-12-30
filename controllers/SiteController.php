<?php

namespace app\controllers;

use app\models\ActivityType;
use app\models\Profession;
use app\models\PythagorasSquare;
use app\models\SquareForm;
use app\models\Test;
use app\models\TestedPerson;
use app\models\UserRelation;
use app\models\UserToActivity;
use app\models\UserToUser;
use app\models\UserToTesting;
use Faker\Provider\DateTime;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

  public function beforeAction($action)
   {
       // ...set `$this->enableCsrfValidation` here based on some conditions...
       // call parent method that will check CSRF if such property is true.
       if ($action->id === 'matrix') {
           $this->enableCsrfValidation = false;
       }
       return parent::beforeAction($action);
   }

    public function actionIndex()
    {
        return $this->redirect('site/kvadrat');
    }

    public function actionKvadrat()
    {
        $model = new SquareForm();
        $kv = [];
        $kvEx = [];
        $kvW = [];
        $specials = [];
        $professions = [];
        $bundle = [];
        $professionsNew = [];

        if ($model->load(Yii::$app->request->post())) {
            $date = \DateTime::createFromFormat('d-m-Y',$model->birth_date);

            $square = new PythagorasSquare($date);

            //Yii::warning(Json::encode(Yii::$app->request->post()));

            $person = new TestedPerson();
            $person->birth_date = $date->format('Y-m-d H:i:s');;
            $person->save();

            if (isset(Yii::$app->request->post()['Relatives']))
            {
                $relatives = Yii::$app->request->post()['Relatives'];
                foreach ($relatives as $relative) {
                    $date = \DateTime::createFromFormat('d-m-Y',$relative['BDate']);
                    $personRel = new TestedPerson();
                    $personRel->birth_date = $date->format('Y-m-d H:i:s');;
                    $personRel->save();

                    $relation = new UserToUser();
                    $relation->user_id = $person->id;
                    $relation->user_related_id = $personRel->id;
                    $rel = UserRelation::find()->where('name=:name',[':name'=>$relative['Type']])->one();
                    if ($rel == null)
                        throw new \HttpException('Wrong relation name, '.$relative['Type'], 400);
                    $relation->relation_id = $rel->id;
                    $relation->save();
                }

                $kvW = $square::countWeightedSquare($person);
                //$pairs = PythagorasSquare::foundMainElementPairs($kvW);
                //$specialities = PythagorasSquare::getSpecialitiesForPairs($pairs);
                //Yii::warning('SpecialityList: '.implode('; ',$specialities));
            }
            $specials = UserToActivity::getUserSpecialities($person);

            $kv = $square->simpleMatrix;
            $kvEx = $square->extendedMatrix;
            $bundle = UserToActivity::getUserSpecialitiesExtended($person);
            $professions = Profession::getUserProfessions($person);
            $professionsNew = Profession::getUserProfessionsLite($person);
            if ($professions!=null)
            {
                $s = count($professions);
                for ($i=0;$i<$s;$i++)
                    for ($j=$i;$j<$s;$j++)
                        if ($professions[$i][1] <= $professions[$j][1])
                        {
                            $buf = $professions[$i];
                            $professions[$i] = $professions[$j];
                            $professions[$j] = $buf;
                        }
            }
        }
        return $this->render('kvadrat', [
            'model' => $model,
            'kv' => $kv,
            'kvEx' => $kvEx,
            'kvW' => $kvW,
            'specialities' => $specials,
            'professions'=>$professions,
            'bundle'=>$bundle,
            'professionsNew'=>$professionsNew,
        ]);
    }

    /*public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }*/

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionMatrix()
    {
      $this->enableCsrfValidation = false;
      $request = Yii::$app->request;
      if ($request->isPost) {
        $bdate = $request->getBodyParam('bdate');
        $date = \DateTime::createFromFormat('d-m-Y',$bdate);
        $kvW = PythagorasSquare::countExtendedSquare($date);
        $return_json = UserToActivity::getCellsWeight($kvW);
      }
      else {
        $return_json = ['status'=>'error_not_post'];
      }
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return $return_json;
    }

    public function actionProfresults() {
        $accountId = Yii::$app->session->get('user')->id;// TODO use in future Yii::$app->user->identity->id;
        Yii::warning('Account ID: '.$accountId);

        $person = TestedPerson::find()->where(['user_id' => $accountId])->one();
        $personId = $person->id;
        Yii::warning('Person ID: '.$personId);

        // Старые данные из Квадрата Пифагора
        $kvW = PythagorasSquare::countWeightedSquare($person);
        $oldWeightedCells = UserToActivity::getCellsWeight($kvW);

        // Новые данные из психологических тестов
        $testWeightedCells = UserToTesting::getUserTestResultsMatrix($accountId);

        // Теперь мержим старые и новые результаты
        $mergedWeights = UserToTesting::mergeKvAndTesting($oldWeightedCells, $testWeightedCells);

        // Теперь можно и профессии посчитать
        $oldSpecializations = UserToActivity::getUserSpecialitiesByMatrix($oldWeightedCells);

        // Получаем наиболее и наименее рекомендуемые сферы деятельности
        $oldSpecsTmp = $oldSpecializations[5];
        $oldSpecsRcmnd = [];
        foreach($oldSpecsTmp as $key=>$val) {
            // Получаем массив с ключом-именем и значением-весом
            $spec = $oldSpecializations[3][$val];
            $oldSpecsRcmnd[$spec->name] = $oldSpecializations[4][$val];
        }

        $oldSpecsTmp = $oldSpecializations[6];
        $oldSpecsNotRcmnd = [];
        foreach($oldSpecsTmp as $key=>$val) {
            // Получаем массив с ключом-именем и значением-весом
            $spec = $oldSpecializations[3][$val];
            $oldSpecsNotRcmnd[$spec->name] = $oldSpecializations[4][$val];
        }

        arsort($mergedWeights);
        $newSpecializations = UserToActivity::getUserSpecialitiesByMatrix($mergedWeights);
        // Получаем наиболее и наименее рекомендуемые сферы деятельности
        $newSpecsTmp = $newSpecializations[5];
        $newSpecsRcmnd = [];
        foreach($newSpecsTmp as $key=>$val) {
            // Получаем массив с ключом-именем и значением-весом
            $spec = $newSpecializations[3][$val];
            $newSpecsRcmnd[$spec->name] = $newSpecializations[4][$val];
        }

        $newSpecsTmp = $newSpecializations[6];
        $newSpecsNotRcmnd = [];
        foreach($newSpecsTmp as $key=>$val) {
            // Получаем массив с ключом-именем и значением-весом
            $spec = $newSpecializations[3][$val];
            $newSpecsNotRcmnd[$spec->name] = $newSpecializations[4][$val];
        }

        $oldProfessions = Profession::getUserProfessionsLiteByMatrix($oldSpecializations);
        $newProfessions = Profession::getUserProfessionsLiteByMatrix($newSpecializations);

        if (count($testWeightedCells) == 0)
            $wasTested = false;
        else 
            $wasTested = true;

        return $this->render('profresults', [
            'user' => $person,
            'oldWeightedCells' => $oldWeightedCells,
            'testWeightedCells' => $testWeightedCells,
            'mergedWeightedCells' => $mergedWeights,
            'oldSpecsRcmnd' => $oldSpecsRcmnd,
            'oldSpecsNotRcmnd' => $oldSpecsNotRcmnd,
            'oldProf' => $oldProfessions,
            'newSpecsRcmnd' => $newSpecsRcmnd,
            'newSpecsNotRcmnd' => $newSpecsNotRcmnd,
            'newProf' => $newProfessions,
            'wasTested' => $wasTested
        ]);
    }
}

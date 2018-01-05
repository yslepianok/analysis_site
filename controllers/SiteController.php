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
use app\models\UserToProfessionTesting;
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
        if (Yii::$app->session->get('user') == null)
            return $this->redirect('index');

        $accountId = Yii::$app->session->get('user')->id;// TODO use in future Yii::$app->user->identity->id;
        Yii::warning('Account ID: '.$accountId);

        $result = UserToProfessionTesting::find()->orderBy(['timestamp' => SORT_DESC])->one();
        if ($result) {
            $resDate = strtotime($result->timestamp) + 60 * 5; // add 5 minutes
            $now = time();
            if ($now <= $resDate)
                $id = $result->id;
        }

        if (array_key_exists('resultId', Yii::$app->request->get())) {
            $id = Yii::$app->request->get()['resultId'];
        }

        if (Yii::$app->request->post()) {
            //is post
            $model = Yii::$app->request->post()['testResults'];
            $testResultsData = UserToProfessionTesting::find()->where(['id' => $model['id']])->one();
            $oldBundle = Yii::$app->request->post()['testResults']['old'];//json_decode($testResultsData->oldRawResults, true);
            $oldBundle['id'] = $model['id'];
            $testResultsData->oldRawResults = json_encode($oldBundle);
            $wasTested = ($testResultsData->newRawResults) ? true : false;
            $newBundle = ($wasTested) ? Yii::$app->request->post()['testResults']['new'] : null;//json_decode($testResultsData->newRawResults, true) : null;
            if ($newBundle) {
                $newBundle['id'] = $model['id'];
                $testResultsData->oldRawResults = json_encode($newBundle);
            }
            
            $testResultsData->newKnown = Yii::$app->request->post()['testResults']['newKnown'];
            $testResultsData->impressedBy = Yii::$app->request->post()['testResults']['impressedBy'];
            $testResultsData->save();

            $resultsId = $testResultsData->id;            
        } else if ($id) {
            $resultsId = $id;
            $testResultsData = UserToProfessionTesting::find()->where(['id' => $id])->one();
            $oldBundle = json_decode($testResultsData->oldRawResults, true);
            $oldBundle['id'] = $resultsId;
            $testResultsData->oldRawResults = json_encode($oldBundle);
            $wasTested = ($testResultsData->newRawResults) ? true : false;
            $newBundle = ($wasTested) ? json_decode($testResultsData->newRawResults, true) : null;
            if ($newBundle) {
                $newBundle['id'] = $resultsId;
            }
        } else {
            //is get
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
    
            $oldBundle = $this->prepareViewResults($oldSpecsRcmnd, $oldSpecsNotRcmnd, $oldProfessions);
            $testResultsData = new UserToProfessionTesting();
            $testResultsData->user_id = $accountId;
            $testResultsData->oldRawResults = json_encode($oldBundle);

            if ($wasTested) {
                $newBundle = $this->prepareViewResults($newSpecsRcmnd, $newSpecsNotRcmnd, $newProfessions);
                $testResultsData->newRawResults = json_encode($newBundle);                
            }

            $testResultsData->save();

            $resultsId = $testResultsData->id;
    
            $oldBundle['id'] = $testResultsData->id;
            if ($wasTested)
                $newBundle['id'] = $testResultsData->id;
        } 
        
        return $this->render('profresults', [
            'resultsId' => $resultsId,
            'oldBundle' => $oldBundle,
            'newBundle' => ($wasTested) ? $newBundle : null,
            'wasTested' => $wasTested,
            'impressedBy' => $testResultsData->impressedBy,
            'newKnown' => $testResultsData->newKnown
        ]);
    }

    private function prepareViewResults($specsRcmnd, $specsNotRcmnd, $prof) {
        $returnBunble = [
            'specRcmnd' => [],
            'specNotRcmnd' => [],
            'prof'=> []
        ];

        $key = array_keys($specsRcmnd)[0];
        $max = $specsRcmnd[$key];
        //$key = array_keys($specsRcmnd)[count($specsRcmnd)-1];
        $key = array_keys($specsNotRcmnd)[0];
        $min = $specsNotRcmnd[$key];
        foreach ($specsRcmnd as $key=>$val) {
            $spec = [];
            $spec['name'] = $key;
            $spec['sign'] = 5;
            $spec['value'] = round(($val-$min)/($max-$min) * 100, 1);

            $returnBunble['specRcmnd'] []= $spec;
        };

        $key = array_keys($specsNotRcmnd)[0];
        $max = $specsNotRcmnd[$key];
        //$key = array_keys($specsNotRcmnd)[count($specsNotRcmnd)-1];
        $key = array_keys($specsRcmnd)[0];
        $min = $specsRcmnd[$key];
        foreach ($specsNotRcmnd as $key=>$val) {
            $spec = [];
            $spec['name'] = $key;
            $spec['sign'] = 5;
            $spec['value'] = round(($val-$min)/($max-$min) * 100, 1);

            $returnBunble['specNotRcmnd'] []= $spec;
        };

        $profnames = [];
        $profvalues = [];
        $values = array_values($prof[1]);                    
        $multipler = 100 / $values[0];
        foreach ($prof[1] as $key=>$val) {
            $profItem = [];
            $profItem['name'] = $prof[0][$key];
            $profItem['sign'] = 5;
            $profItem['value'] = round($val * $multipler, 1);

            $returnBunble['prof'] []= $profItem;
        };

        return $returnBunble;
    }
}

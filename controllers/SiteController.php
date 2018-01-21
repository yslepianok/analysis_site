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
        return $this->render('index');
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

        $accountId = Yii::$app->session->get('user')->id;
        Yii::warning('Account ID: '.$accountId);        

        if (Yii::$app->request->post()) {
            // Need to save a result score
            // @TODO
            $basicData = Yii::$app->request->post()['basicData'];
            $testResults = Yii::$app->request->post()['testResults'];
            $testResultsData = UserToProfessionTesting::find()->where(['id' => $basicData['id']])->one();

            if ($testResultsData->passedTestsCount == 0) {
                $testResultsData->oldRawResults = json_encode($testResults);
            } else {
                $testResultsData->newRawResults = json_encode($testResults);
            }

            $testResultsData->impressedBy = $basicData['impressedBy'];
            $testResultsData->newKnown = $basicData['newKnown'];
            $testResultsData->overallScore = $basicData['overallScore'];
            $testResultsData->scoreSaved = 1;
            $testResultsData->save();

            $bundle = $testResults;
            $passedTestsCount = $testResultsData->passedTestsCount;
            $overallTestsCount = Test::find()->count();
        } else {
            $testResultsData = UserToProfessionTesting::find()->where(['user_id' => $accountId])->orderBy(['timestamp' => SORT_DESC])->one();
            $passedTestsCount = UserToTesting::getUserTestCount($accountId);
            $overallTestsCount = Test::find()->count();

            if ($testResultsData && $testResultsData->passedTestsCount==$passedTestsCount) {
                // Old result exists and suitable
                if ($passedTestsCount != 0) {
                    $bundle = json_decode($testResultsData->newRawResults, true);
                } else {
                    $bundle = json_decode($testResultsData->oldRawResults, true);  
                }
    
                $bundle['id'] = $testResultsData->id;
            } else {
                // Full new result needed
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
        
                $bundle = $this->prepareViewResults($oldSpecsRcmnd, $oldSpecsNotRcmnd, $oldProfessions);
                $testResultsData = new UserToProfessionTesting();
                $testResultsData->user_id = $accountId;
                $testResultsData->passedTestsCount = $passedTestsCount;
                $testResultsData->oldRawResults = json_encode($bundle);
    
                if ($passedTestsCount > 0) {
                    $bundle = $this->prepareViewResults($newSpecsRcmnd, $newSpecsNotRcmnd, $newProfessions);
                    $testResultsData->newRawResults = json_encode($bundle);                
                }
    
                $testResultsData->save();
            
                $bundle['id'] = $testResultsData->id;
            }
        } 

        /*
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
        
        } */
        
        return $this->render('profresults', [
            'resultsId' => $testResultsData->id,
            'bundle' => $bundle,
            'activitiesShortNames' => $this->getAreasOfActivityShortNames(),
            'passedTestsCount' => $passedTestsCount,
            'overallTestsCount' => $overallTestsCount,
            'impressedBy' => $testResultsData->impressedBy,
            'newKnown' => $testResultsData->newKnown,
            'overallScore' => ($testResultsData->overallScore) ? $testResultsData->overallScore : 5,
            'scoreSaved' => $testResultsData->scoreSaved
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

    private function getAreasOfActivityShortNames() {
        $returnArr = [];
        $activities = ActivityType::find()->all();

        foreach($activities as $activity) {
            $returnArr[$activity->name] = $activity->shortname;
        }

        return $returnArr;
    }

    public function actionStatistics()
    {
        $session = Yii::$app->session;
        if ($session->get('user')) {
            if ($session->get('user')->scope == "admin") {
                $activitiesRecommended = [];
                $activitiesNotRecommended = [];
                $professionsRecommended = [];
                $userMarksActivities = ['1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0];
                $userMarksNotActivities = ['1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0];
                $userMarksProfessions = ['1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0];
                $userMarksOverall = ['1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0];
                $specArray = [];
                $profArray = [];
                $arr = UserToProfessionTesting::find()->where(['scoreSaved'=>1])->all();

                foreach ($arr as $test) {
                    $results = json_decode($test->oldRawResults, true);
                    if ($test->passedTestsCount != 0)
                        $results = json_decode($test->newRawResults, true);

                    $userMarksOverall[$test->overallScore] += 1;

                    foreach($results['specRcmnd'] as $spec) {
                        if (!array_key_exists($spec['name'], $activitiesRecommended))
                            $activitiesRecommended[$spec['name']] = 1;
                        else 
                            $activitiesRecommended[$spec['name']] += 1;

                        if (!array_key_exists($spec['name'], $specArray)) {
                            $specItem = [
                                'name' => $spec['name'],
                                'rTimes' => 1,
                                'rMarks' => $spec['sign'],
                                'notRTimes' => 0,
                                'notRMarks' => 0
                            ];
                            $specArray[$spec['name']] = $specItem;
                        } else {
                            $specArray[$spec['name']]['rTimes'] +=1;
                            $specArray[$spec['name']]['rMarks'] +=$spec['sign'];
                        }

                        $userMarksActivities[$spec['sign']] += 1;
                    }

                    foreach($results['specNotRcmnd'] as $spec) {
                        if (!array_key_exists($spec['name'], $activitiesNotRecommended))
                            $activitiesNotRecommended[$spec['name']] = 1;
                        else 
                            $activitiesNotRecommended[$spec['name']] += 1;

                        if (!array_key_exists($spec['name'], $specArray)) {
                            $specItem = [
                                'name' => $spec['name'],
                                'rTimes' => 0,
                                'rMarks' => 0,
                                'notRTimes' => 1,
                                'notRMarks' => $spec['sign']
                            ];
                            $specArray[$spec['name']] = $specItem;
                        } else {
                            $specArray[$spec['name']]['notRTimes'] +=1;
                            $specArray[$spec['name']]['notRMarks'] +=$spec['sign'];
                        }

                        $userMarksNotActivities[$spec['sign']] += 1;
                    }

                    foreach($results['prof'] as $prof) {
                        if (!array_key_exists($prof['name'], $professionsRecommended))
                            $professionsRecommended[$prof['name']] = 1;
                        else 
                            $professionsRecommended[$prof['name']] += 1;

                        if (!array_key_exists($prof['name'], $profArray)) {
                            $profItem = [
                                'name' => $prof['name'],
                                'rTimes' => 1,
                                'rMarks' => $prof['sign'] 
                            ];
                            $profArray[$prof['name']] = $profItem;
                        } else {
                            $profArray[$prof['name']]['rTimes'] +=1;
                            $profArray[$prof['name']]['rMarks'] +=$prof['sign'];
                        }

                        $userMarksProfessions[$prof['sign']] += 1;
                    }
                }

                $doNotExist = $this->getNotUsedProfessions();

                $mostRelevant = $profArray;
                uasort($mostRelevant, function($a, $b) {
                    $am = $a['rMarks']/$a['rTimes'];
                    $bm = $b['rMarks']/$b['rTimes'];
                    if ($am == $bm) {
                        return 0;
                    }
                    return ($am < $bm) ? 1 : -1;
                });
                $lessRelevant = $profArray;
                usort($lessRelevant, function($a, $b) {
                    $am = $a['rMarks']/$a['rTimes'];
                    $bm = $b['rMarks']/$b['rTimes'];
                    if ($am == $bm) {
                        return 0;
                    }
                    return ($am < $bm) ? -1 : 1;
                });
                $mostRecommended = $profArray;
                uasort($mostRecommended, function($a, $b) {
                    $am = $a['rTimes'];
                    $bm = $b['rTimes'];
                    if ($am == $bm) {
                        return 0;
                    }
                    return ($am < $bm) ? 1 : -1;
                });
                
                return $this->render('statistics', [
                    'activitiesRecommended' => $activitiesRecommended,
                    'activitiesNotRecommended' => $activitiesNotRecommended,
                    'professionsRecommended' => $professionsRecommended,
                    'userMarksActivities' => $userMarksActivities,
                    'userMarksNotActivities' => $userMarksNotActivities,
                    'userMarksProfessions' => $userMarksProfessions,
                    'userMarksOverall' => $userMarksOverall,
                    'specStatistics' => $specArray,
                    'profStatistics' => $profArray,
                    'byRecomendations' => $mostRecommended,
                    'byMarksDesc' => $mostRelevant,
                    'byMarksAsc' => $lessRelevant,
                    'doNotExist' => $doNotExist
                ]);
            }
        }
        return $this->redirect(Yii::$app->homeUrl);
    }

    private function getNotUsedProfessions() {
        $arr = UserToProfessionTesting::find()->all();
        $existing = [];
        $notExisting = [];
        foreach($arr as $result) {
            $profs = json_decode($result->oldRawResults, true)['prof'];
            foreach($profs as $prof) {
                if (!in_array($prof['name'], $existing))
                    $existing []= $prof['name'];
            }
            if ($result->newRawResults != null) {
                $profs = json_decode($result->newRawResults, true)['prof'];
                foreach($profs as $prof) {
                    if (!in_array($prof['name'], $existing))
                        $existing []= $prof['name'];
                }
            }
        }
        $professions = Profession::find()->all();
        foreach($professions as $profession) {
            if (!in_array($profession->name, $existing)) {
                $notExisting []= $profession->name;
            }
        }

        return $notExisting;
    }
}

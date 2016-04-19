<?php

namespace app\controllers;

use app\models\ActivityType;
use app\models\PythagorasSquare;
use app\models\SquareForm;
use app\models\TestedPerson;
use app\models\UserRelation;
use app\models\UserToActivity;
use app\models\UserToUser;
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
                $specials = UserToActivity::getUserSpecialities($person);
                //Yii::warning('SpecialityList: '.implode('; ',$specialities));
            }

            $kv = $square->simpleMatrix;
            $kvEx = $square->extendedMatrix;
        }
        return $this->render('kvadrat', [
            'model' => $model,
            'kv' => $kv,
            'kvEx' => $kvEx,
            'kvW' => $kvW
        ]);
    }

    public function actionLogin()
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
}

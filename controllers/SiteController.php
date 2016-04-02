<?php

namespace app\controllers;

use app\models\PythagorasSquare;
use app\models\SquareForm;
use app\models\TestedPerson;
use Faker\Provider\DateTime;
use Yii;
use yii\filters\AccessControl;
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

        if ($model->load(Yii::$app->request->post())) {
            $date = \DateTime::createFromFormat('d-m-Y',$model->birth_date);

            $square = new PythagorasSquare($date);

            $person = new TestedPerson();
            $person->birth_date = $date->format('Y-m-d H:i:s');;
            Yii::warning('Before save: '.$person->birth_date);
            $person->save();
            Yii::warning('After save: '.$person->birth_date);

            $kv = $square->simpleMatrix;
            $kvEx = $square->extendedMatrix;
        }
        return $this->render('kvadrat', [
            'model' => $model,
            'kv' => $kv,
            'kvEx' => $kvEx
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

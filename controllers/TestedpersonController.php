<?php

namespace app\controllers;

use app\models\PythagorasSquare;
use Yii;
use app\models\TestedPerson;
use app\models\TestedPersonSearch;
use yii\helpers\Json;
use yii\web\Controller;
use app\models\UserToActivity;
use app\models\Profession;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestedPersonController implements the CRUD actions for TestedPerson model.
 */
class TestedpersonController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TestedPerson models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestedPersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TestedPerson model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $person = $this->findModel($id);
        $date = \DateTime::createFromFormat('Y-m-d H:i:s',$person->birth_date);
        $square = new PythagorasSquare($date);

        $kv = $square->simpleMatrix;
        $kvEx = $square->extendedMatrix;
        $kvW = PythagorasSquare::countWeightedSquare($person);
        $specials = UserToActivity::getUserSpecialities($person);
        $bundle = UserToActivity::getUserSpecialitiesExtended($person);
        $professions = Profession::getUserProfessions($person);
        $professionsNew = Profession::getUserProfessionsLite($person);

        return $this->render('view', [
            'model' => $person,
            'kv' => $kv,
            'kvEx' => $kvEx,
            'kvW' => $kvW,
            'specialities' => $specials,
            'professions'=>$professions,
            'bundle'=>$bundle,
            'professionsNew'=>$professionsNew
        ]);

        /*return $this->render('view', [
            'model' => $this->findModel($id),
        ]);*/
    }

    /**
     * Creates a new TestedPerson model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TestedPerson();

        if ($model->load(Yii::$app->request->post(), 'TestedPerson') && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TestedPerson model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post(), 'TestedPerson') && $model->save()) {
            $model->load(Yii::$app->request->post(), 'TestedPerson');
            Yii::error('Occured: '.Json::encode($model->attributes));
            Yii::error('Post: '.Json::encode(Yii::$app->request->post('TestedPerson')));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TestedPerson model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TestedPerson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TestedPerson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TestedPerson::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

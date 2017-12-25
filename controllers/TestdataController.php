<?php

namespace app\controllers;

use Yii;
use app\models\Test;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestdataController implements the CRUD actions for Test model.
 */
class TestdataController extends Controller
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
     * Lists all Test models.
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        if ($session->get('user')) {
          if ($session->get('user')->scope == "admin") {
            $dataProvider = new ActiveDataProvider([
                'query' => Test::find(),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
          }
        }
        return $this->goBack();
    }

    /**
     * Displays a single Test model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $session = Yii::$app->session;
        if ($session->get('user')) {
          if ($session->get('user')->scope == "admin") {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
          }
        }
        return $this->goBack();
    }

    /**
     * Creates a new Test model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        if ($session->get('user')) {
          if ($session->get('user')->scope == "admin") {
            $model = new Test();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
          }
        }
        return $this->redirect(Yii::$app->homeUrl);
    }

    /**
     * Updates an existing Test model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;
        if ($session->get('user')) {
          if ($session->get('user')->scope == "admin") {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
          }
        }
        return $this->goBack();
    }

    /**
     * Deletes an existing Test model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $session = Yii::$app->session;
        if ($session->get('user')) {
          if ($session->get('user')->scope == "admin") {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
          }
        }
        return $this->goBack();
    }

    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $session = Yii::$app->session;
        if ($session->get('user')) {
          if ($session->get('user')->scope == "admin") {
            if (($model = Test::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
          }
        }
        return $this->goBack();
    }
}

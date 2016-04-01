<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestedPersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tested People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tested-person-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tested Person', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'birth_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

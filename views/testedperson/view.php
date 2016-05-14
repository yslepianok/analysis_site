<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TestedPerson */

$this->title = 'Просмотр протестированного человека '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Протестированные', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tested-person-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'birth_date',
        ],
    ]) ?>

    <p>
    <?php
    echo $this->render('/partial/_testresults', [
        'model' => $model,
        'kv' => $kv,
        'kvEx' => $kvEx,
        'kvW' => $kvW,
        'specialities' => $specialities,
        'professions'=>$professions,
        'bundle'=>$bundle,
        'professionsNew'=>$professionsNew
    ]);
    ?>
    </p>
</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestedPerson */

$this->title = 'Изменить информацию о человеке: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Список всех протестированных', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="tested-person-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

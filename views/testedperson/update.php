<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestedPerson */

$this->title = 'Update Tested Person: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tested People', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tested-person-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TestedPerson */

$this->title = 'Create Tested Person';
$this->params['breadcrumbs'][] = ['label' => 'Tested People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tested-person-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

$this->title = 'Квадрат пифагора';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, заполните вашу дату рождения в следующем формате: день-месяц-год</p>

    <?php $form = ActiveForm::begin([
        'id' => 'square-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'birth_date')->textInput(['autofocus' => true]); ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Посчитать квадрат', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<? if ($kv!=null && !empty($kv)) {?>
<div class="panel square-simple">
    <h1>Ваш квадрат пифагора:</h1>
    <p>
        <?php
        $str = '';
        foreach ($kv as $element)
            $str .= $element.' ';
        echo $str;
        ?>
    </p>
</div>
<? } ?>

<? if ($kvEx!=null && !empty($kvEx)) {?>
    <div class="panel square-simple">
        <h1>Ваш расширенный квадрат пифагора:</h1>
        <p>
            <?php
            $str = '';
            foreach ($kvEx as $key=>$element)
                $str .= 'KP'.($key+1).' '.$element.' ';
            echo $str;
            ?>
        </p>
    </div>
<? } ?>

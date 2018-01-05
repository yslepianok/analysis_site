<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php $this->title = 'Рекомендуемые профессии';?>

<h1>Рекомендуемые профессии и сферы деятельности</h1>
<p>Прохождение психологического тестирования значительно улучшает результаты рекомендаций!</p>
<br>
<p>Результаты автоматически перерассчитываются раз в 5 минут</p>
<br>

<?php $form = ActiveForm::begin([
        'id' => 'results-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
]); ?>
<input type="hidden" name="testResults[id]" value="<?php echo $resultsId?>">

<div class="panel">
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#oldData" aria-controls="oldData" role="tab" data-toggle="tab">Результат по дате рождения</a></li>
    <?php if ($wasTested) { ?>
        <li role="presentation"><a href="#newData" aria-controls="newData" role="tab" data-toggle="tab">Результат по дате рождения и тестам</a></li>
    <?php } ?>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="oldData">
        <div class="panel weights-table">
            <p>
                <?php
                echo $this->render('/partial/_newTestResults', [
                    'bundle' => $oldBundle,
                    'type'=> 'old'
                ])
                ?>
            </p>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="newData">
        <div class="panel weights-table">
            <p>
                <?php
                echo $this->render('/partial/_newTestResults', [
                    'bundle' => $newBundle,
                    'type' => 'new'
                ])
                ?>
            </p>
        </div>
    </div>
</div>

<br>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <label for="imb">В результатах меня удивило то что:</label>
        <input type="text" id="imb" class="form-control" name="testResults[impressedBy]" value="<?php echo $impressedBy?>">
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <label for="nkn">В результатах для меня было новым то что:</label>
        <input type="text" id="nkn" class="form-control" name="testResults[newKnown]" value="<?php echo $newKnown?>">
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <?= Html::submitButton('Сохранить мою оценку результатов', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
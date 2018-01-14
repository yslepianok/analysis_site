<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php $this->title = 'Рекомендуемые профессии';?>

<h1>Рекомендуемые профессии и сферы деятельности</h1>
<p>Прохождение психологического тестирования значительно улучшает результаты рекомендаций!</p>
<p>Так же стоит обратить внимание на то, что результаты в процентах относительны самого большого.</p>
<br>
<p>Результаты автоматически перерассчитываются после каждого нового пройденного теста</p>
<br>
<p> В данный момент Вы прошли <?php echo $passedTestsCount.' из '.$overallTestsCount?> тестов, что является 
<?php 
    $val = $passedTestsCount / $overallTestsCount * 100;
    if ($val < 30) echo ' довольно слабым результатом. Прохождение тестов увеличит точность ваших прогнозов!';
    else if ($val < 70) echo ' средним результатом. Прогнозы будут довольно точными, но вы все еще можете это изменить!';
    else if ($val < 90) echo ' хорошим результатом, спасибо!';
    else echo ' потрясающим результатом!';
?>
</p>

<?php $form = ActiveForm::begin([
        'id' => 'results-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
]); ?>
<input type="hidden" name="basicData[id]" value="<?php echo $resultsId?>">

<div class="panel weights-table">
    <p>
        <?php
        echo $this->render('/partial/_newTestResults', [
            'bundle' => $bundle,
            'activitiesShortNames' => $activitiesShortNames,
            'scoreSaved' => $scoreSaved
        ]);
        ?>
    </p>
</div>

<br>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <label for="imb">В результатах меня удивило то что:</label>
        <input type="text" <?php if ($scoreSaved) echo "disabled"?> id="imb" class="form-control" name="basicData[impressedBy]" value="<?php echo $impressedBy?>">
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <label for="nkn">В результатах для меня было новым то что:</label>
        <input type="text" <?php if ($scoreSaved) echo "disabled"?> id="nkn" class="form-control" name="basicData[newKnown]" value="<?php echo $newKnown?>">
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <label for="oscore">Я оцениваю результаты тестирования на:</label>
        <select id="oscore" <?php if ($scoreSaved) echo "disabled"?> form="results-form" name="basicData[overallScore]">
            <?php for ($i=1;$i<11;$i++) {
                if ($i == $overallScore)
                    echo '<option value="'.$i.'" selected>'.$i.'</option>';
                else 
                    echo '<option value="'.$i.'">'.$i.'</option>';
            }?>
        </select>
    </div>
</div>
<?php if (!$scoreSaved) {?>
    <div class="form-group">
        <div class="col-md-offset-4 col-md-4">
            <?= Html::submitButton('Сохранить мою оценку результатов', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>
<?php } ?>

<?php if ($scoreSaved) {?>
    <p class="text-center">
        Ваша оценка результатов сохранена. Спасибо за обратную связь!
    </p>
<?php } ?>

<?php ActiveForm::end(); ?>
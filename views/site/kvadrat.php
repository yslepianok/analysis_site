<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\UserRelation;

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

    <p>Информация о родственниках (увеличивает точность)</p>

    <div class="form-group">
        <div class="row">
            <div class="data-container" id="itemContainer">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Посчитать квадрат', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <?php echo Html::dropDownList('RelativeTypeDropdown',null,UserRelation::getRelationoptions())?>
    <input type="text" id="itemCount">
    <button type="button" name="itemAdd" id="itemAdd">Добавить родственника </button>
</div>

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
        'professionsNew'=>$professionsNew,
    ])
    ?>
</p>

<!--Script for adding persons-->
<script>
    (function initCarouselCfg(){
        console.log('init additionalPersons');
        window.additionalPersons = {
            itemCount:0,
            itemContDefinition:'<div class="row" id="addedCont">',
            itemRelTypeDefinition:'<input type="text" name="name" id="addedRelativeType" value="">',
            itemDefinition:'<input placeholder="Дата рождения родственника" name="name" id="addedItem" type="text" value="">',
            addItem : function(){
                console.log('from add item');
                var index = window.additionalPersons.itemCount+1;
                var itemCont = $("#itemContainer");
                var relativeType = $( "select option:selected" ).text();

                // @TODO Add relative type choosing
                itemCont.append(window.additionalPersons.itemContDefinition);
                var addedCont = $("#addedCont");
                addedCont.append(window.additionalPersons.itemRelTypeDefinition);
                addedCont.append(window.additionalPersons.itemDefinition);
                var type = $("#addedRelativeType");
                var item = $("#addedItem");
                addedCont.attr("id", "Relatives_cont_"+index);
                item.attr("id", "Relatives_"+index+"_BDate");
                item.attr("name", "Relatives["+index+"][BDate]");
                type.attr("id", "Relatives_"+index+"_Type");
                type.attr("name", "Relatives["+index+"][Type]");
                type.val(relativeType);
                window.additionalPersons.countItems();
            },
            countItems :function(){
                console.log('from count items');
                var itemCont = $("#itemContainer");
                var countInput = $("#itemCount");

                window.additionalPersons.itemCount = itemCont.children().length;
                countInput.val(window.additionalPersons.itemCount);
                countInput.prop('disabled', true);
            }
        };
    })();

    $(document).ready(function(){
        window.additionalPersons.countItems();
        var itemAdd = $("#itemAdd");
        itemAdd.click(function() {
            window.additionalPersons.addItem();
        });
    });
</script>
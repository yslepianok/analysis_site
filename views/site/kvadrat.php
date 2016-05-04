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

<? if ($kvW!=null && !empty($kvW)) {?>
    <div class="panel square-simple">
        <h1>Ваш средневзвешенный квадрат пифагора:</h1>
        <p>
            <?php
            $str = '';
            foreach ($kvW as $key=>$element)
                $str .= 'KP'.($key).' '.$element.' ';
            echo $str;
            ?>
        </p>
    </div>
<? } ?>

<div class="panel square-simple">
    <h1>Ваши сферы деятельности:</h1>
    <p>
        <?php
        if ($specialities != null && !empty($specialities))
        {
            foreach ($specialities[0] as $key=>$spc) {
                echo '<div class="row">';
                echo '<h2>' . $spc->name . ' Вес:' . $specialities[1][$key] . '</h2>';
                echo '</div>';
            }
        }
        ?>
    </p>
</div>

<div class="panel square-simple">
    <h1>Ваши профессии:</h1>
    <p>
    <?php
    if ($professions != null && !empty($professions))
    {
        foreach ($professions as $element) {
            echo '<div class="row">';
            echo '<h2>' . $element[0]->name . ' Вес:' . $element[1] . '</h2>';
            echo '</div>';
        }
    }
            ?>
        </p>
</div>




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
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
                $str .= 'KP'.($key+1).' <strong>'.$element.'</strong> ';
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
                $str .= 'KP'.($key+1).' <strong>'.$element.'</strong> ';
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
                echo '<h3>' . $spc->name . ' Вес:' . $specialities[1][$key] . '</h3>';
                echo '</div>';
            }
        }
        ?>
    </p>
</div>

<style>
    table {
/*
        width: 100%; !* Ширина таблицы *!
*/
        border: 1px solid #399; /* Граница вокруг таблицы */
        border-spacing: 7px 5px; /* Расстояние между границ */
    }
    TD, TH {
        padding: 3px; /* Поля вокруг содержимого таблицы */
        border: 1px solid black; /* Параметры рамки */
    }
</style>

<div class="panel square-simple">
    <h1>Ваши cферы деятельности (Другой алгоритм):</h1>
    <p>
        <h2>Ваши ячейки cфер деятельности:</h2>
    <?php
        if ($bundle != null && !empty($bundle))
        {
            echo '<table cellspacing="5" width="20%">';
            echo '<thead>';
            echo '<td>Ключ</td>';
            echo '<td>Содержимое</td>';
            echo '<td>Вес</td>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($bundle[0] as $key=>$element) {
                if (in_array($key, $bundle[1]))
                    echo '<tr bgcolor="#90ee90">';
                elseif (in_array($key,$bundle[2]))
                    echo '<tr bgcolor="#f08080">';
                else
                    echo '<tr>';
                echo '<td>'.$key.'</td>';
                echo '<td>'.\app\models\PythagorasSquare::$specialityFunction[$key].'</td>';
                echo '<td>'.round($element,2).'</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }
        ?>
    </p>
    <p>
    <h2>Ваши cферы деятельности:</h2>
    <?php
    if ($bundle != null && !empty($bundle))
    {
        echo '<table cellspacing="5" width="100%">';
        echo '<thead>';
        echo '<td width="5%">Ключ</td>';
        echo '<td width="45%">Название</td>';
        echo '<td width="20%">Вес сферы деятельности:</td>';
        echo '<td width="10%">Ячейка сферы деятельности 1</td>';
        echo '<td width="5%">Вес:</td>';
        echo '<td width="10%">Ячейка сферы деятельности 2</td>';
        echo '<td width="5%">Вес:</td>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($bundle[4] as $key=>$element) {
            $item = $bundle[3][$key];
            if (in_array($key, $bundle[5]))
                echo '<tr bgcolor="#90ee90">';
            elseif (in_array($key,$bundle[6]))
                echo '<tr bgcolor="#f08080">';
            else
                echo '<tr>';
            echo '<td>'.$key.'</td>';
            echo '<td>'.$item->name.'</td>';
            echo '<td>'.round($element,2).'</td>';
            echo '<td>'.$item->pair_one.'</td>';
            echo '<td>'.round($bundle[0][$item->pair_one],2).'</td>';
            echo '<td>'.$item->pair_two.'</td>';
            echo '<td>'.round($bundle[0][$item->pair_two],2).'</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
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
                echo '<h3>' . $element[0]->name . ' Вес:' . $element[1] . '</h3>';
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
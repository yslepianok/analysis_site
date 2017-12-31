<?php $this->title = 'Рекомендуемые профессии';?>

<h1>Рекомендуемые профессии и сферы деятельности</h1>
<p>Прохождение психологического тестирования значительно улучшает результаты рекомендаций!</p>

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
                    'bundle' => $oldBundle
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
                    'bundle' => $newBundle
                ])
                ?>
            </p>
        </div>
    </div>
</div>
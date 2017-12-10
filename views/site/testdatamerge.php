<?php $this->title = 'Рекомендуемые профессии';?>
<h1>Страница со смещенными результатами</h1>
<h2>Ячейки матрицы</h2>
<div class="panel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="#initial" aria-controls="initial" role="tab" data-toggle="tab">Взвешенные результаты</a></li>
    <li role="presentation"><a href="#test" aria-controls="test" role="tab" data-toggle="tab">Взвешенные результаты с тестами</a></li>
    <li role="presentation"><a href="#merged" aria-controls="merged" role="tab" data-toggle="tab">Совмещенные результаты</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="initial">
        <div class="weights-table">
            <?php if($oldWeightedCells) { ?>
                <div class="row">
                    <div class="col-md-4"><h5>Cell</h5></div>
                    <div class="col-md-4"><h5>Weight</h5></div>
                </div>
                <?php 
                    foreach ($oldWeightedCells as $key=>$val) { ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $key ?></div>
                            <div class="col-md-4"><?php echo $val ?></div>
                        </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="test">
        <div class="weights-table">
            <?php if($testWeightedCells) { ?>
                <div class="row">
                    <div class="col-md-4"><h5>Cell</h5></div>
                    <div class="col-md-4"><h5>Weight</h5></div>
                </div>
                <?php 
                    foreach ($testWeightedCells as $key=>$val) { ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $key ?></div>
                            <div class="col-md-4"><?php echo $val ?></div>
                        </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="merged">
        <div class="weights-table">
            <?php if($mergedWeightedCells) { ?>
                <div class="row">
                    <div class="col-md-4"><h5>Cell</h5></div>
                    <div class="col-md-4"><h5>Weight</h5></div>
                </div>
                <?php 
                    foreach ($mergedWeightedCells as $key=>$val) { ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $key ?></div>
                            <div class="col-md-4"><?php echo $val ?></div>
                        </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
  </div>
</div>

<h2>Рекомендуемые сферы деятельности</h2>

<div class="panel">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#oldSpecs" aria-controls="oldSpecs" role="tab" data-toggle="tab">Взвешенные результаты</a></li>
        <li role="presentation"><a href="#newSpecs" aria-controls="newSpecs" role="tab" data-toggle="tab">Взвешенные результаты с тестами</a></li>
    </ul>

    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="oldSpecs">
        <div class="weights-table">
            <?php if($oldSpecsRcmnd) { ?>
                <h3>Наиболее рекомендуемые сферы деятельности:</h3>
                <div class="row">
                    <div class="col-md-4"><h5>Сфера</h5></div>
                    <div class="col-md-4"><h5>Вес</h5></div>
                </div>
                <?php 
                    foreach($oldSpecsRcmnd as $key=>$val) {
                ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $key ?></div>
                            <div class="col-md-4"><?php echo $val ?></div>
                        </div>
                <?php } ?>
            <?php } ?>
            <?php if($oldSpecsNotRcmnd) { ?>
                <h3>Наименее рекомендуемые сферы деятельности:</h3>
                <div class="row">
                    <div class="col-md-4"><h5>Сфера</h5></div>
                    <div class="col-md-4"><h5>Вес</h5></div>
                </div>
                <?php 
                    foreach($oldSpecsNotRcmnd as $key=>$val) {
                ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $key ?></div>
                            <div class="col-md-4"><?php echo $val ?></div>
                        </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="newSpecs">
    <div class="weights-table">
            <?php if($newSpecsRcmnd) { ?>
                <h3>Наиболее рекомендуемые сферы деятельности:</h3>
                <div class="row">
                    <div class="col-md-4"><h5>Сфера</h5></div>
                    <div class="col-md-4"><h5>Вес</h5></div>
                </div>
                <?php 
                    foreach($newSpecsRcmnd as $key=>$val) {
                ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $key ?></div>
                            <div class="col-md-4"><?php echo $val ?></div>
                        </div>
                <?php } ?>
            <?php } ?>
            <?php if($newSpecsNotRcmnd) { ?>
                <h3>Наименее рекомендуемые сферы деятельности:</h3>
                <div class="row">
                    <div class="col-md-4"><h5>Сфера</h5></div>
                    <div class="col-md-4"><h5>Вес</h5></div>
                </div>
                <?php 
                    foreach($newSpecsNotRcmnd as $key=>$val) {
                ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $key ?></div>
                            <div class="col-md-4"><?php echo $val ?></div>
                        </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
  </div>
</div>

<h2>Рекомендуемые профессии</h2>

<div class="panel">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#oldProfs" aria-controls="oldProfs" role="tab" data-toggle="tab">Взвешенные результаты</a></li>
        <li role="presentation"><a href="#newProfs" aria-controls="newProfs" role="tab" data-toggle="tab">Взвешенные результаты с тестами</a></li>
    </ul>

    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="oldProfs">
        <div class="weights-table">
            <?php if($oldSpecsRcmnd) { ?>
                <h3>Наиболее рекомендуемые сферы деятельности:</h3>
                <div class="row">
                    <div class="col-md-4"><h5>Сфера</h5></div>
                    <div class="col-md-4"><h5>Вес</h5></div>
                </div>
                <?php 
                    foreach($oldSpecsRcmnd as $key=>$val) {
                ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $key ?></div>
                            <div class="col-md-4"><?php echo $val ?></div>
                        </div>
                <?php } ?>
            <?php } ?>
            <?php if($oldSpecsNotRcmnd) { ?>
                <h3>Наименее рекомендуемые сферы деятельности:</h3>
                <div class="row">
                    <div class="col-md-4"><h5>Сфера</h5></div>
                    <div class="col-md-4"><h5>Вес</h5></div>
                </div>
                <?php 
                    foreach($oldSpecsNotRcmnd as $key=>$val) {
                ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $key ?></div>
                            <div class="col-md-4"><?php echo $val ?></div>
                        </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="newProfs">
    <div class="weights-table">
            <?php if($newSpecsRcmnd) { ?>
                <h3>Наиболее рекомендуемые сферы деятельности:</h3>
                <div class="row">
                    <div class="col-md-4"><h5>Сфера</h5></div>
                    <div class="col-md-4"><h5>Вес</h5></div>
                </div>
                <?php 
                    foreach($newSpecsRcmnd as $key=>$val) {
                ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $key ?></div>
                            <div class="col-md-4"><?php echo $val ?></div>
                        </div>
                <?php } ?>
            <?php } ?>
            <?php if($newSpecsNotRcmnd) { ?>
                <h3>Наименее рекомендуемые сферы деятельности:</h3>
                <div class="row">
                    <div class="col-md-4"><h5>Сфера</h5></div>
                    <div class="col-md-4"><h5>Вес</h5></div>
                </div>
                <?php 
                    foreach($newSpecsNotRcmnd as $key=>$val) {
                ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $key ?></div>
                            <div class="col-md-4"><?php echo $val ?></div>
                        </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
  </div>
</div>
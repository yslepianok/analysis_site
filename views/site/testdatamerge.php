<h1>Страница со смещенными результатами</h1>
<h2>Ячейки матрицы</h2>
<div class="panel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#initial" aria-controls="initial" role="tab" data-toggle="tab">Взвешенные результаты</a></li>
    <li role="presentation"><a href="#test" aria-controls="test" role="tab" data-toggle="tab">Взвешенные результаты с тестами</a></li>
    <li role="presentation"><a href="#merged" aria-controls="merged" role="tab" data-toggle="tab">Совмещенные результаты</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="initial">
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
            <?php if($oldWeightedCells[5]) { ?>
                <div class="row">
                    <div class="col-md-4"><h5>Cell</h5></div>
                    <div class="col-md-4"><h5>Weight</h5></div>
                </div>
                <?php 
                    for($i=0;$i<4;$i++)
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
        
    </div>
  </div>
</div>
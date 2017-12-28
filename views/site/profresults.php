<?php $this->title = 'Рекомендуемые профессии';?>
<?php use dosamigos\chartjs\ChartJs; ?>

<h1>Рекомендуемые профессии и сферы деятельности</h1>
<p>Прохождение психологического тестирования значительно улучшает результаты рекомендаций!</p>

<h2>Рекомендуемые сферы деятельности</h2>

<div class="panel">
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#oldSpecs" aria-controls="oldSpecs" role="tab" data-toggle="tab">Результат по дате рождения</a></li>
    <?php if ($wasTested) { ?>
        <li role="presentation"><a href="#newSpecs" aria-controls="newSpecs" role="tab" data-toggle="tab">Результат по дате рождения и тестам</a></li>
    <?php } ?>
</ul>

<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="oldSpecs">
    <div class="weights-table">
        <?php if($oldSpecsRcmnd) { ?>
            <h3>Наиболее рекомендуемые сферы деятельности:</h3>
            
                <br>

                <?php
                    $specnames = array_keys($oldSpecsRcmnd);
                    $specvalues = [];
                    $values = array_values($oldSpecsRcmnd);
                    $multipler = 100 / $values[0];
                    foreach ($oldSpecsRcmnd as $key=>$val) {
                        $specvalues []= round($val * $multipler, 1);
                    };

                    ?>

                    <?= ChartJs::widget([
                        'type' => 'bar',
                        'options' => [
                            'height' => 125,
                            'width' => 600,
                            'scales' => [
                                'yAxes' => [
                                    'ticks' => [
                                        'beginAtZero' => true
                                    ]
                                ]
                            ]
                        ],
                        'data' => [
                            'labels' => $specnames,
                            'datasets' => [
                                [
                                    'label' => "Результаты с учетами психологического тестирования",
                                    'backgroundColor' => "rgba(179,181,198,0.5)",
                                    'borderColor' => "rgba(179,181,198,1)",
                                    'pointBackgroundColor' => "rgba(179,181,198,1)",
                                    'pointBorderColor' => "#fff",
                                    'pointHoverBackgroundColor' => "#fff",
                                    'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                    'data' => $specvalues
                                ]
                            ]
                        ]
                    ]);
                    ?>

                    <div class="row">
                        <div class="col-md-4"><h5>Сфера</h5></div>
                        <div class="col-md-4"><h5>Рекомендовано на</h5></div>
                    </div>
                    <?php 
                        foreach($specnames as $key=>$val) {
                    ?>
                            <div class="row">
                                <div class="col-md-4"><?php echo $specnames[$key] ?></div>
                                <div class="col-md-4"><?php echo $specvalues[$key] ?>%</div>
                            </div>
                    <?php } ?>
            <?php } ?>
            <?php if($oldSpecsNotRcmnd) { ?>
                <h3>Наименее рекомендуемые сферы деятельности:</h3>

                <br>

                <?php
                    $specnames = array_keys($oldSpecsNotRcmnd);
                    $specvalues = [];
                    $values = array_values($oldSpecsNotRcmnd);
                    $multipler = 100 / $values[0];
                    foreach ($oldSpecsNotRcmnd as $key=>$val) {
                        $specvalues []= round($val * $multipler, 1);
                    };

                    ?>

                    <?= ChartJs::widget([
                        'type' => 'bar',
                        'options' => [
                            'height' => 125,
                            'width' => 600,
                            'scales' => [
                                'yAxes' => [
                                    'ticks' => [
                                        'beginAtZero' => true
                                    ]
                                ]
                            ]
                        ],
                        'data' => [
                            'labels' => $specnames,
                            'datasets' => [
                                [
                                    'label' => "Результаты с учетами психологического тестирования",
                                    'backgroundColor' => "rgba(179,181,198,0.8)",
                                    'borderColor' => "rgba(179,181,198,1)",
                                    'pointBackgroundColor' => "rgba(179,181,198,1)",
                                    'pointBorderColor' => "#fff",
                                    'pointHoverBackgroundColor' => "#fff",
                                    'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                    'data' => $specvalues
                                ]
                            ]
                        ]
                    ]);
                    ?>

                    <div class="row">
                        <div class="col-md-4"><h5>Сфера</h5></div>
                        <div class="col-md-4"><h5>Нерекомендовано на</h5></div>
                    </div>
                    <?php 
                        foreach($specnames as $key=>$val) {
                    ?>
                            <div class="row">
                                <div class="col-md-4"><?php echo $specnames[$key] ?></div>
                                <div class="col-md-4"><?php echo $specvalues[$key] ?>%</div>
                            </div>
                    <?php } ?>
            <?php } ?>
    </div>
</div>
<div role="tabpanel" class="tab-pane" id="newSpecs">
<div class="weights-table">
        <?php if($newSpecsRcmnd) { ?>
            <h3>Наиболее рекомендуемые сферы деятельности:</h3>
        
            <br>

            <?php
                $specnames = array_keys($newSpecsRcmnd);
                $specvalues = [];
                $values = array_values($newSpecsRcmnd);
                $multipler = 100 / $values[0];
                foreach ($newSpecsRcmnd as $key=>$val) {
                    $specvalues []= round($val * $multipler, 1);
                };

                ?>

                <?= ChartJs::widget([
                    'type' => 'bar',
                    'options' => [
                        'height' => 125,
                        'width' => 600,
                        'scales' => [
                            'yAxes' => [
                                'ticks' => [
                                    'beginAtZero' => true
                                ]
                            ]
                        ]
                    ],
                    'data' => [
                        'labels' => $specnames,
                        'datasets' => [
                            [
                                'label' => "Результаты с учетами психологического тестирования",
                                'backgroundColor' => "rgba(179,181,198,0.5)",
                                'borderColor' => "rgba(179,181,198,1)",
                                'pointBackgroundColor' => "rgba(179,181,198,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                'data' => $specvalues
                            ]
                        ]
                    ]
                ]);
                ?>

                <div class="row">
                    <div class="col-md-4"><h5>Сфера</h5></div>
                    <div class="col-md-4"><h5>Рекомендовано на</h5></div>
                </div>
                <?php 
                    foreach($specnames as $key=>$val) {
                ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $specnames[$key] ?></div>
                            <div class="col-md-4"><?php echo $specvalues[$key] ?>%</div>
                        </div>
                <?php } ?>
        <?php } ?>
        <?php if($newSpecsNotRcmnd) { ?>
            <h3>Наименее рекомендуемые сферы деятельности:</h3>

            <br>

            <?php
                $specnames = array_keys($newSpecsNotRcmnd);
                $specvalues = [];
                $values = array_values($newSpecsNotRcmnd);
                $multipler = 100 / $values[0];
                foreach ($newSpecsNotRcmnd as $key=>$val) {
                    $specvalues []= round($val * $multipler, 1);
                };

                ?>

                <?= ChartJs::widget([
                    'type' => 'bar',
                    'options' => [
                        'height' => 125,
                        'width' => 600,
                        'scales' => [
                            'yAxes' => [
                                'ticks' => [
                                    'beginAtZero' => true
                                ]
                            ]
                        ]
                    ],
                    'data' => [
                        'labels' => $specnames,
                        'datasets' => [
                            [
                                'label' => "Результаты с учетами психологического тестирования",
                                'backgroundColor' => "rgba(179,181,198,0.8)",
                                'borderColor' => "rgba(179,181,198,1)",
                                'pointBackgroundColor' => "rgba(179,181,198,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                'data' => $specvalues
                            ]
                        ]
                    ]
                ]);
                ?>

                <div class="row">
                    <div class="col-md-4"><h5>Сфера</h5></div>
                    <div class="col-md-4"><h5>Нерекомендовано на</h5></div>
                </div>
                <?php 
                    foreach($specnames as $key=>$val) {
                ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $specnames[$key] ?></div>
                            <div class="col-md-4"><?php echo $specvalues[$key] ?>%</div>
                        </div>
                <?php } ?>
        <?php } ?>
    </div>
</div>
</div>
</div>

<br>
<br>

<h2>Рекомендуемые профессии</h2>

<div class="panel">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#oldProfs" aria-controls="oldProfs" role="tab" data-toggle="tab">Результаты по дате рождения</a></li>
        <?php if ($wasTested) { ?>
            <li role="presentation"><a href="#newProfs" aria-controls="newProfs" role="tab" data-toggle="tab">Результаты по дате рождения с психологическими тестами</a></li>
        <?php } ?>
    </ul>

    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="oldProfs">
        <div class="weights-table">
            <?php if($oldProf) { ?>                
                <br>

                <?php
                    $profnames = [];
                    $profvalues = [];
                    $values = array_values($oldProf[1]);                    
                    $multipler = 100 / $values[0];
                    foreach ($oldProf[1] as $key=>$val) {
                        $profnames []= $oldProf[0][$key];
                        $profvalues []= round($val * $multipler, 1);
                    };

                    ?>

                    <?= ChartJs::widget([
                        'type' => 'bar',
                        'options' => [
                            'height' => 300,
                            'width' => 900,
                            'scales' => [
                                'yAxes' => [
                                    'ticks' => [
                                        'beginAtZero' => true
                                    ]
                                ]
                            ]
                        ],
                        'data' => [
                            'labels' => $profnames,
                            'datasets' => [
                                [
                                    'label' => "Результаты с учетами психологического тестирования",
                                    'backgroundColor' => "rgba(179,181,198,0.5)",
                                    'borderColor' => "rgba(179,181,198,1)",
                                    'pointBackgroundColor' => "rgba(179,181,198,1)",
                                    'pointBorderColor' => "#fff",
                                    'pointHoverBackgroundColor' => "#fff",
                                    'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                    'data' => $profvalues
                                ]
                            ]
                        ]
                    ]);
                    ?>

                    <div class="row">
                        <div class="col-md-4"><h5>Сфера</h5></div>
                        <div class="col-md-4"><h5>Рекомендовано на</h5></div>
                    </div>
                    <?php 
                        foreach($profnames as $key=>$val) {
                    ?>
                            <div class="row">
                                <div class="col-md-4"><?php echo $profnames[$key] ?></div>
                                <div class="col-md-4"><?php echo $profvalues[$key] ?>%</div>
                            </div>
                    <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="newProfs">
    <div class="weights-table">
            <?php if($newProf) { ?>            
                <br>
                
                <?php
                    $profnames = [];
                    $profvalues = [];
                    $values = array_values($newProf[1]);                    
                    $multipler = 100 / $values[0];
                    foreach ($newProf[1] as $key=>$val) {
                        $profnames []= $newProf[0][$key];
                        $profvalues []= round($val * $multipler, 1);
                    };

                    ?>

                    <?= ChartJs::widget([
                        'type' => 'bar',
                        'options' => [
                            'height' => 300,
                            'width' => 900,
                            'scales' => [
                                'yAxes' => [
                                    'ticks' => [
                                        'beginAtZero' => true
                                    ]
                                ]
                            ]
                        ],
                        'data' => [
                            'labels' => $profnames,
                            'datasets' => [
                                [
                                    'label' => "Результаты с учетами психологического тестирования",
                                    'backgroundColor' => "rgba(179,181,198,0.5)",
                                    'borderColor' => "rgba(179,181,198,1)",
                                    'pointBackgroundColor' => "rgba(179,181,198,1)",
                                    'pointBorderColor' => "#fff",
                                    'pointHoverBackgroundColor' => "#fff",
                                    'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                    'data' => $profvalues
                                ]
                            ]
                        ]
                    ]);
                    ?>

                    <div class="row">
                        <div class="col-md-4"><h5>Сфера</h5></div>
                        <div class="col-md-4"><h5>Рекомендовано на</h5></div>
                    </div>
                    <?php 
                        foreach($profnames as $key=>$val) {
                    ?>
                            <div class="row">
                                <div class="col-md-4"><?php echo $profnames[$key] ?></div>
                                <div class="col-md-4"><?php echo $profvalues[$key] ?>%</div>
                            </div>
                    <?php } ?>
            <?php } ?>
        </div>
    </div>
  </div>
</div>
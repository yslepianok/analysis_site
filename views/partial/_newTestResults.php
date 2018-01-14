<?php 
use dosamigos\chartjs\ChartJs; 
?>

<?php if ($bundle) { ?>
    <?php if ($bundle['specRcmnd']) { ?>
        <h3>Наиболее рекомендуемые сферы деятельности:</h3>

        <?php 
            $specnames = [];
            $specvalues = [];
            foreach($bundle['specRcmnd'] as $item) {
                $specnames []= $activitiesShortNames[$item['name']];
                $specvalues []= $item['value'];
            }
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
                        'label' => "Рекомендуемые сферы деятельности",
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
            <div class="col-md-7"><h5>Сфера</h5></div>
            <div class="col-md-3"><h5>Рекомендовано на</h5></div>
            <div class="col-md-2"><h5>Ваша оценка результата</h5></div>
        </div>
        <?php 
            foreach($bundle['specRcmnd'] as $key=>$item) {
        ?>
                <div class="row">
                    <div class="col-md-7">
                        <?php echo $item['name'] ?>
                        <input type="hidden" name="testResults[specRcmnd][<?php echo $key?>][name]" value="<?php echo $item['name']?>">
                    </div>
                    <div class="col-md-3">
                        <?php echo $item['value'] ?>%
                        <input type="hidden" name="testResults[specRcmnd][<?php echo $key?>][value]" value="<?php echo $item['value']?>">
                    </div>
                    <div class="col-md-2">
                        <select form="results-form" <?php if ($scoreSaved) echo "disabled"?> name="testResults[specRcmnd][<?php echo $key?>][sign]">
                            <?php for ($i=1;$i<11;$i++) {
                                if ($i == $item['sign'])
                                    echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                else 
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                            }?>
                        </select>
                    </div>
                </div>
        <?php } ?>
    <?php } ?>

    <br>

    <?php if ($bundle['specNotRcmnd']) { ?>
        <h3>Наименее рекомендуемые сферы деятельности:</h3>

        <?php 
            $specnames = [];
            $specvalues = [];
            foreach($bundle['specNotRcmnd'] as $item) {
                $specnames []= $activitiesShortNames[$item['name']];
                $specvalues []= $item['value'];
            }
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
                        'label' => "Рекомендуемые сферы деятельности",
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
            <div class="col-md-7"><h5>Сфера</h5></div>
            <div class="col-md-3"><h5>Нерекомендовано на</h5></div>
            <div class="col-md-2"><h5>Ваша оценка результата</h5></div>
        </div>
        <?php 
            foreach($bundle['specNotRcmnd'] as $key=>$item) {
        ?>
            <div class="row">
                <div class="col-md-7">
                    <?php echo $item['name'] ?>
                    <input type="hidden" name="testResults[specNotRcmnd][<?php echo $key?>][name]" value="<?php echo $item['name']?>">
                </div>
                <div class="col-md-3">
                    <?php echo $item['value'] ?>%
                    <input type="hidden" name="testResults[specNotRcmnd][<?php echo $key?>][value]" value="<?php echo $item['value']?>">
                </div>
                <div class="col-md-2">
                    <select form="results-form" <?php if ($scoreSaved) echo "disabled"?> name="testResults[specNotRcmnd][<?php echo $key?>][sign]">
                        <?php for ($i=1;$i<11;$i++) {
                            if ($i == $item['sign'])
                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            else 
                                echo '<option value="'.$i.'">'.$i.'</option>';
                        }?>
                    </select>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    
    <br>

    <?php if($bundle['prof']) { ?>
        <h3>Наиболее рекомендуемые профессии:</h3>

        <?php
            $profnames = [];
            $profvalues = [];
            foreach($bundle['prof'] as $item) {
                $profnames []= $item['name'];
                $profvalues []= $item['value'];
            }

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
                <div class="col-md-7"><h5>Профессия</h5></div>
                <div class="col-md-3"><h5>Рекомендовано на</h5></div>
                <div class="col-md-2"><h5>Ваша оценка результата</h5></div>
            </div>
            <?php 
                foreach($bundle['prof'] as $key=>$item) {
            ?>
                <div class="row">
                    <div class="col-md-7">
                        <?php echo $item['name'] ?>
                        <input type="hidden" name="testResults[prof][<?php echo $key?>][name]" value="<?php echo $item['name']?>">
                    </div>
                    <div class="col-md-3">
                        <?php echo $item['value'] ?>%
                        <input type="hidden" name="testResults[prof][<?php echo $key?>][value]" value="<?php echo $item['value']?>">
                    </div>
                    <div class="col-md-2">
                        <select form="results-form" <?php if ($scoreSaved) echo "disabled"?> name="testResults[prof][<?php echo $key?>][sign]">
                            <?php for ($i=1;$i<11;$i++) {
                                if ($i == $item['sign'])
                                    echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                else 
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                            }?>
                        </select>
                    </div>
                </div>
            <?php } ?>
    <?php } ?>

    
<?php } ?>
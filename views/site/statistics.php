<?php 
use dosamigos\chartjs\ChartJs; 
?>

<h2>Статистика по протестированным людям</h2>
<br>
<h3>Общая статистика удовлетворенности результатами</h3>
<div class="row">
    <div class="col-md-12">
        <h4>Оценки на рекомендуемые профессии:</h4>
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
                'labels' => array_keys($userMarksOverall),
                'datasets' => [
                    [
                        'label' => "Профессии",
                        'backgroundColor' => "rgba(179,181,198,0.5)",
                        'borderColor' => "rgba(179,181,198,1)",
                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                        'data' => array_values($userMarksOverall)
                    ]
                ]
            ]
        ]);
        ?>
    </div>
</div>

<h3>Статистика по выдаваемым результатам</h3>
<div class="row">
    <div class="col-md-6 col-lg-6 col-xs-12">
        <h4>Наиболее часто рекомендуемые сферы деятельности:</h4>
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
                'labels' => array_keys($activitiesRecommended),
                'datasets' => [
                    [
                        'label' => "Профессии",
                        'backgroundColor' => "rgba(179,181,198,0.5)",
                        'borderColor' => "rgba(179,181,198,1)",
                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                        'data' => array_values($activitiesRecommended)
                    ]
                ]
            ]
        ]);
        ?>
    </div>
    <div class="col-md-6 col-lg-6 col-xs-12">
        <h4>Наиболее часто нерекомендуемые сферы деятельности:</h4>
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
                'labels' => array_keys($activitiesNotRecommended),
                'datasets' => [
                    [
                        'label' => "Профессии",
                        'backgroundColor' => "rgba(179,181,198,0.5)",
                        'borderColor' => "rgba(179,181,198,1)",
                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                        'data' => array_values($activitiesNotRecommended)
                    ]
                ]
            ]
        ]);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <h4>Наиболее часто рекомендуемые профессии:</h4>
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
                'labels' => array_keys($professionsRecommended),
                'datasets' => [
                    [
                        'label' => "Профессии",
                        'backgroundColor' => "rgba(179,181,198,0.5)",
                        'borderColor' => "rgba(179,181,198,1)",
                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                        'data' => array_values($professionsRecommended)
                    ]
                ]
            ]
        ]);
        ?>
    </div>
</div>
<br>
<h3>Статистика по пользовательским оценкам результатов</h3>
<div class="row">
    <div class="col-md-6 col-lg-6 col-xs-12">
        <h4>Оценки на рекомендуемые сферы деятельности:</h4>
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
                'labels' => array_keys($userMarksActivities),
                'datasets' => [
                    [
                        'label' => "Профессии",
                        'backgroundColor' => "rgba(179,181,198,0.5)",
                        'borderColor' => "rgba(179,181,198,1)",
                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                        'data' => array_values($userMarksActivities)
                    ]
                ]
            ]
        ]);
        ?>
    </div>
    <div class="col-md-6 col-lg-6 col-xs-12">
        <h4>Оценки на нерекомендуемые сферы деятельности:</h4>
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
                'labels' => array_keys($userMarksNotActivities),
                'datasets' => [
                    [
                        'label' => "Профессии",
                        'backgroundColor' => "rgba(179,181,198,0.5)",
                        'borderColor' => "rgba(179,181,198,1)",
                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                        'data' => array_values($userMarksNotActivities)
                    ]
                ]
            ]
        ]);
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    <h4>Оценки на рекомендуемые профессии:</h4>
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
                'labels' => array_keys($userMarksProfessions),
                'datasets' => [
                    [
                        'label' => "Профессии",
                        'backgroundColor' => "rgba(179,181,198,0.5)",
                        'borderColor' => "rgba(179,181,198,1)",
                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                        'data' => array_values($userMarksProfessions)
                    ]
                ]
            ]
        ]);
        ?>
    </div>
</div>

<h3>Статистика по выдаваемым сферам деятельности</h3>

<div style="width:70%">
    <table border="1">
        <thead>
            <td style="width:60%">Название сферы</td>
            <td style="width:10%">Сколько раз была рекомендована</td>
            <td style="width:10%">Средняя оценка пользователями</td>
            <td style="width:10%">Сколько раз была нерекомендована</td>
            <td style="width:10%">Средняя оценка пользователями</td>
        </thead>
        <tbody>
            <?php foreach($specStatisics as $item) {?>
                <tr>
                    <td><?php echo $item['name'] ?></td>
                    <td style="text-align:center"><?php echo $item['rTimes'] ?></td>
                    <td style="text-align:center"><?php echo ($item['rTimes'] != 0 ) ? round($item['rMarks']/$item['rTimes'], 1) : '-' ?></td>
                    <td style="text-align:center"><?php echo $item['notRTimes'] ?></td>
                    <td style="text-align:center"><?php echo ($item['notRTimes'] != 0 ) ? round($item['notRMarks']/$item['notRTimes'], 1) : '-'?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
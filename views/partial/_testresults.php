<?php if ($kv!=null && !empty($kv)) {?>
  <div class="panel square-simple">
      <h2>Квадрат пифагора:</h2>
      <table>
        <thead>
          <tr></tr>
          <tr></tr>
          <tr></tr>
        </thead>
        <tbody>
          <tr>
            <td data-toggle="tooltip" title="Воля">
              КП1: <?php echo $kv[0]; ?>
            </td>
            <td data-toggle="tooltip" title="Выносливость">
              КП4: <?php echo $kv[3]; ?>
            </td>
            <td data-toggle="tooltip" title="Удачливость">
              КП7: <?php echo $kv[6]; ?>
            </td>
          </tr>
          <tr>
            <td data-toggle="tooltip" title="Энергия">
              КП2: <?php echo $kv[1]; ?>
            </td>
            <td data-toggle="tooltip" title="Практический ум">
              КП5: <?php echo $kv[4]; ?>
            </td>
            <td data-toggle="tooltip" title="Ответственность">
              КП8: <?php echo $kv[7]; ?>
            </td>
          </tr>
          <tr>
            <td data-toggle="tooltip" title="Склонность к технологии">
              КП3: <?php echo $kv[2]; ?>
            </td>
            <td data-toggle="tooltip" title="Материальные ценности">
              КП6: <?php echo $kv[5]; ?>
            </td>
            <td data-toggle="tooltip" title="Испытываемые эмоции внутри.Внутренняя память">
              КП9: <?php echo $kv[8]; ?>
            </td>
          </tr>
        </tbody>
      </table>
  </div>
<?php } ?>

<div class="tooltip">Hover over me
  <span class="tooltiptext">Tooltip text</span>
</div>

<? if ($kvEx!=null && !empty($kvEx)) {?>
    <div class="panel square-simple">
        <h2>Расширенный квадрат пифагора:</h2>
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
        <h2>Средневзвешенный квадрат пифагора:</h2>
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
    <h2>Предпочтительные сферы деятельности:</h2>
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

<div class="panel square-simple">
    <h2>Профессии:</h2>
    <p>
        <?php
        if ($professions != null && !empty($professions))
        {
            $i = 0;
            foreach ($professions as $element) {
                if ($i<6 || (($element[1]<=($lastItem*0.5)) && $i<7) || ($element[1]==$lastItem)) {
                    echo '<div class="row">';
                    echo '<h3>' . $element[0]->name . ' Вес:' . $element[1] . '</h3>';
                    echo '</div>';

                    $i++;
                    $lastItem = $element[1];
                }
                else break;
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
    <h1>Сферы деятельности (Другой алгоритм):</h1>
    <p>
    <h2>Ячейки cфер деятельности:</h2>
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
    <h2>Сферы деятельности:</h2>
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
    <p>
    <h2>Рекомендуемые профессии:</h2>
    <?php
    if (isset($professionsNew) && $professionsNew != null && !empty($professionsNew))
    {
        echo '<table cellspacing="5" width="100%">';
        echo '<thead>';
        echo '<td width="45%">Название</td>';
        echo '<td width="20%">Вес профессии:</td>';
        echo '</thead>';
        echo '<tbody>';
        $i = 0;
        foreach ($professionsNew[1] as $key=>$element) {
            if ($i<6 || (($element<=($lastItem*0.5)) && $i<7) || ($element==$lastItem)) {
                $item = $professionsNew[0][$key];
                echo '<tr>';
                echo '<td>' . $item . '</td>';
                echo '<td>' . round($element, 2) . '</td>';
                echo '</tr>';

                $i++;
                $lastItem = $element;
            }
            else break;
        }
        echo '</tbody>';
        echo '</table>';
    }
    ?>
    </p>
</div>

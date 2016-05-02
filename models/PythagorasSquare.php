<?php
/**
 * Created by PhpStorm.
 * User: admin_vb
 * Date: 1.4.16
 * Time: 10.56
 */

namespace app\models;
use yii;


class PythagorasSquare
{
    public $date = null;
    public $dateSymbols = [];
    public $workingChars = [];
    public $workingCharsIntArray = [];
    public $simpleMatrix = [];
    public $extendedMatrix = [];
    public static $acceptableLevelOld = [
        1 =>[0, 0, 0, 1, 2, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        2 =>[0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        3 =>[0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        4 =>[1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        5 =>[1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        6 =>[1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        7 =>[1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        8 =>[1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        9 =>[0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        10=>[0, 0, 0, 0, 0, 1, 1, 2, 3, 3, 3, 3, 3, 3, 3],
        11=>[0, 0, 0, 1, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        12=>[0, 0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        13=>[0, 0, 0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3],
        14=>[0, 0, 0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3],
        15=>[0, 0, 0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3],
        16=>[0, 0, 0, 0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 2],
        17=>[0, 0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        18=>[0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        19=>[0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 2, 2, 2, 2, 3],
        20=>[0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 2, 2, 2, 2],
        21=>[0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 2, 2, 2, 2],
        22=>[0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 2, 2, 2, 2],
        23=>[0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 2, 2, 2, 2],
    ];
    public static $acceptableLevelNew = [
        1 =>[0, 0, 1, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        2 =>[0, 0, 1, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        3 =>[0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        4 =>[0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        5 =>[0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        6 =>[0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        7 =>[0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        8 =>[0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        9 =>[0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        10=>[0, 0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        11=>[0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        12=>[0, 0, 0, 1, 2, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        13=>[0, 0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        14=>[0, 0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        15=>[0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        16=>[0, 0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 2],
        17=>[0, 0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        18=>[0, 0, 1, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3],
        19=>[0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 2, 2, 2, 2, 3],
        20=>[0, 0, 0, 0, 0, 0, 1, 1, 2, 2, 3, 3, 3, 3, 3],
        21=>[0, 0, 0, 0, 0, 0, 0, 1, 1, 2, 2, 3, 3, 3, 3],
        22=>[0, 0, 0, 0, 0, 0, 0, 1, 1, 2, 2, 3, 3, 3, 3],
        23=>[0, 0, 0, 0, 0, 0, 0, 1, 1, 2, 2, 3, 3, 3, 3],
    ];
    public static $gFunction = [
        0 => [0.5, 1, 3, 5],
        1 => [0, 4, 7, 10],
        2 => [0, 7, 10, 17],
        3 => [0, 10, 14, 25],
    ];
    public static $hFunction = [
        0 => [0.5, 1, 1, 1],
        1 => [0, 0.25, 0.25, 0.5],
        2 => [0, 0.15, 0.15, 0.25],
    ];
    public static $specialityFunction = [
        '1.1'=>'5,6',
        '1.2'=>'1,5',
        '1.3'=>'2,9',
        '1.4'=>'3,7',
        '1.5'=>'5,7',
        '2.1'=>'4,7',
        '2.2'=>'6,8',
        '2.3'=>'2,5',
        '2.4'=>'2,4',
        '2.5'=>'7,9',
        '3.1'=>'3,8',
        '3.2'=>'2,3',
        '3.3'=>'3,5',
        '3.4'=>'2,7',
        '3.5'=>'5,9',
        '4.1'=>'6,9',
        '4.2'=>'6,7',
        '4.3'=>'3,6',
        '4.4'=>'4,5',
        '4.5'=>'4,9',
        '5.1'=>'3,9',
        '5.2'=>'2,8',
        '5.3'=>'4,8',
        '5.4'=>'3,4',
        '5.5'=>'7,8',
        '6.1'=>'1,7',
        '6.2'=>'5,8',
        '6.3'=>'4,6',
        '6.4'=>'8,9',
        '6.5'=>'2,6',
        '7.1'=>'1,3',
        '7.2'=>'1,2',
        '7.3'=>'1,6',
        '7.4'=>'1,4',
        '7.5'=>'1,9',
        '36' =>'1,8',

    ];

    public function __construct(\DateTime $date)
    {
        $this->date = $date->format('d-m-Y');

        $this->dateSymbols = self::formatIntoSymbolsArray($date);
        $this->workingChars = self::countWorkingChars($date);
        $this->workingCharsIntArray = self::explodeIntArrayIntoChars($this->workingChars);
        $this->simpleMatrix = self::countSquare($date);
        $this->extendedMatrix = self::countExtendedSquare($date);
    }

    // Creates array of symbols of this date
    public static function formatIntoSymbolsArray(\DateTime $date)
    {
        $arr = [];
        $str = $date->format('d-m-Y');
        //Days
        $arr[0] = $str[0];
        $arr[1] = $str[1];
        //Months
        $arr[2] = $str[3];
        $arr[3] = $str[4];
        //Years
        $arr[4] = $str[6];
        $arr[5] = $str[7];
        $arr[6] = $str[8];
        $arr[7] = $str[9];

        return $arr;
    }

    // Функция получения 4-х рабочих чисел для расчетов квадрата пифагора
    public static function countWorkingChars(\DateTime $date)
    {
        $dateChars = self::formatIntoSymbolsArray($date);

        //Первое рабочее число
        $elem1 = 0;
        foreach ($dateChars as $char) {
            $elem1 += $char;
        }

        //Второе рабочее число
        if ($elem1<=9)
            $elem2 = $elem1;
        else {
            $str = (string)$elem1;
            $elem2 = (integer)$str[0] + (integer)$str[1];
        }

        //Третье рабочее число
        $char = $dateChars[0];
        if ($dateChars[0]==0)
            $char = $dateChars[1];
        $elem3 = abs($elem1 - 2*$char);

        //Четвертое рабочее число
        if ($elem3<=9)
            $elem4 = $elem3;
        else {
            $str = (string)$elem3;
            $elem4 = (integer)$str[0] + (integer)$str[1];
        }

        return [$elem1,$elem2,$elem3,$elem4];
    }

    public static function explodeIntArrayIntoChars($chars)
    {
        $arr = [];
        foreach ($chars as $char) {
            $tempArray = str_split((string)$char);
            foreach ($tempArray as $item) {
                array_push($arr, $item);
            }
        }
        return $arr;
    }

    // Функция рассчета простого квадрата пифагора. На входе - экземпляр класса DateTime
    public static function countSquare(\DateTime $date)
    {
        $dateChars = self::formatIntoSymbolsArray($date);
        $workingChars = self::explodeIntArrayIntoChars(self::countWorkingChars($date));
        $square = [];

        for ($i=1;$i<10;$i++)
        {
            $c = 0;
            foreach ($workingChars as $char) {
                if ($char==$i)
                    $c++;
            }
            foreach ($dateChars as $char) {
                if ($char==$i)
                    $c++;
            }
            array_push($square,$c);
        }

        return $square;
    }

    // Функция рассчета расширенного квадрата пифагора. На входе - экземпляр класса DateTime
    public static function countExtendedSquare(\DateTime $date)
    {
        $workingChars = self::explodeIntArrayIntoChars(self::countWorkingChars($date));
        $dateChars = self::formatIntoSymbolsArray($date);
        $square = self::countSquare($date);

        // КП10
        $elem = $square[0]+$square[1]+$square[2];
        array_push($square, $elem);
        // КП11
        $elem = $square[3]+$square[4]+$square[5];
        array_push($square, $elem);
        // КП12
        $elem = $square[6]+$square[7]+$square[8];
        array_push($square, $elem);
        // КП13
        $elem = $square[0]+$square[3]+$square[6];
        array_push($square, $elem);
        // КП14
        $elem = $square[1]+$square[4]+$square[7];
        array_push($square, $elem);
        // КП15
        $elem = $square[2]+$square[5]+$square[8];
        array_push($square, $elem);
        // КП16
        $elem = $square[0]+$square[4]+$square[8];
        array_push($square, $elem);
        // КП17
        $elem = $square[2]+$square[4]+$square[6];
        array_push($square, $elem);

        // КП18 (Zero count)
        $elem=0;
        foreach ($workingChars as $item) {
            if ($item==0)
                $elem++;
        }
        foreach ($dateChars as $key=>$item) {
            if ($item==0 && $key!=0 && $key!=2)
                $elem++;
        }

        array_push($square, $elem);

        // КП19
        $elem = $square[11]+$square[13];
        array_push($square, $elem);
        // КП20
        $elem = $square[9]+$square[14];
        array_push($square, $elem);
        // КП21
        $elem = $square[10]+$square[12];
        array_push($square, $elem);
        // КП22
        $elem = $square[9]+$square[12];
        array_push($square, $elem);
        // КП23
        $elem = $square[15]+$square[6];
        array_push($square, $elem);

        return $square;
    }

    //Функция рассчета средневзвешенного квадрата пифагора (На входе - сохраненный в БД экземпляр класса Person. Выдает массив 23 элементов.
    public static function countWeightedSquare(TestedPerson $user)
    {
        $relations = $user->relatives;

        $squares = [];
        $levels = [];
        $accessLevels = [];
        $g = [];
        $h = [];
        $mainSquare = self::countExtendedSquare(\DateTime::createFromFormat('Y-m-d H:i:s', $user->birth_date));
        $squares[$user->id]= $mainSquare;
        $levels[$user->id] = 0;

        foreach ($relations as $relation) {
            $square = self::countExtendedSquare(\DateTime::createFromFormat('Y-m-d H:i:s', $relation->userRelated->birth_date));
            $squares[$relation->userRelated->id] = $square;
            $levels[$relation->userRelated->id] = $relation->relationType->level;
        }

        foreach ($squares as $key=>$sqr)
        {
            Yii::warning('Level['.$key.'] = '.$levels[$key].' KP: '.implode(' ', $sqr));
        }

        // Вычисление всех данных для каждого родственника
        foreach ($levels as $key=>$level) {
            $relation = TestedPerson::find()->where('id=:id',[':id'=>$key])->one();
            $accLevelPerson = [];
            $gPerson = [];
            $hPerson = [];
            Yii::warning($relation->birth_date);
            for ($i=1;$i<=23;$i++)
            {
                // Вычисление уровней доступа

                $acc = 0;
                if ($squares[$key][$i-1]>=15)
                    $acc = 3;
                elseif ($relation->birth_date<'2000')
                {
                    $acc = self::$acceptableLevelOld[$i][$squares[$key][$i-1]];
                }
                elseif($relation->birth_date>='2000')
                {
                    $acc = self::$acceptableLevelNew[$i][$squares[$key][$i-1]];
                }
                $accLevelPerson[$i] = $acc;

                // Определение g-функции элемента
                $gElem = 0;
                if ($squares[$key][17]>=3)
                    $n = 3;
                else
                    $n = $squares[$key][17];
                $gElem = self::$gFunction[$n][$acc];
                $gPerson[$i] = $gElem;

                // Определение h-функции элемента
                $hElem = self::$hFunction[$level][$acc];
                $hPerson[$i] = $hElem;
            }
            $accessLevels[$key]= $accLevelPerson;
            $h[$key]= $hPerson;
            $g[$key]= $gPerson;

            Yii::warning('Key = '.$key.' Level: '.$level.' Acc[1] = '.$accLevelPerson[1].' G[1] = '.$gPerson[1].' H[1] = '.$hPerson[1]);
        }

        // Рассчет средневзвешенной матрицы
        $kp = [];
        for ($i=1;$i<=23;$i++)
        {
            $ch = 0;
            $zn = 0;
            foreach ($levels as $key=>$level) {
                $ch += $h[$key][$i] * $g[$key][$i] * $squares[$key][$i-1];
                $zn += $h[$key][$i] * $g[$key][$i];
            }
            if ($zn == 0)
            {
                Yii::warning('Деление на 0, элемент '. ($i+1));
                $kp[$i]=$ch;
            }
            else
                $kp[$i] = round($ch/$zn, 2);
        }

        return $kp;
    }

    // Первые 9 элементов от расширенного квадрата, сортируются по убыванию. Старые ключи сохраняются в отдельный массив с теми же новыми ключами
    public static function getMainSortedElements($kp)
    {
        $keys = [0,1,2,3,4,5,6,7,8];
        for ($i=0;$i<9;$i++)
        {
            for ($j=$i;$j<9;$j++)
            {
                if ($kp[$i]<$kp[$j])
                {
                    $buf = $kp[$i];
                    $kp[$i] = $kp[$j];
                    $kp[$j] = $buf;
                    $buf = $keys[$i];
                    $keys[$i] = $keys[$j];
                    $keys[$j] = $buf;
                }
            }
        }

        return [$kp,$keys];
    }

    // Поиск главных пар элементов для этапов 3,4
    public static function foundMainElementPairs($kp_full)
    {
        $kp = array_slice($kp_full,0,9);

        $temp = self::getMainSortedElements($kp);
        $kp = $temp[0];
        $keys = $temp[1];

        $befSort = '';
        foreach ($kp as $key=>$item) {
            $befSort .= ' key='.$keys[$key].' val='.$item;
        }
        Yii::warning('After sorting: '.$befSort);

        $pairs = [];
        if ($kp[0]>=($kp[1]*1.5))
            $pairs = self::getDominatingPairs($kp,$keys);
        else
            $pairs = self::getNonDominatingPairs($kp,$keys);

        foreach ($pairs as $pair) {
            Yii::warning('Pair:'.$pair[0].'-'.$pair[1]);
        }
        
        return $pairs;
    }

    // Этап 3 - для сверхдоминирующего случая
    public static function getDominatingPairs($kp,$keys)
    {
        $arr = [];
        $i = 1;
        
        $elements = [$kp[1]];
        for ($i=2;$i<9;$i++)
        {
            if ($kp[$i]>= (0.75 * $kp[1]))
                array_push($elements, $keys[$i]);
        }

        foreach ($elements as $element) {
            $arr []= [$keys[0]+1,$element+1];
        }
        
        return $arr;
    }

    // Этап 3 - для НЕ сверхдоминирующего случая
    public static function getNonDominatingPairs($kp,$keys)
    {
        $elements = [];
        $arr = [];
        $i = 1;
        array_push($elements, $keys[0]);

        while ($kp[$i]>=(0.5 * $kp[0])) {
            array_push($elements, $keys[$i]);
            $i++;
        }
        Yii::warning('Elements: '.implode(', ',$elements));

        for ($i=0;$i<count($elements);$i++)
        {
            for ($j=$i+1;$j<count($elements);$j++) {
                $arr []= [$keys[$i]+1,$keys[$j]+1];
            }
        }
        
        return $arr;
    }

    // Получение пар специализации (Этап 4)
    public static function getSpecialitiesForPairs($pairs)
    {
        $specialityList = [];
        foreach ($pairs as $pair)
        {
            sort($pair);
            $pair = implode(',',$pair);
            foreach (self::$specialityFunction as $key=>$item)
            {
                if ($item == $pair)
                    $specialityList[$pair] = $key;
            }
        }
        Yii::warning('Список пар цифр для специализаций: '.implode(' ',$specialityList));
        return $specialityList;
    }
}
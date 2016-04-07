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

    public function __construct(\DateTime $date)
    {
        $this->date = $date->format('d-m-Y');

        $this->dateSymbols = self::formatIntoSymbolsArray($date);
        Yii::warning('Current date: '.$this->date);
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

        Yii::warning('Рабочие числа: '.implode(' ',[$elem1,$elem2,$elem3,$elem4]));
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
        Yii::warning(implode(' ',$workingChars));
        Yii::warning(implode(' ',$dateChars));

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
}
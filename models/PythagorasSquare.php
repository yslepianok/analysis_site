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
        $chars = [];
        $dateChars = self::formatIntoSymbolsArray($date);

        //Первое рабочее число
        $elem1 = 0;
        foreach ($dateChars as $char) {
            $elem1 += $char;
        }

        //Второе рабочее число
        $str = (string)$elem1;
        $elem2 = (integer)$str[0] + (integer)$str[1];

        //Третье рабочее число
        $elem3 = $elem1 - 2*(($dateChars[0]!==0) ? $dateChars[0] : $dateChars[1]);

        //Четвертое рабочее число
        $str = (string)$elem3;
        $elem4 = (integer)$str[0] + (integer)$str[1];

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
        Yii::warning('exploded working chars: '.implode(' ',$arr));
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

        Yii::warning('date chars: '.implode(' ', $dateChars));
        Yii::warning('working chars: '.implode(' ', $workingChars));
        Yii::warning('square: '.implode(' ', $square));
        return $square;
    }

    public static function countExtendedSquare(\DateTime $date)
    {
        $workingChars = self::countWorkingChars($date);
        $initialSquare = self::countSquare($date);
        return [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
    }
}
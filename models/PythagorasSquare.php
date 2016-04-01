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
    public $simpleMatrix = [];
    public $extendedMatrix = [];

    public function __construct(\DateTime $date)
    {
        $this->date = $date->format('d-m-Y');

        $this->dateSymbols = PythagorasSquare::formatIntoSymbolsArray($date);
        Yii::warning('Current date: '.$this->date);
        $this->workingChars = PythagorasSquare::countWorkingChars($date);
        $this->simpleMatrix = PythagorasSquare::countSquare($date);
        $this->extendedMatrix = PythagorasSquare::countExtendedSquare($date);
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
        return [1,2,3,4];
    }

    public static function countSquare(\DateTime $date)
    {
        $workingChars = PythagorasSquare::countWorkingChars($date);
        return [1,2,3,4,5,6,7,8,9];
    }

    public static function countExtendedSquare(\DateTime $date)
    {
        $workingChars = PythagorasSquare::countWorkingChars($date);
        $initialSquare = PythagorasSquare::countSquare($date);
        return [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
    }
}
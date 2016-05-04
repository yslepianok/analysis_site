<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profession".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $specialityId
 * @property string $main_cell_1
 * @property string $main_cell_2
 * @property string $additional_cell_1
 * @property string $additional_cell_2
 * @property string $additional_cell_3
 * @property string $additional_cell_4
 * @property string $additional_cell_5
 * @property string $additional_cell_6
 * @property integer $boss_flags
 *
 * @property ActivityType $speciality
 */
class Profession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profession';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['specialityId', 'boss_flags'], 'integer'],
            [['name'], 'string', 'max' => 250],
            [['main_cell_1', 'main_cell_2', 'additional_cell_1', 'additional_cell_2', 'additional_cell_3', 'additional_cell_4', 'additional_cell_5', 'additional_cell_6'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'specialityId' => 'Speciality ID',
            'main_cell_1' => 'Main Cell 1',
            'main_cell_2' => 'Main Cell 2',
            'additional_cell_1' => 'Additional Cell 1',
            'additional_cell_2' => 'Additional Cell 2',
            'additional_cell_3' => 'Additional Cell 3',
            'additional_cell_4' => 'Additional Cell 4',
            'additional_cell_5' => 'Additional Cell 5',
            'additional_cell_6' => 'Additional Cell 6',
            'boss_flags' => 'Boss Flags',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpeciality()
    {
        return $this->hasOne(ActivityType::className(), ['id' => 'specialityId']);
    }
    
    public static function getUserProfessions($user)
    {
        $passed1 = [];
        $passed2 = [];
        $passed3 = [];

        // Пункт 3, средневзвешенный расширенный квадрат пифагора
        $kvW = PythagorasSquare::countWeightedSquare($user);

        $pairs = PythagorasSquare::foundMainElementPairs($kvW);

        // Пункт 1, Элементы таблички 4.3
        $specialities = PythagorasSquare::getSpecialitiesForPairs($pairs);

        $kp = array_slice($kvW,0,9);

        // Пункт 2, веса ячеек пункта1
        $weights = self::getCellWeights($specialities, $kp);

        // Пункт 4 находится в БД

        // Маска лидерства
        $leader = PythagorasSquare::getLeaderBits($user);

        $professions = [];
        $professionsDB = Profession::find()->all();
        foreach ($professionsDB as $profession) {
            $spc = [];

            $i = 0;
            if ($profession->additional_cell_1!=null) {
                $spc [] = $profession->additional_cell_1;
                $i++;
            }
            if ($profession->additional_cell_2!=null){
                $spc []= $profession->additional_cell_2;
                $i++;
            }
            if ($profession->additional_cell_3!=null){
                $spc []= $profession->additional_cell_3;
                $i++;
            }
            if ($profession->additional_cell_4!=null){
                $spc []= $profession->additional_cell_4;
                $i++;
            }
            if ($profession->additional_cell_5!=null){
                $spc []= $profession->additional_cell_5;
                $i++;
            }
            if ($profession->additional_cell_6!=null){
                $spc []= $profession->additional_cell_6;
                $i++;
            }

            // Этап отбраковки 1: Количество совпадающих ячеек
            $passedItems = [];
            $j = 0;
            foreach ($spc as $item) {
                if (in_array($item, $specialities))
                {
                    $passedItems []= $item;
                    $j++;
                }
            }

            $failed = true;
            switch ($i)
            {
                case 1:
                    $failed = ($j <= 0);
                    break;
                case 2:
                    $failed = ($j <= 1);
                    break;
                case 3:
                    $failed = ($j <= 1);
                    break;
                case 4:
                    $failed = ($j <= 1);
                    break;
                case 5:
                    $failed = ($j <= 2);
                    break;
                case 6:
                    $failed = ($j <= 2);
                    break;
            }
            if ($failed)
                continue;
            $passed1 []= $profession->name;

            // Этап отбраковки 2: Допустимость элементов профессии
            $failed = false;
            foreach ($spc as $item) {
                $element = PythagorasSquare::$specialityFunction[$item];
                $s1 = (integer)((string)$element[0]);
                $s2 = (integer)((string)$element[2]);
                
                $acc_lvl1 = PythagorasSquare::getElementAccessLevel($s1, $kvW[$s1], $user);
                $acc_lvl2 = PythagorasSquare::getElementAccessLevel($s2, $kvW[$s2], $user);

                if ($acc_lvl1==0 || $acc_lvl2==0)
                    $failed = true;
            }
            if ($failed)
                continue;
            $passed2 []= $profession->name;

            // Этам отбраковки 3: управляющие биты
            if ($profession->boss_flags[0]>$leader[0] &&
                $profession->boss_flags[1]>$leader[1] &&
                $profession->boss_flags[2]>$leader[2] &&
                $profession->boss_flags[3]>$leader[3])
                continue;

            $passed3 []= $profession->name;

            // Если мы вошли сюда, профессия не отбракована
            Yii::warning(' Профессия прошла отбраковку: '.$profession->name);
            // Вычисление веса профессии
            $weight = 0;
            $r = self::rFunction($leader);
            foreach ($spc as $item) {
                $w = self::getCellWeight($item, $kp);
                $weight += $w * $r;
            }
            $professions []= [0=>$profession, 1=>$weight];
        }
        Yii::warning('Прошли 1 этап отбраковки: '.count($passed1));
        Yii::warning('Прошли 2 этап отбраковки: '.count($passed2));
        Yii::warning('Прошли 3 этап отбраковки: '.count($passed3));
        return $professions;
    }

    public static function getCellWeights($specialities, $kp)
    {
        $weight = [];
        $debugStr = '';

        foreach ($specialities as $key=>$speciality) {
            $w = $kp[(integer)$key[0]-1] + $kp[(integer)$key[2]-1];
            $weight[$key] = $w;

            $debugStr .= 'Элемент='.$speciality.' Вес='.$w.'; ';
        }

        Yii::warning($debugStr);
        return $weight;
    }

    public static function getCellWeight($key, $kp)
    {
        $w = $kp[(integer)$key[0]-1] + $kp[(integer)$key[2]-1];
        return $w;
    }

    public static function rFunction($lead)
    {
        if ($lead[3]==1 || ($lead[2]==1 && $lead[1]==1))
            return 2;
        elseif ($lead[4]==1 || ($lead[0]==1 && $lead[1]==1))
            return 1.5;
        else return 1;
    }
}

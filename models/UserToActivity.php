<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_to_activity".
 *
 * @property integer $user_id
 * @property integer $activity_id
 * @property string $date
 * @property string $additional
 *
 * @property User $user
 * @property ActivityType $activity
 */
class UserToActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_to_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'activity_id'], 'required'],
            [['user_id', 'activity_id'], 'integer'],
            [['date'], 'safe'],
            [['additional'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'activity_id' => 'Activity ID',
            'date' => 'Date',
            'additional' => 'Additional',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(ActivityType::className(), ['id' => 'activity_id']);
    }

    // @todo Тут можно сильно оптимизировать (А можно и не оптимизировать)
    // Функция определения предпочитаемой сферы деятельности и ее веса
    public static function getUserSpecialities($user)
    {
        $kvW = PythagorasSquare::countWeightedSquare($user);
        $pairs = PythagorasSquare::foundMainElementPairs($kvW);
        $specialities = PythagorasSquare::getSpecialitiesForPairs($pairs);
        $kp = array_slice($kvW,0,9);
        $res = PythagorasSquare::getMainSortedElements($kp);
        $kp = $res[0];
        $keys = $res[1];

        $specials = [];
        $weights = [];

        /*$i = 0;
        foreach ($specialities as $key1=>$itemFirst)
        {
            $arr = array_slice($specialities,$i+1);
            foreach ($arr as $key2=>$itemSecond)
            {
                //Yii::warning('Текущая пара пар цифр:'.$itemFirst.' '.$itemSecond);
                $elements = [];
                $activity = null;
                if (($activity = ActivityType::find()->where('(pair_one=:pair1 AND pair_two=:pair2) OR (pair_one=:pair2 AND pair_two=:pair1)',[':pair1'=>$itemFirst,':pair2'=>$itemSecond])->one()) instanceof ActivityType && !in_array($activity, $specials))
                {
                    if ($activity instanceof ActivityType) {
                        $specials [] = $activity;
                        $elements = [(integer)$key1[0], (integer)$key1[2], (integer)$key2[0], (integer)$key2[2]];
                    }
                }
                elseif(($activity = ActivityType::find()->where('pair_one=:pair1 OR pair_two=:pair1',[':pair1'=>$itemFirst])->one()) instanceof ActivityType && !in_array($activity, $specials))
                {
                    if ($activity instanceof ActivityType) {
                        $specials [] = $activity;
                        $p1 = $activity->pair_one;
                        $p2 = $activity->pair_two;
                        $elements = [(integer)$key1[0], (integer)$key1[2]];
                    }
                }
                elseif($activity = (ActivityType::find()->where('pair_one=:pair1 OR pair_two=:pair1',[':pair1'=>$itemSecond])->one()) instanceof ActivityType && !in_array($activity, $specials))
                {
                    if ($activity instanceof ActivityType) {
                        $specials [] = $activity;
                        $elements = [(integer)$key1[0], (integer)$key1[2]];
                    }
                }
                else continue;

                if ($activity instanceof ActivityType)
                {
                    Yii::warning('вес:');
                    $weight = 0;
                    foreach ($elements as $element) {
                        Yii::warning($kvW[$element]);
                        $weight += $kvW[$element];
                    }
                    if ($weight != 0)
                        $weights [] = $weight;
                }
            }
            $i++;
        }*/

        $arr = ActivityType::find()->all();
        $arr_to_find = PythagorasSquare::$specialityFunction;
        foreach ($arr as $item) {
            if (array_search($item->pair_one, $specialities) || array_search($item->pair_two, $specialities))
            {
                Yii::warning('Найдено '.$item->pair_one.' или/и '.$item->pair_two);
                $specials []= $item;
                $a = $arr_to_find[$item->pair_one];
                $b = $arr_to_find[$item->pair_two];
                $weights []= $kvW[$a[0]-1] + $kvW[$a[2]-1] + $kvW[$b[0]-1] + $kvW[$b[2]-1];
            }
        }
        Yii::warning('Количество специализаций: '.count($specials));

        // Сортировка полученных сфер деятельности с учетом их веса
        for ($i=0;$i<count($specials);$i++)
        {
            for ($j=$i;$j<count($specials);$j++)
            {
                if ($weights[$i]<$weights[$j])
                {
                    $buf = $specials[$i];
                    $specials[$i] = $specials[$j];
                    $specials[$j] = $buf;
                    $buf = $weights[$i];
                    $weights[$i] = $weights[$j];
                    $weights[$j] = $buf;
                }
            }
        }

        foreach ($specials as $key=>$special) {
            Yii::warning('Специализация: '.$special->name.' Вес:'.$weights[$key]);
        }
        return [$specials, $weights];
    }

    public static function getUserSpecialitiesExtended($user)
    {
        $kvW = PythagorasSquare::countWeightedSquare($user);

        $weights = self::getCellsWeight($kvW);

        arsort($weights);

        $arrPositive = [];
        $i=0;
        $lastEl = 0;
        $lastKey = null;
        foreach ($weights as $key=>$item) {
            if ($i<7 || (($item>=($lastEl*0.5)) && $i<10) || (in_array($lastKey, $arrPositive) && $item>=$lastEl*0.85))
                $arrPositive []= $key;
            else
                break;

            $i++;
            $lastEl = $item;
            $lastKey = $key;
        }

        asort($weights);
        $arrNegative = [];
        $i=0;
        $lastEl = 0;
        $lastKey = null;
        foreach ($weights as $key=>$item) {
            if ($i<7 || (($lastEl>=($item*0.5)) && $i<10) || (in_array($lastKey, $arrNegative) && $item<=$lastEl*0.99))
                $arrNegative []= $key;
            else
                break;

            $i++;
            $lastEl = $item;
            $lastKey = $key;
        }

        arsort($weights);


        // Определение сфер деятельности
        $weightSpecial = [];
        $itemsSpecial = [];
        $arr = ActivityType::find()->all();
        foreach ($arr as $item) {
            $weightSpecial[$item->id] = $weights[$item->pair_one] + $weights[$item->pair_two];
            $itemsSpecial[$item->id] = $item;
        }

        arsort($weightSpecial);
        $arrSpecPositive = [];
        $i=0;
        $lastEl = 0;
        $lastKey = null;
        foreach ($weightSpecial as $key=>$item) {
            if ($i<3 || (($item>=($lastEl*0.5)) && $i<4) || (in_array($lastKey, $arrSpecPositive) && $item==$lastEl))
                $arrSpecPositive []= $key;
            else
                break;

            $i++;
            $lastEl = $item;
            $lastKey = $key;
        }

        asort($weightSpecial);
        $arrSpecNegative = [];
        $i=0;
        $lastEl = 0;
        $lastKey = null;
        foreach ($weightSpecial as $key=>$item) {
            if ($i<3 || (($item<=($lastEl*0.5)) && $i<4) || (in_array($lastKey, $arrSpecNegative) && $item==$lastEl))
                $arrSpecNegative []= $key;
            else
                break;

            $i++;
            $lastEl = $item;
            $lastKey = $key;
        }

        arsort($weightSpecial);

        return [$weights, $arrPositive, $arrNegative, $itemsSpecial, $weightSpecial, $arrSpecPositive, $arrSpecNegative];
    }

    public static function getCellsWeight($kpW, $ss=null, $alf=null)
    {
        $res = PythagorasSquare::getMainSortedElements($kpW);
        $kp = $res[0];
        $keys = $res[1];

        $result = [];
        $arr = PythagorasSquare::$specialityFunction;
        if ($ss!=null) {

            foreach ($arr as $key => $item) {
                $el = $ss[$key[0]][$key[2]];
                $result[$key] = round (($el + $alf * (($kpW[$item[0]-1] + $kpW[$item[2]-1]) * 2 / $kp[0] - 2)),2);
            }
        }
        else
        {
            foreach ($arr as $key => $item) {
                $result[$key] = round((($kpW[$item[0]-1] + $kpW[$item[2]-1]) * 2 / $kp[0] - 2),2);
            }
        }

        return $result;
    }

    public static function getCellsWeightSorted($kvW, $ss=null, $alf=null) {
        $weights = self::getCellsWeight($kvW, $ss, $alf);
        
        arsort($weights);

        return $weights;
    }

    public static function getUserSpecialitiesByMatrix($weights) {
        $weightSpecial = [];
        $itemsSpecial = [];
        $arr = ActivityType::find()->all();

        arsort($weights);

        // Без понятия зачем это надо, но надо
        $arrPositive = [];
        $i=0;
        $lastEl = 0;
        $lastKey = null;
        /*foreach ($weights as $key=>$item) {
            if ($i<7 || (($item>=($lastEl*0.5)) && $i<10) || (in_array($lastKey, $arrPositive) && $item>=$lastEl*0.85))
                $arrPositive []= $key;
            else
                break;

            $i++;
            $lastEl = $item;
            $lastKey = $key;
        }*/
        foreach($weights as $key=>$item) {
            if ($i<4) {
                $arrPositive[] = $key;
                $i++;                
                $lastEl = $item;
                $lastKey = $key;
            }
            
            if ($i >= 4 && $i < 7 && ($item >= 0.75*$lastEl)) {
                if (!in_array($key, $arrPositive)) {
                    $arrPositive[] = $key;
                    $i++;                
                    $lastEl = $item;
                    $lastKey = $key;
                }
            }

            if ($i >= 7 && $item >= 0.85*$lastEl && !($lastEl <= 0 && $item >= 0)) {
                if (!in_array($key, $arrPositive)) {                    
                    $arrPositive[] = $key;
                    $i++;                
                    $lastEl = $item;
                    $lastKey = $key;
                }
            }
        }

        asort($weights);
        $arrNegative = [];
        $i=0;
        $lastEl = 0;
        $lastKey = null;
        /*foreach ($weights as $key=>$item) {
            if ($i<7 || (($lastEl>=($item*0.5)) && $i<10) || (in_array($lastKey, $arrNegative) && $item<=$lastEl*0.99))
                $arrNegative []= $key;
            else
                break;

            $i++;
            $lastEl = $item;
            $lastKey = $key;
        }*/
        foreach($weights as $key=>$item) {
            if ($i<4) {
                $arrNegative[] = $key;
                $i++;                
                $lastEl = $item;
                $lastKey = $key;
            }
            
            if ($i >= 4 && $i < 7 && ($item <= 0.75*$lastEl)) {
                if (!in_array($key, $arrNegative)) {
                    $arrNegative[] = $key;
                    $i++;                
                    $lastEl = $item;
                    $lastKey = $key;
                }
            }

            if ($i >= 7 && $item <= 0.85*$lastEl && !($lastEl <= 0 && $item >= 0)) {
                if (!in_array($key, $arrNegative)) {                    
                    $arrNegative[] = $key;
                    $i++;                
                    $lastEl = $item;
                    $lastKey = $key;
                }
            }
        }

        arsort($weights);


        foreach ($arr as $item) {
            $weightSpecial[$item->id] = $weights[$item->pair_one] + $weights[$item->pair_two];
            $itemsSpecial[$item->id] = $item;
        }

        arsort($weightSpecial);
        $arrSpecPositive = [];
        $i=0;
        $lastEl = 0;
        $lastKey = null;
        foreach ($weightSpecial as $key=>$item) {
            if ($i<3 || (($item>=($lastEl*0.5)) && $i<4) || (in_array($lastKey, $arrSpecPositive) && $item==$lastEl))
                $arrSpecPositive []= $key;
            else
                break;

            $i++;
            $lastEl = $item;
            $lastKey = $key;
        }

        asort($weightSpecial);
        $arrSpecNegative = [];
        $i=0;
        $lastEl = 0;
        $lastKey = null;
        foreach ($weightSpecial as $key=>$item) {
            if ($i<3 || (($item<=($lastEl*0.5)) && $i<4) || (in_array($lastKey, $arrSpecNegative) && $item==$lastEl))
                $arrSpecNegative []= $key;
            else
                break;

            $i++;
            $lastEl = $item;
            $lastKey = $key;
        }

        arsort($weightSpecial);

        return [$weights, $arrPositive, $arrNegative, $itemsSpecial, $weightSpecial, $arrSpecPositive, $arrSpecNegative];
    }
}

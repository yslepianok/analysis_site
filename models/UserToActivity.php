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

        $i = 0;
        foreach ($specialities as $key1=>$itemFirst)
        {
            $arr = array_slice($specialities,$i+1);
            foreach ($arr as $key2=>$itemSecond)
            {
                //Yii::warning('Текущая пара пар цифр:'.$itemFirst.' '.$itemSecond);
                $elements = [];
                $activity = ActivityType::find()->where('(pair_one=:pair1 AND pair_two=:pair2) OR (pair_one=:pair2 AND pair_two=:pair1)',[':pair1'=>$itemFirst,':pair2'=>$itemSecond])->one();
                if ($activity!=null && !in_array($activity, $specials))
                {
                    $specials []= $activity;
                    $elements = [(integer)$key1[0],(integer)$key1[2],(integer)$key2[0],(integer)$key2[2]];
                }
                elseif(($activity = ActivityType::find()->where('pair_one=:pair1 OR pair_two=:pair1',[':pair1'=>$itemFirst])->one())!=null && !in_array($activity, $specials))
                {
                    $specials []= $activity;
                    $elements = [(integer)$key1[0],(integer)$key1[2]];
                }
                elseif($activity = (ActivityType::find()->where('pair_one=:pair1 OR pair_two=:pair1',[':pair1'=>$itemSecond])->one())!=null && !in_array($activity, $specials))
                {
                    $specials []= $activity;
                    $elements = [(integer)$key1[0],(integer)$key1[2]];
                }
                $weight = 0;
                foreach ($elements as $element) {
                    $weight += $kvW[$element];
                }
                if ($weight!=0)
                    $weights []= $weight;
            }
            $i++;
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
}

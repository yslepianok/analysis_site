<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_to_testing".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $testing_id
 * @property string $date
 * @property string $raw_result
 * @property string $calculated_result
 *
 * @property Testing $testing
 */
class UserToTesting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_to_testing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'testing_id', 'date', 'raw_result'], 'required'],
            [['user_id', 'testing_id'], 'integer'],
            [['date'], 'safe'],
            [['raw_result', 'calculated_result'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'testing_id' => 'Testing ID',
            'date' => 'Date',
            'raw_result' => 'Raw Result',
            'calculated_result' => 'Calculated Result',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTesting()
    {
        return $this->hasOne(Testing::className(), ['id' => 'testing_id']);
    }
}

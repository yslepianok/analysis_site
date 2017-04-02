<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_to_test".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $test_id
 * @property string $date
 * @property string $url
 * @property string $answers
 *
 * @property UserInfo $user
 * @property Test $test
 */
class UserToTest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_to_test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'test_id', 'date'], 'required'],
            [['user_id', 'test_id'], 'integer'],
            [['date'], 'safe'],
            [['answers'], 'string'],
            [['url'], 'string', 'max' => 250]
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
            'test_id' => 'Test ID',
            'date' => 'Date',
            'url' => 'Url',
            'answers' => 'Answers',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserInfo::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }
}

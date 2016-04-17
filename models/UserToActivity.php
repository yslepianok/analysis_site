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

    public static function getUserSpecialities($user)
    {
        
    }
}

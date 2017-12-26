<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $birth_date
 * @property integer $user_id
 *
 * @property UserToActivity[] $userToActivities
 * @property ActivityType[] $activities
 * @property UserToUser[] $userToUsers
 * @property UserToUser[] $userToUsers0
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birth_date'], 'required'],
            [['birth_date'], 'safe'],
            [['user_id'], 'integer'],
            [['name'], 'string', 'max' => 45]
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
            'birth_date' => 'Birth Date',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToActivities()
    {
        return $this->hasMany(UserToActivity::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(ActivityType::className(), ['id' => 'activity_id'])->viaTable('user_to_activity', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToUsers()
    {
        return $this->hasMany(UserToUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToUsers0()
    {
        return $this->hasMany(UserToUser::className(), ['user_related_id' => 'id']);
    }
}

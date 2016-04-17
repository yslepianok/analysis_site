<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $pair_one
 * @property string $pair_two
 *
 * @property UserToActivity[] $userToActivities
 * @property User[] $users
 */
class ActivityType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['pair_one', 'pair_two'], 'string', 'max' => 3]
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
            'pair_one' => 'Pair One',
            'pair_two' => 'Pair Two',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToActivities()
    {
        return $this->hasMany(UserToActivity::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_to_activity', ['activity_id' => 'id']);
    }
}

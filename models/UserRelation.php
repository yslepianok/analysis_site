<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_relation".
 *
 * @property integer $id
 * @property string $name
 * @property integer $level
 *
 * @property UserToUser[] $userToUsers
 */
class UserRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_relation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['level'], 'integer'],
            [['name'], 'string', 'max' => 50]
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
            'level' => 'Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToUsers()
    {
        return $this->hasMany(UserToUser::className(), ['relation_id' => 'id']);
    }
}

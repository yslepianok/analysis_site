<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_to_user".
 *
 * @property integer $user_id
 * @property integer $user_related_id
 * @property integer $relation_id
 *
 * @property User $user
 * @property User $userRelated
 * @property UserRelation $relation
 */
class UserToUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_to_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_related_id', 'relation_id'], 'required'],
            [['user_id', 'user_related_id', 'relation_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_related_id' => 'User Related ID',
            'relation_id' => 'Relation ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TestedPerson::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRelated()
    {
        return $this->hasOne(TestedPerson::className(), ['id' => 'user_related_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelationType()
    {
        return $this->hasOne(UserRelation::className(), ['id' => 'relation_id']);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: admin_vb
 * Date: 31.3.16
 * Time: 16.53
 */

namespace app\models;
use yii\db\ActiveRecord;

class TestedPerson extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birth_date'], 'required'],
            [['birth_date'], 'safe'],
            [['name'], 'string', 'max' => 45],
            [['name'], 'unique']
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
        ];
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
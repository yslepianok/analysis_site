<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "User".
 *
 * @property integer $id
 * @property string $name
 * @property string $birth_date
 * @property string $email
 * @property string $password
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birth_date', 'password'], 'required'],
            [['birth_date'], 'safe'],
            [['name', 'email'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 255]
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
            'email' => 'Email',
            'password' => 'Password',
        ];
    }
}

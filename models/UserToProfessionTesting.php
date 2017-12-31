<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_to_profession_testing".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $oldRawResults
 * @property string $newRawResults
 * @property string $timestamp
 */
class UserToProfessionTesting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_to_profession_testing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'oldRawResults'], 'required'],
            [['user_id'], 'integer'],
            [['oldRawResults', 'newRawResults'], 'string'],
            [['timestamp'], 'safe']
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
            'oldRawResults' => 'Old Raw Results',
            'newRawResults' => 'New Raw Results',
            'timestamp' => 'Timestamp',
        ];
    }
}

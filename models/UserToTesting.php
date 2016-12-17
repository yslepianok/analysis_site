<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_to_testing".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $testing_id
 * @property string $raw_results
 * @property string $calculated_results
 * @property string $date
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
            [['id', 'user_id', 'testing_id'], 'required'],
            [['id', 'user_id', 'testing_id'], 'integer'],
            [['raw_results', 'calculated_results'], 'string'],
            [['date'], 'safe']
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
            'raw_results' => 'Raw Results',
            'calculated_results' => 'Calculated Results',
            'date' => 'Date',
        ];
    }
}

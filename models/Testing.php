<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "testing".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property double $multipler
 * @property string $directive
 * @property string $test_data
 *
 * @property UserToTesting[] $userToTestings
 */
class Testing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['multipler'], 'number'],
            [['test_data'], 'string'],
            [['name', 'description', 'directive'], 'string', 'max' => 45]
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
            'multipler' => 'Multipler',
            'directive' => 'Directive',
            'test_data' => 'Test Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToTestings()
    {
        return $this->hasMany(UserToTesting::className(), ['testing_id' => 'id']);
    }
}

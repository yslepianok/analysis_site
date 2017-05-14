<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $test_id
 * @property string $name
 * @property string $text
 * @property string $url
 *
 * @property Answer[] $answers
 * @property Test $test
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'name'], 'required'],
            [['test_id'], 'integer'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Test ID',
            'name' => 'Name',
            'text' => 'Text',
            'url' => 'Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields[] = 'answers';

        return $fields;
    }
}

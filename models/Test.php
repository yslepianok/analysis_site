<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property integer $id
 * @property string $name
 * @property double $weight
 * @property string $comment
 * @property string $description
 *
 * @property Question[] $questions
 * @property UserToTest[] $userToTests
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['weight'], 'number'],
            [['comment'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 30]
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
            'weight' => 'Weight',
            'comment' => 'Comment',
            'description' => 'Description'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['test_id' => 'id'])->
        orderBy(['id' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToTests()
    {
        return $this->hasMany(UserToTest::className(), ['test_id' => 'id']);
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields[] = 'questions';

        return $fields;
    }
}

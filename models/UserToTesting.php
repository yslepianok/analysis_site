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
            [['user_id', 'testing_id'], 'required'],
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

    public static function getUserTestResultsMatrix($userId) {
        // Новые данные из психологических тестов
        $testResults = self::find()->where(['user_id' => $userId])->all();
        $testWeightedCells = [];
        Yii::warning('User has passed '.count($testResults).' tests:');
        // Сначала цикл по самим тестам
        foreach($testResults as $test) {
            $testResult = json_decode($test->calculated_results, true);
            $passedTest = Test::find()->where(['id' => $test->id])->one();
            Yii::warning('User has passed test #'.$passedTest->id.' , "'.$passedTest->name.'"; with testWeight='.$passedTest->weight);
            // Цикл по той самой матрице(вектору)
            foreach(PythagorasSquare::$specialityFunction as $key=>$val) {
                if (!array_key_exists($key, $testWeightedCells)) {
                    $testWeightedCells[$key] = 0;
                }

                $testWeightedCells[$key] = round($testWeightedCells[$key] +  $testResult[$key] * $passedTest->weight, 2);
            }
        }

        return $testWeightedCells;
    }

    public static function mergeKvAndTesting($weightsKv, $weightsTesting) {
        $result = [];
        $pythagorasSquareWeight = Yii::$app->params['pythagorasSquareWeight'];
        foreach(PythagorasSquare::$specialityFunction as $key=>$value) {
            $result[$key] = round(($weightsKv[$key] * $pythagorasSquareWeight + $weightsTesting[$key])/$pythagorasSquareWeight, 2);
        }

        return $result;
    }
}

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
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'birth_date'], 'safe'],
        ];
    }

    static function tableName()
    {
        return 'user';
    }

}
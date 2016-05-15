<?php
/**
 * Created by PhpStorm.
 * User: admin_vb
 * Date: 1.4.16
 * Time: 10.46
 */

namespace app\models;
use yii\base\Model;


class SquareForm extends Model
{
    public $birth_date;

    public function rules()
    {
        return [
            // birth_date is required
            ['birth_date', 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'birth_date' => 'Дата рождения',
        ];
    }
}
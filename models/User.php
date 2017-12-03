<?php

namespace app\models;

use Yii;

use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        // add field to scenarios
        $scenarios['create'][]   = 'birthDate';
        $scenarios['update'][]   = 'birthDate';
        $scenarios['register'][] = 'birthDate';
        return $scenarios;
    }

    public function rules()
    {
        $rules = parent::rules();
        // add some rules
        $rules['fieldRequired'] = ['birthDate', 'required'];
        $rules['fieldLength']   = ['birthDate', 'date', 'max' => 10];
        
        return $rules;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: yslepianok
 * Date: 12/15/2016
 * Time: 14:43
 */

namespace app\controllers;
use yii\rest\ActiveController;

class TestingresultsController extends ActiveController
{
    public $modelClass = 'app\models\UserToTesting';
}
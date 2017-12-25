<?php

namespace app\models;

use Yii;
use dektrium\user\models\Profile;
use dektrium\user\models\RegistrationForm as BaseRegistrationForm;
use dektrium\user\models\User;

/**
 * LoginForm is the model behind the login form.
 */
class RegistrationForm extends BaseRegistrationForm
{
  /**
   * @var date Birth Date
   */
  public $birthDate;
  /*
   * @inheritdoc
   */
  public function rules()
  {
      $rules = parent::rules();
      $rules['birthDateRequired'] = ['birthDate', 'required'];
      $rules['birthDateLength']   = ['birthDate', 'date', 'max' => 10];
      return $rules;
  }

  /**
 * @inheritdoc
 */
  public function attributeLabels()
  {
      $labels = parent::attributeLabels();
      $labels['birthDate'] = \Yii::t('user', 'BirthDate');
      return $labels;
  }

  /**
   * @inheritdoc
   */
  public function loadAttributes(User $user)
  {
      // here is the magic happens
      $user->setAttributes([
          'email'    => $this->email,
          'username' => $this->username,
          'password' => $this->password,
      ]);
      /** @var Profile $profile */
      $profile = \Yii::createObject(Profile::className());
      $profile->setAttributes([
          'birthDate' => $this->birthDate,
      ]);
      $user->setProfile($profile);
  }
}

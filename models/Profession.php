<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profession".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $specialityId
 * @property string $main_cell_1
 * @property string $main_cell_2
 * @property string $additional_cell_1
 * @property string $additional_cell_2
 * @property string $additional_cell_3
 * @property string $additional_cell_4
 * @property string $additional_cell_5
 * @property string $additional_cell_6
 * @property integer $boss_flags
 *
 * @property ActivityType $speciality
 */
class Profession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profession';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['specialityId', 'boss_flags'], 'integer'],
            [['name'], 'string', 'max' => 250],
            [['main_cell_1', 'main_cell_2', 'additional_cell_1', 'additional_cell_2', 'additional_cell_3', 'additional_cell_4', 'additional_cell_5', 'additional_cell_6'], 'string', 'max' => 4]
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
            'specialityId' => 'Speciality ID',
            'main_cell_1' => 'Main Cell 1',
            'main_cell_2' => 'Main Cell 2',
            'additional_cell_1' => 'Additional Cell 1',
            'additional_cell_2' => 'Additional Cell 2',
            'additional_cell_3' => 'Additional Cell 3',
            'additional_cell_4' => 'Additional Cell 4',
            'additional_cell_5' => 'Additional Cell 5',
            'additional_cell_6' => 'Additional Cell 6',
            'boss_flags' => 'Boss Flags',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpeciality()
    {
        return $this->hasOne(ActivityType::className(), ['id' => 'specialityId']);
    }
}

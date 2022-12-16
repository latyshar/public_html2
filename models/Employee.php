<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Employee".
 *
 * @property int $ID_Empl
 * @property string $L_EName
 * @property string $F_EName
 * @property string $M_EName
 * @property string $P_ENumber
 * @property string $Adress
 * @property string $Passport
 * @property string $J_Title
 *
 * @property Registration[] $registrations
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['L_EName', 'F_EName', 'M_EName', 'P_ENumber', 'Adress', 'Passport', 'J_Title'], 'required'],
            [['L_EName', 'F_EName', 'M_EName', 'J_Title'], 'string', 'max' => 40],
            [['P_ENumber', 'Passport'], 'string', 'max' => 20],
            [['Adress'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_Empl' => 'Id Empl',
            'L_EName' => 'L E Name',
            'F_EName' => 'F E Name',
            'M_EName' => 'M E Name',
            'P_ENumber' => 'P E Number',
            'Adress' => 'Adress',
            'Passport' => 'Passport',
            'J_Title' => 'J Title',
        ];
    }

    /**
     * Gets query for [[Registrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrations()
    {
        return $this->hasMany(Registration::className(), ['ID_Empl' => 'ID_Empl']);
    }
}

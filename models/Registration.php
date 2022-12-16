<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Registration".
 *
 * @property int $ID_Reg
 * @property int $ID_Cl
 * @property int $ID_Empl
 * @property int $ID_Serv
 * @property string $Reg_Date
 * @property string $Visit_Date
 *
 * @property Client $cl
 * @property Employee $empl
 * @property Service $serv
 */
class Registration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Registration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_Cl', 'ID_Empl', 'ID_Serv', 'Visit_Date'], 'required'],
            [['ID_Cl', 'ID_Empl', 'ID_Serv'], 'integer'],
            [['Reg_Date', 'Visit_Date'], 'safe'],
            [['ID_Cl'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['ID_Cl' => 'id']],
            [['ID_Serv'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['ID_Serv' => 'ID_Serv']],
            [['ID_Empl'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['ID_Empl' => 'ID_Empl']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_Reg' => 'Id Reg',
            'ID_Cl' => 'Id Cl',
            'ID_Empl' => 'Id Empl',
            'ID_Serv' => 'Id Serv',
            'Reg_Date' => 'Reg Date',
            'Visit_Date' => 'Visit Date',
        ];
    }

    /**
     * Gets query for [[Cl]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCl()
    {
        return $this->hasOne(Client::className(), ['id' => 'ID_Cl']);
    }

    /**
     * Gets query for [[Empl]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpl()
    {
        return $this->hasOne(Employee::className(), ['ID_Empl' => 'ID_Empl']);
    }

    /**
     * Gets query for [[Serv]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServ()
    {
        return $this->hasOne(Service::className(), ['ID_Serv' => 'ID_Serv']);
    }
}

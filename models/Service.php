<?php

namespace app\models;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "Service".
 *
 * @property int $ID_Serv
 * @property string $Serv_Name
 * @property string $opisanie
 * @property int $Serv_Price
 * @property string $image
 *
 * @property Registration[] $registrations
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Serv_Name', 'opisanie', 'Serv_Price', 'image'], 'required'],
            [['Serv_Price'], 'integer'],
            [['Serv_Name'], 'string', 'max' => 20],
            [['opisanie'], 'string', 'max' => 500],
            [['image'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 2*1024*1024, 'skipOnEmpty' => false],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_Serv' => 'Id Serv',
            'Serv_Name' => 'Serv Name',
            'opisanie' => 'Opisanie',
            'Serv_Price' => 'Serv Price',
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[Registrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrations()
    {
        return $this->hasMany(Registration::className(), ['ID_Serv' => 'ID_Serv']);
    }

    public function beforeValidate(){
        $this->image=UploadedFile::getInstanceByName('image');
        return parent::beforeValidate();
    }

}

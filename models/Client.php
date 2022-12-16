<?php

namespace app\models;
use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $fio
 * @property string $phone
 * @property string $dateofbirth
 * @property string $email
 * @property string $password
 * @property string|null $token
 * @property int|null $isadmin
 *
 * @property Registration[] $registrations
 */
class Client extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'phone', 'dateofbirth', 'email', 'password'], 'required'],
            [['dateofbirth'], 'safe'],
            [['isadmin'], 'integer'],
            [['fio'], 'string', 'max' => 60],
            [['phone'], 'string', 'max' => 10],
            [['email'], 'string', 'max' => 40],
            [['password'], 'string', 'max' => 200],
            [['token'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'phone' => 'Phone',
            'dateofbirth' => 'Dateofbirth',
            'email' => 'Email',
            'password' => 'Password',
            'token' => 'Token',
            'isadmin' => 'Isadmin',
        ];
    }

    /**
     * Gets query for [[Registrations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrations()
    {
        return $this->hasMany(Registration::className(), ['ID_Cl' => 'id']);
    }
}

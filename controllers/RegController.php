<?php

namespace app\controllers;

use app\models\Client;
use app\models\Registration;
use app\models\Service;
use yii;
use yii\filters\auth\HttpBearerAuth;

class RegController extends FunctionController
{
    public $modelClass = 'app\models\Registration';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only' => ['create', 'show', 'delete']
        ];
        return $behaviors;
    }

    public function actionCreate()
    {
        $data = Yii::$app->request->post();
        $reg = new Registration($data);
        $reg->ID_Cl = Yii::$app->user->identity->id;
        $reg->ID_Empl = $data['ID_Empl'];
        $reg->ID_Serv = $data['ID_Serv'];
        if (!$reg->validate()) return $this->validation($reg);
        $reg->save(false);
        return $this->send(204, null);
    }


    public function actionShow()
    {
        $reg = Registration::find()->all();
        return $this->send(200, ['data' => ['registration' => $reg]]);
    }


    public function actionDelete($id)
    {
        $reg = Registration::findOne($id);
        //die(Yii::$app->user->identity->isadmin .'hhhh');
        if (!$this->is_admin()) {
            return $this->send(403, ['data' => ['code' => 403, 'message' => 'Действие заблокировано']]);
        } else {
            if (!$reg) return $this->send(404, ['data' => ['code' => 404, 'message' => 'Запись не найдена']]);
            $reg->delete();
            return $this->send(200, ['data' => ['code' => 200, 'message' => 'Запись отменена']]);
        }

    }
}


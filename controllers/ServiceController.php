<?php
namespace app\controllers;
use app\models\Service;
use app\models\Client;
use yii;
use yii\web\UploadedFile;
use yii\filters\auth\HttpBearerAuth;

class ServiceController extends FunctionController
{
    public $modelClass = 'app\models\Service';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only' => ['create', 'delete']
        ];
        return $behaviors;
    }

    public function actionCreate()
    {
        $serv=new Service(Yii::$app->request->post());
        $serv->image=UploadedFile::getInstanceByName('image');
        //die(Yii::$app->user->identity->isadmin .'hhhh');
        if (!$this->is_admin()) return $this->send(403, ['data'=>['code'=>403, 'message'=>'Действие заблокировано']]);
        if (!$serv->validate()) return $this->validation($serv);

        /*Загрузка файлов
            см. руководство Yii2
             https://moodle.pkgh.ru/mod/resource/view.php?id=60175 стр. 358-359
        Для адекватной валидации файла изображения создайте в модели product.php метод beforeValidate()
        */

        $image_name='/photo/serv_photo/'. Yii::$app->getSecurity()->generateRandomString() . '.' . $serv->image->extension;

        $serv->image->saveAs(Yii::$app->basePath.$image_name);
        $serv->image=$image_name;
        $serv->save(false);
        $serv->save(false);
        return $this->send(201, ['data'=>['code'=>201, 'message'=>'Услуга создана']]);
}

    public function actionShow(){
        $services=Service::find()->all();
        return $this->send(200, ['data'=>['services'=>$services]]);
    }


    public function actionDelete($id){
        $dserv=Service::findOne($id);
        //die(Yii::$app->user->identity->isadmin .'hhhh');
            if (!$this->is_admin()) {
                return $this->send(403, ['data'=>['code'=>403, 'message'=>'Действие заблокировано']]);
            }
            else {if (!$dserv) return $this->send(404, ['data' => ['code' => 404, 'message' => 'Услуга не найдена']]);
        $dserv->delete();
        return $this->send(200, ['data' => ['code' => 200, 'message' => 'Услуга удалена']]);}

    }



}
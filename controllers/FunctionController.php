<?php
namespace app\controllers;
use yii\rest\Controller;
use yii\widgets\ActiveForm;
use yii\web\Response;
use Yii;
class FunctionController extends Controller{

    public function send($code, $data){
        $response=$this -> response;
        $response-> format = Response::FORMAT_JSON;
        header('Access-Control-Allow-Origin: *');
        $response->data=$data;
        $response->statusCode=$code;
        return $response;
    }
    public function validation($model){
        $error=['error'=> ['code'=>422, 'message'=>'Validation error',
            'errors'=>ActiveForm::validate($model)]];
        return $this->send(422, $error);
    }

    public function is_admin(){
        if (Yii::$app->user->identity->isadmin==1) return true; else return false;
        /*Через тернарный оператор*/
         //return Yii::$app->client->identity->is_admin==1 ? true : false;
    }
}


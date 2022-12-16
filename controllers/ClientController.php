<?php
namespace app\controllers;
use app\models\Client;
use app\models\LoginForm;
use app\models\Registration;
use yii;
use yii\filters\auth\HttpBearerAuth;

class ClientController extends FunctionController
{
    public $modelClass = 'app\models\Client';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only' => ['account', 'edit', 'admin']
        ];
        return $behaviors;
    }

    public function actionCreate()
    {
        $data = Yii::$app->request->post();
        $user = new Client($data);
        if (!$user->validate()) return $this->validation($user);
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($user->password);
        $user->save(false);

        return $this->send(204, null);
    }


    public function actionAccount()
    {
        $user = Yii::$app->user->identity;
        return $this->send(200, ['data' => ['client' => $user]]);

    }

    public function actionLogin()
    {
        $request = Yii::$app->request->post();//Здесь не объект, а ассоциативный массив
        $loginForm = new LoginForm($request);
        if (!$loginForm->validate()) return $this->validation($loginForm);
        $user = Client::find()->where(['email' => $request['email']])->one();
        if (isset($user) && Yii::$app->getSecurity()->validatePassword($request['password'], $user->password)) {
            $user->token = Yii::$app->getSecurity()->generateRandomString();
            $user->save(false);
            return $this->send(200, ['data' => ['token' => $user->token]]);
        }
        return $this->send(401, ['data' => ['code' => 401, 'message' => 'Неверный email или пароль']]);
    }

    public function actionEdit()
    {
        $phone = Yii::$app->request->getBodyParam('phone');

        $user = Yii::$app->user->identity;
        $user->phone = $phone;
        if (!$user->validate()) return $this->validation($user); //Валидация модели
        $user->save();//Сохранение модели в БД
        return $this->send(200, ['data' => ['code' => 200, 'message' => 'Телефон изменен']]);//Отправка сообщения пользователю
    }

    function actionAdmin()
    {
        if (!$this->is_admin()) {
            return $this->send(403, ['data' => ['code' => 403, 'message' => 'Действие заблокировано']]);
        } else {
        $admin = Client::find()
            ->where(['isadmin' => 1])
            ->orderBy(['fio' => SORT_ASC,])
            ->all();

        return $this->send(200, ['data' => ['admin' => $admin]]);}
    }
}

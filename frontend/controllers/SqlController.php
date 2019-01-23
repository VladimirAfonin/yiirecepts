<?php

namespace frontend\controllers;


use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;

class SqlController extends Controller
{
    /**
     * @throws \yii\db\Exception
     */
    public function actionPrepared()
    {
        $username = \Yii::$app->request->get('username');
        $password = \Yii::$app->request->get('password');

        $passwordHash = md5($password);

        $sql = "SELECT * FROM `user`"
            . " WHERE `username` = :username"
            . " AND `password_hash` = :password LIMIT 1";

        $command = \Yii::$app->db->createCommand($sql);
        $command->bindValue(':username', $username);
        $command->bindValue(':password', $passwordHash);
        $result = $command->queryOne();

        return $this->renderContent($result);
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     * @throws \yii\db\Exception
     */
    public function actionBindParam()
    {
        // first user's data
        $userName = 'Alex';
        $passwordHash = md5('password1');
        $authKey = \Yii::$app->security->generateRandomString();

        $sql = "INSERT INTO `user` (`username`, `password_hash`, `auth_key`) VALUES (:username, :password, :auth_key)";

        // insert first user
        $command = \Yii::$app->db->createCommand($sql);
        $command->bindParam('username', $userName);
        $command->bindParam('password', $passwordHash);
        $command->bindParam('auth_key', $authKey);
        $command->execute();

        // second user's data
        $userName = 'Qiang';
        $passwordHash = md5('password2');
        $authKey = \Yii::$app->security->generateRandomString();

        // insert second user
        $command->execute();

        return $this->renderContent(Html::ul(ArrayHelper::getColumn(User::find()->asArray()->all(), 'username')));
    }
}
<?php

namespace coreb2c\smartadmin;
use yii;
class UserInfo extends Widget {

    public $avatarUrl = '';
    public $username = '';

    public function init() {
        parent::init();
        if ($this->avatarUrl === '') {
            $this->avatarUrl = Yii::$app->request->baseUrl . '/smartadmin/img/avatars/sunny.png';
        }
        if ($this->username === '') {
            $this->username = Yii::$app->user->identity->username;
        }
    }

    public function run() {
        return $this->render('user_info', [
                    'avatarUrl' => $this->avatarUrl,
                    'username' => $this->username,
        ]);
    }

}

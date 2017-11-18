<?php

namespace coreb2c\smartadmin;

use Yii;

class TopMenuProfileLinks extends Widget {

    public $avatarUrl = '';
    public $username = '';
    public $links = [
    ];
    public $logoutUrl = '/auth/logout';

    public function init() {
        parent::init();
        if ($this->avatarUrl === '') {
            $this->avatarUrl = Yii::$app->request->baseUrl . '/smartadmin/img/avatars/male.png';
        }
        if ($this->username === '') {
            $this->username = Yii::$app->user->identity->username;
        }
        if (is_array($this->links) and count($this->links) === 0) {
            $this->links = [
                '/auth/settings/profile' => '<i class="fa fa-user"></i> ' . Yii::t('app', '<u>P</u>rofile'),
                '/auth/settings/account' => '<i class="fa fa-cog"></i> ' . Yii::t('app', 'Settings'),
            ];
        }
    }

    public function run() {
        return $this->render('top_menu_profile_links', [
                    'avatarUrl' => $this->avatarUrl,
                    'username' => $this->username,
                    'links' => $this->links,
                    'logoutUrl' => $this->logoutUrl,
        ]);
    }

}

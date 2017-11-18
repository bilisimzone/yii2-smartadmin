<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
<!-- #MOBILE -->
<!-- Top menu profile link : this shows only when top menu is active -->
<ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
    <li class="">
        <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
            <?php if (isset($avatarUrl)): ?>
                <img src="<?= $avatarUrl; ?>" alt="<?= $username; ?>" class="online" />
            <?php else: ?>
                <?= Html::img(\yii::$app->user->identity->profile->getAvatarUrl(24), ['class' => 'online', 'alt' => $username,]) ?>
            <?php endif; ?>
        </a>
        <ul class="dropdown-menu pull-right">
            <?php foreach ($links as $url => $title): ?>
                <li>
                    <a href="<?= Url::toRoute($url) ?>" class="padding-10 padding-top-0 padding-bottom-0"><?= $title; ?></a>
                </li>
                <li class="divider"></li>
            <?php endforeach; ?>
            <li>
                <a href="<?= Url::toRoute($logoutUrl) ?>" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout" data-logout-msg="<?= Yii::t('app', 'You can improve your security further after logging out by closing this opened browser') ?>"><i class="fa fa-sign-out fa-lg"></i> <strong><?= Yii::t('app', '<u>L</u>ogout') ?></strong></a>
            </li>
        </ul>
    </li>
</ul>
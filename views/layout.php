<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use coreb2c\smartadmin\Alert;
use coreb2c\smartadmin\Navigation;
use coreb2c\smartadmin\LanguageDropdown;
use coreb2c\smartadmin\FullscreenButton;
use coreb2c\smartadmin\CollapseMenuButton;
use coreb2c\smartadmin\TopMenuProfileLinks;
use coreb2c\smartadmin\UserInfo;

AppAsset::register($this);
$is_extra_page = ((Yii::$app->user->isGuest));
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <title><?= Html::encode($this->title) ?> - <?= Yii::$app->name ?></title>
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body class="menu-on-top container" id="<?php echo ($is_extra_page) ? 'extr-page' : '' ?>">
        <?php $this->beginBody() ?>
        <!-- #HEADER -->
        <header id="header" class="<?php echo (Yii::$app->user->isGuest) ? "text-center" : "" ?>">
            <div id="logo-group" class="<?php echo (Yii::$app->user->isGuest) ? "float-none" : "" ?>">

                <!-- PLACE YOUR LOGO HERE -->
                <span id="logo"> <img src="<?= Yii::$app->request->baseUrl ?>/smartadmin/img/logo.png" alt="<?= Yii::$app->name ?>"> </span>
                <!-- END LOGO PLACEHOLDER -->
            </div>
            <?php if (Yii::$app->user->isGuest === false): ?>
                <!-- #TOGGLE LAYOUT BUTTONS -->
                <!-- pulled right: nav area -->
                <div class="pull-right">

                    <?= CollapseMenuButton::widget([]); ?>

                    <?= TopMenuProfileLinks::widget(['avatarUrl' => null]); ?>

                    <!-- logout button -->
                    <div id="logout" class="btn-header transparent pull-right">
                        <span> <a href="login.html" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
                    </div>
                    <!-- end logout button -->

                    <?= FullscreenButton::widget([]); ?>

                    <?=
                    LanguageDropdown::widget([
                        'languages' => Yii::$app->params['languages'],
                        'activeLanguage' => Yii::$app->params['languages'][Yii::$app->language],
                    ]);
                    ?>

                </div>
                <!-- end pulled right: nav area -->
            <?php endif; ?>

        </header>
        <!-- END HEADER -->
        <?php if (Yii::$app->user->isGuest === false): ?>
            <!-- #NAVIGATION -->
            <!-- Left panel : Navigation area -->
            <!-- Note: This width of the aside area can be adjusted through LESS variables -->
            <aside id="left-panel">
                <?= UserInfo::widget([]); ?>
                <?= Navigation::widget([]); ?>
            </aside>
            <!-- END NAVIGATION -->
        <?php endif; ?>
        <!-- MAIN PANEL -->
        <div id="main" role="main">
            <?php if (Yii::$app->user->isGuest === false): ?>
                <!-- RIBBON -->
                <div id="ribbon">

                    <span class="ribbon-button-alignment"> 
                        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
                            <i class="fa fa-refresh"></i>
                        </span> 
                    </span>

                    <!-- breadcrumb -->
                    <?=
                    Breadcrumbs::widget([
                        'homeLink' => false,
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    <!-- end breadcrumb -->

                </div>
                <!-- END RIBBON -->
            <?php endif; ?>


            <!-- MAIN CONTENT -->
            <div id="content">
                <?php if (count(($flashes = Yii::$app->session->getAllFlashes())) > 0): ?>
                    <div  id="alerts" class="row">
                        <div class="col-xs-12">
                            <?php foreach ($flashes as $type => $message): ?>
                                <?php if (in_array($type, ['success', 'danger', 'warning', 'info'])): ?>
                                    <?=
                                    Alert::widget([
                                        'options' => ['class' => 'alert-dismissible alert-' . $type],
                                        'body' => $message
                                    ])
                                    ?>
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endif; ?>
                <!--
                        The ID "widget-grid" will start to initialize all widgets below 
                        You do not need to use widgets if you dont want to. Simply remove 
                        the <section></section> and you can use wells or panels instead 
                -->
                <section id="widget-grid">
                    <div class="row">
                        <?php echo $content; ?>
                    </div>
                </section>
            </div>
            <!-- END MAIN CONTENT -->

        </div>
        <!-- END MAIN PANEL -->

        <!-- PAGE FOOTER -->
        <div class="page-footer">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <span class="txt-color-white"><?= Yii::$app->name ?><span class="hidden-xs"> - <?= Yii::t('app', 'Web Application Framework') ?></span> © 2017</span>
                </div>
            </div>
        </div>
        <!-- END PAGE FOOTER -->
        <!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
                Note: These tiles are completely responsive,
                you can add as many as you like
        -->
        <div id="shortcut">
            <ul>
                <li>
                    <a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
                </li>
            </ul>
        </div>
        <!-- END SHORTCUT AREA -->
        <!--================================================== -->
        <?php
        $this->registerJs(
                "$(document).ready(function () {pageSetUp();});", yii\web\View::POS_READY, 'page-setup'
        );
        ?>
        <?php $this->endBody() ?>
        <script>
            if (!window.jQuery) {
                document.write('<script src="<?= Yii::$app->request->baseUrl ?>/smartadmin/js/libs/jquery-2.1.1.min.js"><\/script>');
            }
        </script>
        <script>
            if (!window.jQuery.ui) {
                document.write('<script src="<?= Yii::$app->request->baseUrl ?>/smartadmin/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
            }
        </script>
    </body>

</html>
<?php $this->endPage() ?>
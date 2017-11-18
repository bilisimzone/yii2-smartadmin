<?php

use yii\helpers\Url;
?>
<!-- multiple lang dropdown : find all flags in the flags page -->
<ul class="header-dropdown-list">
    <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php if (isset($activeLanguage['flag'])): ?><img src="<?= Yii::$app->request->baseUrl ?>/smartadmin/img/blank.gif" class="flag flag-<?= $activeLanguage['flag'] ?>" alt="<?= $activeLanguage['name'] ?>"><?php endif; ?> <span class="hidden-xs"> <?= $activeLanguage['name'] ?> </span> <i class="fa fa-angle-down"></i> </a>
        <ul class="dropdown-menu pull-right">
            <?php foreach ($languages as $key => $language) { ?>
                <li class="<?php echo ($activeLanguage['name'] == $language['name']) ? 'active' : '' ?>">
                    <a href="<?= Url::current(['lang' => $key]); ?>"><?php if (isset($language['flag'])): ?><img src="<?= Yii::$app->request->baseUrl ?>/smartadmin/img/blank.gif" class="flag flag-<?= $language['flag'] ?>" alt="<?= $language['name'] ?>"><?php endif; ?> <?= $language['name'] ?></a>
                </li>
            <?php } ?>
        </ul>
    </li>
</ul>
<!-- end multiple lang -->
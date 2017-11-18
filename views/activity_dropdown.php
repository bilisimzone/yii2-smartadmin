<?php
/* @var $this coreb2c\smartadmin\ActivityDropdown */
?>
<!-- Note: The activity badge color changes when clicked and resets the number to 0
Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
<span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge"> 21 </b> </span>

<!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
<div class="ajax-dropdown">

    <!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
    <div class="btn-group btn-group-justified" data-toggle="buttons">
        <?php if ($enableMessages): ?>
            <label class="btn btn-default">
                <input type="radio" name="activity" id="<?= $messagesUrl ?>">
                <?=Yii::t('app', 'Messages')?> <?php if (isset($messagesCount) and is_numeric($messagesCount)): ?>(<?= $messagesCount ?>)<?php endif; ?> </label>
        <?php endif; ?>
        <?php if ($enableNotifications): ?>
            <label class="btn btn-default">
                <input type="radio" name="activity" id="<?= $notificationsUrl ?>">
                <?=Yii::t('app', 'Notifications')?> <?php if (isset($notificationsCount) and is_numeric($notificationsCount)): ?>(<?= $notificationsCount ?>)<?php endif; ?> </label>
        <?php endif; ?>
        <?php if ($enableTasks): ?>
            <label class="btn btn-default">
                <input type="radio" name="activity" id="<?= $tasksUrl ?>">
                <?=Yii::t('app', 'Tasks')?> <?php if (isset($tasksCount) and is_numeric($tasksCount)): ?>(<?= $tasksCount ?>)<?php endif; ?> </label>
        <?php endif; ?>
    </div>

    <!-- notification content -->
    <div class="ajax-notifications custom-scroll">

        <div class="alert alert-transparent">
            <h4>Click a button to show messages here</h4>
            This blank page message helps protect your privacy, or you can show the first message here automatically.
        </div>

        <i class="fa fa-lock fa-4x fa-border"></i>

    </div>
    <!-- end notification content -->

    <!-- footer: refresh area -->
    <span> Last updated on: 12/12/2013 9:43AM
        <button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
            <i class="fa fa-refresh"></i>
        </button> </span>
    <!-- end footer -->

</div>
<!-- END AJAX-DROPDOWN -->
<?php

namespace coreb2c\smartadmin;

class ActivityDropdown extends Widget {

    public $enableMessages = true;
    public $enableNotifications = false;
    public $enableTasks = false;
    public $messagesUrl = '';
    public $notificationsUrl = '';
    public $tasksUrl = '';

    public function run() {
        return $this->render('activity_dropdown', [
                    'enableMessages' => $this->enableMessages,
                    'enableNotifications' => $this->enableNotifications,
                    'enableTasks' => $this->enableTasks,
                    'messagesUrl' => $this->messagesUrl,
                    'notificationsUrl' => $this->notificationsUrl,
                    'tasksUrl' => $this->tasksUrl,
        ]);
    }

}

<?php
namespace coreb2c\smartadmin;

use yii\bootstrap\Alert as BaseAlert;
use yii\helpers\Html;
class Alert extends BaseAlert
{

    /**
     * Renders the widget.
     * Only '$this->registerPlugin('alert');' line is removed
     */
    public function run()
    {
        echo "\n" . $this->renderBodyEnd();
        echo "\n" . Html::endTag('div');

    }
}

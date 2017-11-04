<?php
/**
 * @link http://www.coreb2c.com/
 * @copyright Copyright (c) 2008 CoreB2C
 * @license https://github.com/coreb2c/yii2-smartadmin/blob/master/LICENSE.md/
 */

namespace coreb2c\smartadmin;

/**
 * \yii\bootstrap\Widget is the base class for all smartadmin widgets.
 *
 * @author Abdullah Tulek <abdullah.tulek@coreb2c.com>
 */
class Widget extends \yii\base\Widget
{
    use SAWidgetTrait;

    /**
     * @var array the HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];
}

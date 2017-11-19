<?php

namespace coreb2c\smartadmin;

use yii\helpers\ArrayHelper;

class SAActiveForm extends \yii\widgets\ActiveForm {

    /**
     * @var string the default field class name when calling [[field()]] to create a new field.
     * @see fieldConfig
     */
    public $fieldClass = 'coreb2c\smartadmin\SAActiveField';

    public function init() {
        parent::init();
        $this->options['class'] = ArrayHelper::getValue($this->options, 'class', 'sa-form');
    }

}

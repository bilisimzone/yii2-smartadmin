<?php

namespace coreb2c\smartadmin;


class SAActiveField extends \yii\widgets\ActiveField {

    public $options = ['class' => null];
    public function radio($options = array(), $enclosedByLabel = true) {
        if (!isset($options['labelOptions']) or ! isset($options['labelOptions']['class'])) {
            $options['labelOptions']['class'] = 'radio-inline';
        }
        $options['class'] = \yii\helpers\ArrayHelper::getValue($options, 'class', 'radiobox style-0');
        if (count(array_intersect(['style-0', 'style-1', 'style-2', 'style-3',], explode(' ', str_replace('  ', ' ', $options['class'])))) > 0) {
            $options['label'] = '<span>' . $this->model->getAttributeLabel($this->attribute) . '</span>';
        }
        parent::radio($options, $enclosedByLabel);
    }
    public function dropDownList($items, $options = array()) {
        return parent::dropDownList($items, $options);
    }
    public function checkbox($options = array(), $enclosedByLabel = true) {
        if (!isset($options['labelOptions']) or ! isset($options['labelOptions']['class'])) {
            $options['labelOptions']['class'] = 'checkbox-inline';
        }
        $options['class'] = \yii\helpers\ArrayHelper::getValue($options, 'class', 'checkbox style-0');
        if (count(array_intersect(['style-0', 'style-1', 'style-2', 'style-3',], explode(' ', str_replace('  ', ' ', $options['class'])))) > 0) {
            $options['label'] = '<span>' . $this->model->getAttributeLabel($this->attribute) . '</span>';
        }
        return parent::checkbox($options, $enclosedByLabel);
    }
}

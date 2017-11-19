<?php

namespace coreb2c\smartadmin;
use yii\helpers\ArrayHelper;

class SAActiveField extends \yii\widgets\ActiveField {

    public $options = ['class' => null];

    public function radio($options = array(), $enclosedByLabel = true) {
        if (!isset($options['labelOptions']) or ! isset($options['labelOptions']['class'])) {
            $options['labelOptions']['class'] = 'radio-inline';
        }
        $options['class'] = ArrayHelper::getValue($options, 'class', 'radiobox style-0');
        if (count(array_intersect(['style-0', 'style-1', 'style-2', 'style-3',], explode(' ', str_replace('  ', ' ', $options['class'])))) > 0) {
            $options['label'] = '<span>' . $this->model->getAttributeLabel($this->attribute) . '</span>';
        }
        parent::radio($options, $enclosedByLabel);
    }

    /**
     * Renders a list of radio buttons.
     * A radio button list is like a checkbox list, except that it only allows single selection.
     * The selection of the radio buttons is taken from the value of the model attribute.
     * @param array $items the data item used to generate the radio buttons.
     * The array values are the labels, while the array keys are the corresponding radio values.
     * @param array $options options (name => config) for the radio button list.
     * For the list of available options please refer to the `$options` parameter of [[\yii\helpers\Html::activeRadioList()]].
     * @return $this the field object itself.
     */
    public function radioList($items, $options = []) {
        $options['itemOptions'] = ArrayHelper::getValue($options, 'itemOptions', []);
        $options['itemOptions']['labelOptions'] = ArrayHelper::getValue($options['itemOptions'], 'labelOptions', []);
        $options['itemOptions']['class'] = ArrayHelper::getValue($options['itemOptions'], 'class', 'radiobox style-0');
        $options['itemOptions']['labelOptions']['class'] = ArrayHelper::getValue($options['itemOptions']['labelOptions'], 'class', 'radio radio-inline no-margin');
        $options['encode'] = ArrayHelper::getValue($options, 'encode', false);
        foreach ($items as $key => $value) {
            $items[$key] = '<span>' . $value . '</span>';
        }
        return parent::radioList($items, $options);
    }

    public function dropDownList($items, $options = array()) {
        return parent::dropDownList($items, $options);
    }

    public function checkbox($options = array(), $enclosedByLabel = true) {
        if (!isset($options['labelOptions']) or ! isset($options['labelOptions']['class'])) {
            $options['labelOptions']['class'] = 'checkbox-inline';
        }
        $options['class'] = ArrayHelper::getValue($options, 'class', 'checkbox style-0');
        if (count(array_intersect(['style-0', 'style-1', 'style-2', 'style-3',], explode(' ', str_replace('  ', ' ', $options['class'])))) > 0) {
            $options['label'] = '<span>' . $this->model->getAttributeLabel($this->attribute) . '</span>';
        }
        return parent::checkbox($options, $enclosedByLabel);
    }

}

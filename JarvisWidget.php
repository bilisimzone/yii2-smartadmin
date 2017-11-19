<?php

namespace coreb2c\smartadmin;

class JarvisWidget extends Widget {

    public $id = null;
    public $color = 'white';
    private $colors = [
        'white',
        'blue',
        'blueDark',
        'blueLight',
        'darken',
        'green',
        'greenDark',
        'greenLight',
        'magenta',
        'orange',
        'orangeDark',
        'pink',
        'pinkDark',
        'purple',
        'red',
        'redLight',
        'teal',
        'yellow',
    ];
    public $header;
    public $widgetIcon;
    /* widget buttons */
    public $editButton = false;
    public $colorButton = false;
    public $toggleButton = false;
    public $deleteButton = false;
    public $fullscreenButton = false;
    public $customButton = false;
    /////
    public $collapsed = false;
    public $sortable = true;
    public $editBoxContent = '';
    public $toolbars = [];
    public $bodyToolbar = '';
    public $load = null;
    public $footer = '';
    public $padding = true;

    private function getSettings() {

        $buttons = [
        ];
        if ($this->editButton === false) {
            $buttons[] = 'data-widget-editbutton="false"';
        }
        if ($this->colorButton === false) {
            $buttons[] = 'data-widget-colorbutton="false"';
        }
        if ($this->toggleButton === false and $this->collapsed === false) {
            $buttons[] = 'data-widget-togglebutton="false"';
        }
        if ($this->deleteButton === false) {
            $buttons[] = 'data-widget-deletebutton="false"';
        }
        if ($this->fullscreenButton === false) {
            $buttons[] = 'data-widget-fullscreenbutton="false"';
        }
        if ($this->customButton === false) {
            $buttons[] = 'data-widget-custombutton="false"';
        }
        if ($this->collapsed === true) {
            $buttons[] = 'data-widget-collapsed="true"';
        }
        if ($this->sortable === true) {
            $buttons[] = 'data-widget-custombutton="true"';
        }
        return $buttons;
    }

    public function init() {
        parent::init();
        if ($this->id === null) {
            $this->id = uniqid('widget');
        }
        if (!in_array($this->color, $this->colors)) {
            throw new InvalidConfigException(get_class($this) . '::$color must be in (' . implode(',', $this->colors) . ')');
        }
        ob_start();
        // Start widget
        echo '<div class="jarviswidget jarviswidget-color-' . $this->color . '" id="' . $this->id . '"' . (($this->load !== null and $this->load !== false) ? ' data-widget-load="' . $this->load . '" ' : '') . ' ' . implode(' ', $this->getSettings()) . ' data-widget-collapsed="' . ($this->collapsed == true ? 'true' : 'false') . '">';
        echo '<header class="">';
        if ($this->widgetIcon !== false and $this->widgetIcon !== '') {
            echo '<span class="widget-icon"> <i class="' . $this->widgetIcon . '"></i> </span>';
        }
        echo '<h2>';
        echo '<strong>';
        echo $this->header;
        echo '</strong>';
        echo '</h2>';

        // Start toolbars
//        echo "<pre>";
//        var_dump($this->toolbars);
//        echo "</pre>";
//        exit;
        foreach ($this->toolbars as $toolbar) {
            echo '<div class="widget-toolbar">';
            echo $toolbar;
            echo '</div>';
        }
        // End toolbars
        echo '</header>';
        // Start widget div
        echo '<div>';

        if ($this->editButton === true) {
            // Start widget edit box
            echo '<div class="jarviswidget-editbox">';
            // This area used as dropdown edit box
            echo $this->editBoxContent;
            echo '</div>';
            // End widget edit box
        }
        // 
        // Start widget body
        echo '<div class="widget-body ' . ($this->padding === false ? 'no-padding' : '') . '">';

        // Start widget body toolbar
        if (isset($this->bodyToolbar) and $this->bodyToolbar !== '' and $this->bodyToolbar !== false) {
            echo '<div class="widget-body-toolbar">';
            echo $this->bodyToolbar;
            echo '</div>';
        }
        // End widget body toolbar
    }

    public function run() {
        SAAsset::register($this->getView());
        $content = ob_get_clean();
        echo $content;
        echo '</div>';
        // End widget body
        // Start widget footer
        if (isset($this->footer) and $this->footer != '' and $this->footer !== false) {
            echo '<div class="widget-footer">';
            echo $this->footer;
            echo '</div>';
        }
        // End widget footer
        echo '</div>';
        // End widget div
        echo '</div>';
        // End widget
    }

}

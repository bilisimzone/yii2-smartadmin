<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2017
 * @version   1.8.9
 */

namespace coreb2c\smartadmin;

use yii\web\AssetBundle;

/**
 * Asset bundle used for all Krajee extensions with bootstrap and jquery dependency.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class SAAsset extends AssetBundle {

    public $css = [
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/smartadmin-production-plugins.min.css',
        'css/smartadmin-production.min.css',
        'css/smartadmin-skins.min.css',
        'css/smartadmin-rtl.min.css',
        '//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700',
    ];
    // jquery asset is removed and added to yii\web\JqueryAsset as main js file
    public $js = [
//        '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
        '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js',
        'js/app.config.js',
        'js/plugin/jquery-touch/jquery.ui.touch-punch.min.js',
        'js/bootstrap/bootstrap.min.js',
        'js/notification/SmartNotification.min.js',
        'js/smartwidgets/jarvis.widget.min.js',
        'js/plugin/jquery-validate/jquery.validate.min.js',
        'js/plugin/masked-input/jquery.maskedinput.min.js',
        'js/plugin/select2/select2.min.js',
        'js/plugin/msie-fix/jquery.mb.browser.min.js',
        'js/plugin/fastclick/fastclick.min.js',
        'js/app.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
    ];

    public function init() {
        parent::init();
        $module = \Yii::$app->getModule('smartadmin');
        $this->sourcePath = $module->assetSourcePath;
        $googleMapApiKey = $module->googleMapApiKey;
        if ($googleMapApiKey !== null and $googleMapApiKey !== '') {
            $this->js[] = 'http://maps.googleapis.com/maps/api/js?key=' . $googleMapApiKey;
        }
        $scripts = $module->scripts;
        $styles = $module->styles;
        if(is_array($scripts) && count($scripts)>0){
            foreach($scripts as $script){
                $this->js[] = $script;
            }
        }
        if(is_array($styles) && count($styles)>0){
            foreach($styles as $style){
                $this->css[] = $style;
            }
        }
    }

}

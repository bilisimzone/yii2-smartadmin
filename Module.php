<?php

/**
 * @package   yii2-grid
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2017
 * @version   3.1.7
 */

namespace coreb2c\smartadmin;

use Yii;

/**
 * This module allows global level configurations for the enhanced Krajee [[GridView]]. One can configure the module
 * in their Yii configuration file as shown below:
 *
 * ```php
 * 'modules' => [
 *     'gridview' => [
 *          'class' => 'kartik\grid\Module',
 *          'downloadAction' => '/gridview/export/download' // your grid export download setting
 *     ]
 * ]
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since  1.0
 */
class Module extends \yii\base\Module
{
    use TranslationTrait;
    
    public $assetSourcePath = null;
    public $assetBaseUrl = null;
    /**
     * @var array the the internalization configuration for this widget
     */
    public $i18n = [];

    /**
     * @var string translation message file category name for i18n
     */
    protected $_msgCat = '';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        if(!isset($this->assetSourcePath)){
            throw new InvalidConfigException(get_class($this) . '::$assetSourcePath must be set!');
        }
        $this->initI18N();
    }
}

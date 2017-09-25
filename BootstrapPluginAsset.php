<?php
/**
 * @link http://www.coreb2c.com/
 * @copyright Copyright (c) 2008 CoreB2C
 * @license https://github.com/coreb2c/yii2-smartadmin/blob/master/LICENSE.md/
 */

namespace yii\bootstrap;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Twitter bootstrap javascript files.
 *
 * 
 * @since 2.0
 */
class BootstrapPluginAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist';
    public $js = [
        'js/bootstrap.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

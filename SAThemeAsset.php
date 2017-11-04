<?php
/**
 * @link http://www.coreb2c.com/
 * @copyright Copyright (c) 2008 CoreB2C
 * @license https://github.com/coreb2c/yii2-smartadmin/blob/master/LICENSE.md/
 */

namespace coreb2c\smartadmin;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Twitter bootstrap default theme.
 *
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class SAThemeAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist';
    public $css = [
        'css/bootstrap-theme.css',
    ];
    public $depends = [
        'yii\bootstrap\SAAsset',
    ];
}

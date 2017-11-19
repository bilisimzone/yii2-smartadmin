<?php

/**
 * @copyright Copyright (c) 2014 Serhiy Vinichuk
 * @license MIT
 * @author Serhiy Vinichuk <serhiyvinichuk@gmail.com>
 */

namespace coreb2c\smartadmin;

use yii\web\AssetBundle;

class DataTableAsset extends AssetBundle {

    const STYLING_DEFAULT = 'default';
    const STYLING_BOOTSTRAP = 'bootstrap';
    const STYLING_JUI = 'jqueryui';

    public $styling = self::STYLING_DEFAULT;
    public $fontAwesome = false;
    public $basePath = '@webroot/smartadmin';
    public $baseUrl = '@web/smartadmin';
    public $js = [
        "js/plugin/datatables/jquery.dataTables.min.js",
        "js/plugin/datatables/dataTables.colVis.min.js",
        "js/plugin/datatables/dataTables.tableTools.min.js",
        "js/plugin/datatables/dataTables.bootstrap.min.js",
        "js/plugin/datatable-responsive/datatables.responsive.min.js",
    ];
    public $depends = [
        'coreb2c\smartadmin\SAAsset',
    ];
}

<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace coreb2c\smartadmin;

use yii\helpers\Html;

/**
 * DataColumn is the default column type for the [[GridView]] widget.
 *
 * It is used to show data columns and allows [[enableSorting|sorting]] and [[filter|filtering]] them.
 *
 * A simple data column definition refers to an attribute in the data model of the
 * GridView's data provider. The name of the attribute is specified by [[attribute]].
 *
 * By setting [[value]] and [[label]], the header and cell content can be customized.
 *
 * A data column differentiates between the [[getDataCellValue|data cell value]] and the
 * [[renderDataCellContent|data cell content]]. The cell value is an un-formatted value that
 * may be used for calculation, while the actual cell content is a [[format|formatted]] version of that
 * value which may contain HTML markup.
 *
 * For more details and usage information on DataColumn, see the [guide article on data widgets](guide:output-data-widgets).
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DataColumn extends \yii\grid\DataColumn {

    public function renderFilterCell() {
        return Html::tag('th', $this->renderFilterCellContent(), $this->filterOptions);
    }

}

<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace coreb2c\smartadmin;

use yii\grid\GridView as YiiGridView;
/**
 * The GridView widget is used to display data in a grid.
 *
 * It provides features like [[sorter|sorting]], [[pager|paging]] and also [[filterModel|filtering]] the data.
 *
 * A basic usage looks like the following:
 *
 * ```php
 * <?= GridView::widget([
 *     'dataProvider' => $dataProvider,
 *     'columns' => [
 *         'id',
 *         'name',
 *         'created_at:datetime',
 *         // ...
 *     ],
 * ]) ?>
 * ```
 */
class GridView extends YiiGridView {

    /**
     * Runs the widget.
     */
    public function run()
    {
        parent::run();
        $id = $this->options['id'];
        $view = $this->getView();
//        $view->registerJs('$("body").on("keyup.yiiGridView", "#'.$id.' .filters input", function(){
//            $("#'.$id.'").yiiGridView("applyFilter");
//        })', \yii\web\View::POS_READY);
        
    }
    public function init() {
        parent::init();
    }

}

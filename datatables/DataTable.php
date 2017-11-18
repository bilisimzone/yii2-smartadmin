<?php

namespace coreb2c\smartadmin;

use yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use coreb2c\smartadmin\DataColumn;

class DataTable extends \yii\grid\GridView {

    /**
     * @var array the HTML attributes for the container tag of the datatables view.
     * The "tag" element specifies the tag name of the container element and defaults to "div".
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @var array the HTML attributes for the datatables table element.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $tableOptions = ["class" => "table table-striped table-bordered", "cellspacing" => "0", "width" => "100%"];

    /**
     * @var array the HTML attributes for the datatables table element.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $clientOptions = ['tableTools' => []];
    public $autoWidth = true;
    public $pageSize = 5;
    public $pagination = true;
    public $responsive = true;
    public $info = true;
    public $enableSearch = true;
    public $enableTableTools = true;
    public $enableShowHideColumn = false;
    public $lengthMenu = [];

    /**
     * Initializes the datatables widget disabling some GridView options like 
     * search, sort and pagination and using DataTables JS functionalities 
     * instead.
     */
    public function init() {
        parent::init();
        $this->filterPosition = self::FILTER_POS_HEADER;
        //disable sort by grid view
        $this->dataProvider->sort = false;
        //disable pagination by grid view
        $this->dataProvider->pagination = false;
        //layout showing only items
        $this->layout = "{items}";
        //the table id must be set
        if (!isset($this->tableOptions['id'])) {
            $this->tableOptions['id'] = 'datatable_' . $this->getId();
        }
        $this->lengthMenu = [[$this->pageSize, 10, 25, 50, -1], [$this->pageSize, 10, 25, 50, Yii::t('app', "All")]];
    }

    /**
     * Runs the widget.
     */
    public function run() {
        $clientOptions = $this->getClientOptions();
        $view = $this->getView();
        $id = $this->tableOptions['id'];

        //DataTable Asset by default
        $dataTableAsset = DataTableAsset::register($view);

        //TableTools Asset if needed
        if (isset($clientOptions["tableTools"]) || (isset($clientOptions["dom"]) && strpos($clientOptions["dom"], 'T') >= 0)) {
            //SWF copy and download path overwrite
            $clientOptions["tableTools"]["sSwfPath"] = $dataTableAsset->baseUrl . "/js/plugin/datatables/swf/copy_csv_xls_pdf.swf";
        }
        $options = Json::encode($clientOptions);
        $view->registerJs(""
                . "var responsiveHelper_$id = undefined;"
                . "var breakpointDefinition = {tablet : 1024,phone : 480};"
                . "var ftable_$id = $('#$id').DataTable($options);"
                . "$('#$id thead tr#" . $this->getId() . "-filters input[type=text]').on( 'keyup change', function () { "
                . "ftable_$id.column( $(this).parent().index()+':visible' ).search( this.value ).draw();  "
                . "});"
                . "$('#$id thead tr#" . $this->getId() . "-filters select').on( 'change', function () { "
                . "ftable_$id.column( $(this).parent().index()+':visible' ).search( this.value ).draw();  "
                . "});"
                . "");
        //base list view run
        if ($this->showOnEmpty || $this->dataProvider->getCount() > 0) {
            $content = preg_replace_callback("/{\\w+}/", function ($matches) {
                $content = $this->renderSection($matches[0]);

                return $content === false ? $matches[0] : $content;
            }, $this->layout);
        } else {
            $content = $this->renderEmpty();
        }
        $tag = ArrayHelper::remove($this->options, 'tag', 'div');
//        echo $content;
        echo Html::tag($tag, $content, $this->options);
    }

    /**
     * Returns the options for the datatables view JS widget.
     * @return array the options
     */
    protected function getClientOptions() {
        $view = $this->getView();
        $id = $this->tableOptions['id'];
        $this->clientOptions['info'] = $this->info === true;
        $this->clientOptions['autoWidth'] = $this->autoWidth === true;
        $this->clientOptions['paging'] = $this->pagination === true;
        $this->clientOptions['responsive'] = $this->responsive === true;
        if ($this->pagination === true) {
            $this->clientOptions['lengthMenu'] = $this->lengthMenu;
        }
        $this->clientOptions['columns'] = [];
        $raw_column_cnt = 0;
        $action_column_cnt = 0;
        foreach ($this->columns as $column) {
            if ($column instanceof \yii\grid\DataColumn and $column->format !== 'raw') {
                $this->clientOptions['columns'][] = ['name' => $column->attribute];
            } elseif ($column instanceof \yii\grid\ActionColumn) {
                $this->clientOptions['columns'][] = ['name' => 'action_column' . ( ++$action_column_cnt)];
            } elseif ($column instanceof \yii\grid\DataColumn and $column->format == 'raw') {
                $this->clientOptions['columns'][] = ['name' => 'raw_column_' . ( ++$raw_column_cnt)];
            }
        }
        if ($this->enableTableTools === true) {
            $aButtons = [
                [
                    "sExtends" => "xls",
                    "oSelectorOpts" => ["page" => 'all'],
                    "sTitle" => $view->title . "-" . date('YmdGis') . '-' . Yii::$app->name,
                    "sPdfMessage" => $view->title . "-" . date('YmdGis') . '-' . Yii::$app->name,
                ],
                [
                    "sExtends" => "pdf",
                    "sButtonText" => Yii::t('app', "PDF"),
                    "sTitle" => $view->title . "-" . date('YmdGis') . '-' . Yii::$app->name,
                    "sPdfMessage" => $view->title . "-" . date('YmdGis') . '-' . Yii::$app->name,
                ],
                [
                    "sExtends" => "print",
                    "sButtonText" => Yii::t('app', "Print"),
                    "sMessage" => $view->title . " - " . date('Y-m-d G:i') . ' | ' . Yii::$app->name . ' <i>(' . Yii::t('app', 'press Esc to close') . ')</i>',
                ],
            ];
            if (ArrayHelper::keyExists('tableTools', $this->clientOptions)) {
                $this->clientOptions['tableTools']['aButtons'] = ArrayHelper::getValue($this->clientOptions['tableTools'], 'aButtons', $aButtons);
            } else {
                $this->clientOptions['tableTools']['aButtons'] = $aButtons;
            }
        }
        $this->clientOptions['oLanguage'] = ArrayHelper::getValue($this->clientOptions, 'oLanguage', [
                    "sInfo" => Yii::t('app', 'Showing _START_ to _END_ of _TOTAL_ entries'),
                    "sInfoEmpty" => Yii::t('app', 'No data available'),
                    "sZeroRecords" => Yii::t('app', 'No matching records found'),
                    "sInfoFiltered" => Yii::t('app', '(Total _MAX_ searched)'),
                    "sLengthMenu" => "_MENU_",
                    "oPaginate" => [
                        "sFirst" => Yii::t('app', 'First'),
                        "sLast" => Yii::t('app', 'Last'),
                        "sNext" => Yii::t('app', 'Next'),
                        "sPrevious" => Yii::t('app', 'Previous'),
                    ],
                    "sSearch" => '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        ]);
        $this->clientOptions['colVis'] = ArrayHelper::getValue($this->clientOptions, 'colVis', [
                    "buttonText" => Yii::t('app', 'Show/Hide Columns'),
        ]);
        $this->clientOptions['preDrawCallback'] = ArrayHelper::getValue($this->clientOptions, 'preDrawCallback', new JsExpression('function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_' . $id . ') {
                        responsiveHelper_' . $id . ' = new ResponsiveDatatablesHelper($("#' . $id . '"), breakpointDefinition);
                }
        }'));
        $this->clientOptions['rowCallback'] = ArrayHelper::getValue($this->clientOptions, 'rowCallback', new JsExpression('function(nRow) {responsiveHelper_' . $id . '.createExpandIcon(nRow);}'));
        $this->clientOptions['drawCallback'] = ArrayHelper::getValue($this->clientOptions, 'drawCallback', new JsExpression('function(oSettings) {responsiveHelper_' . $id . '.respond();}'));
        $domObject = "t";
        if ($this->enableTableTools === true) {
            $domObject = "<'dt-toolbar'<'col-sm-6 col-xs-12 hidden-xs'><'col-sm-6 col-xs-12 margin-bottom-5'T>r>" . $domObject;
        }
        if ($this->enableSearch === true or $this->enableShowHideColumn === true or $this->pagination === true) {
            $domObject = "<'dt-toolbar'<'col-xs-12 col-sm-6" . ($this->enableSearch === true ? "'f" : " hidden-xs hidden-sm'") . "><'col-sm-6 col-xs-6'" . ($this->pagination === true ? "l" : "") . ($this->enableShowHideColumn === true ? "C" : "") . ">r>" . $domObject;
        }
        if ($this->info === true or $this->pagination === true) {
            $domObject = $domObject . "<'dt-toolbar-footer'<'col-sm-6 col-xs-12" . ($this->info === true ? "'i" : " hidden-xs hidden-sm'") . "><'col-sm-6 col-xs-12" . ($this->pagination === true ? "'p" : " hidden-xs hidden-sm'") . ">>";
        }
        $this->clientOptions['sDom'] = ArrayHelper::getValue($this->clientOptions, 'sDom', $domObject);
        return $this->clientOptions;
    }

    /**
     * Creates column objects and initializes them.
     */
    protected function initColumns() {
        if (empty($this->columns)) {
            $this->guessColumns();
        }
        foreach ($this->columns as $i => $column) {
            if (is_string($column)) {
                $column = $this->createDataColumn($column);
            } else {
                $column = Yii::createObject(array_merge([
                            'class' => $this->dataColumnClass ? : DataColumn::className(),
                            'grid' => $this,
                                        ], $column));
            }
            if (!$column->visible) {
                unset($this->columns[$i]);
                continue;
            }
            $this->columns[$i] = $column;
        }
    }

    public function renderTableBody() {
        if (isset($this->clientOptions['serverSide']) and $this->clientOptions['serverSide'] === true) {
            return "<tbody>\n</tbody>";
        }
        $models = array_values($this->dataProvider->getModels());
        if (count($models) === 0) {
            return "<tbody>\n</tbody>";
        } else {
            return parent::renderTableBody();
        }
    }

    /**
     * Renders the filter.
     * @return string the rendering result.
     */
    public function renderFilters() {
        if ($this->filterModel !== null) {
            $cells = [];

            foreach ($this->columns as $column) {
                /* @var $column Column */
                $column->filterOptions['class'] = ArrayHelper::getValue($column->filterOptions, 'class', 'hasinput');
                $cells[] = $column->renderFilterCell();
            }

            $this->filterRowOptions['class'] = '';
            return Html::tag('tr', implode('', $cells), $this->filterRowOptions);
        }

        return '';
    }

    /**
     * Creates a [[DataColumn]] object based on a string in the format of "attribute:format:label".
     * @param string $text the column specification string
     * @return DataColumn the column instance
     * @throws InvalidConfigException if the column specification is invalid
     */
    protected function createDataColumn($text) {
        if (!preg_match('/^([^:]+)(:(\w*))?(:(.*))?$/', $text, $matches)) {
            throw new InvalidConfigException('The column must be specified in the format of "attribute", "attribute:format" or "attribute:format:label"');
        }

        return Yii::createObject([
                    'class' => $this->dataColumnClass ? : DataColumn::className(),
                    'grid' => $this,
                    'attribute' => $matches[1],
                    'format' => isset($matches[3]) ? $matches[3] : 'text',
                    'label' => isset($matches[5]) ? $matches[5] : null,
        ]);
    }

    /**
     * This function tries to guess the columns to show from the given data
     * if [[columns]] are not explicitly specified.
     */
    protected function guessColumns() {
        $models = $this->dataProvider->getModels();
        $model = reset($models);
        if (is_array($model) || is_object($model)) {
            foreach ($model as $name => $value) {
                if ($value === null || is_scalar($value) || is_callable([$value, '__toString'])) {
                    $this->columns[] = (string) $name;
                }
            }
        }
    }

}

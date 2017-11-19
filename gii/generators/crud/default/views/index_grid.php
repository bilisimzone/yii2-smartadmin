<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use coreb2c\smartadmin\DataTable;
use coreb2c\smartadmin\JarvisWidget;

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
function generateLabel($column_name){
    if (!strcasecmp($column_name, 'id')) {
        return 'ID';
    } else {
        $label = Inflector::camel2words($column_name);
        if (!empty($label) && substr_compare($label, ' id', -3, 3, true) === 0) {
            $label = substr($label, 0, -3) . ' ID';
        }
        return $label;
    }
}
?>
<?php
echo "<?php\n";
?>

JarvisWidget::begin([
    'id' => '<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-admin',
    'header' => Html::encode($this->title),
    'widgetIcon' => 'fa fa-table',
    'padding' => false,
    'toolbars' => [
        <?= "<?= " ?>Html::a('<?='<span class="glyphicon glyphicon-plus"></span>';?> ' . <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, ['create'], ['class' => 'btn btn-warning']) ?>
    ],
]);
?>

    <?= "<?= " ?>DataTable::widget([
        'dataProvider' => $dataProvider,
        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
             ?>
        [
            'attribute' => '<?php echo $name; ?>',
            'headerOptions' => [
                <?php if($count==1): ?>'data-class' => 'expand'<?php else: ?>'data-hide' => 'phone,tablet'<?php endif; ?>,
            ],
            'filterInputOptions' => [
                'class' => 'form-control',
                'placeholder' => Yii::t('app', 'Filter <?php echo generateLabel($name) ?>').
            ],
        ],
        <?php
        } else {
            ?>
        //[
        //    'attribute' => '<?php echo $name; ?>',
        //    'headerOptions' => [
        //        'data-hide' => 'phone,tablet',
        //    ],
        //    'filterInputOptions' => [
        //        'class' => 'form-control',
        //       'placeholder' => Yii::t('app', 'Filter <?php echo generateLabel($name) ?>').
        //    ],
        //],
        <?php
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (++$count < 6) {
            ?>
        [
            'attribute' => '<?php echo $column->name . ($format === 'text' ? "" : ":" . $format); ?>',
            'headerOptions' => [
                <?php if($count==1): ?>'data-class' => 'expand'<?php else: ?>'data-hide' => 'phone,tablet'<?php endif; ?>,
            ],
            'filterInputOptions' => [
                'class' => 'form-control',
                'placeholder' => Yii::t('app', 'Filter <?php echo generateLabel($column->name) ?>').
            ],
        ],
        <?php
        } else {
            ?>
        //[
        //    'attribute' => '<?php echo $column->name . ($format === 'text' ? "" : ":" . $format); ?>',
        //    'headerOptions' => [
        //        'data-hide' => 'phone,tablet',
        //    ],
        //    'filterInputOptions' => [
        //        'class' => 'form-control',
        //       'placeholder' => Yii::t('app', 'Filter <?php echo generateLabel($column->name) ?>').
        //    ],
        //],
        <?php
        }
    }
}
?>

        [
            'headerOptions' => [
                'data-hide' => 'phone',
                'style' => 'width: 5%;min-width:70px;'
            ],
            'header' => Yii::t('auth', 'Options'),
            'class' => 'yii\grid\ActionColumn'
        ],
        ],
    ]); ?>
<?php
echo "<?php\n";
?>
JarvisWidget::end(); 
<?php
echo "?>\n";
?>

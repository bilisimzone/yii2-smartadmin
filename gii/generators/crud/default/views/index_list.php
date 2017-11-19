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
use yii\widgets\ListView;
use coreb2c\smartadmin\JarvisWidget;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<article class="col-sm-12 col-md-12 col-lg-12">
<?= "    <?php " ?>echo $this->render('_search', ['model' => $searchModel]); ?>

<?php
echo "<?php\n";
?>

JarvisWidget::begin([
    'id' => '<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-list',
    'header' => Html::encode($this->title),
    'widgetIcon' => 'fa fa-table',
    'padding' => false,
    'toolbars' => [
        Html::a('<?='<span class="glyphicon glyphicon-plus"></span>';?> ' . <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, ['create'], ['class' => 'btn btn-warning']),
    ],
]);
?>
<?= $generator->enablePjax ? "    <?php Pjax::begin(); ?>\n" : '' ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
    ]) ?>
    <?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>
<?php
echo "<?php\n";
?>
JarvisWidget::end(); 
<?php
echo "?>\n";
?>
</article>

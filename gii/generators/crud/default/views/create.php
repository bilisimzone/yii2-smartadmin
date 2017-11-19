<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use coreb2c\smartadmin\JarvisWidget;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
echo "<?php\n";
?>
JarvisWidget::begin([
    'id' => '<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create',
    'header' => Html::encode($this->title),
    'widgetIcon' => 'fa fa-plus',
]);
?>
    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>
<?php
echo "<?php\n";
?>
JarvisWidget::end(); 
<?php
echo "?>\n";
?>

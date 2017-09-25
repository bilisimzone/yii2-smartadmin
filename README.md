<p align="center">
    <h1 align="center">SmartAdmin Template Extension for Yii 2</h1>
    <br>
</p>


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiisoft/yii2-bootstrap
```

or add

```
"yiisoft/yii2-bootstrap": "~2.0.0"
```

to the require section of your `composer.json` file.

Usage
----

For example, the following
single line of code in a view file would render a Bootstrap Progress plugin:

```php
<?= yii\bootstrap\Progress::widget(['percent' => 60, 'label' => 'test']) ?>
```

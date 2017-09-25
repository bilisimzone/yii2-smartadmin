<p align="center">
    <a href="http://getbootstrap.com/" target="_blank" rel="external">
        <img src="https://v4-alpha.getbootstrap.com/assets/brand/bootstrap-solid.svg" height="80px">
    </a>
    <h1 align="center">Twitter Bootstrap Extension for Yii 2</h1>
    <br>
</p>

This is the Twitter Bootstrap extension for [Yii framework 2.0](http://www.yiiframework.com). It encapsulates [Bootstrap](http://getbootstrap.com/) components
and plugins in terms of Yii widgets, and thus makes using Bootstrap components/plugins
in Yii applications extremely easy.

For license information check the [LICENSE](LICENSE.md)-file.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://poser.pugx.org/coreb2c/yii2-smartadmin/v/stable.png)](https://packagist.org/packages/coreb2c/yii2-smartadmin)
[![Total Downloads](https://poser.pugx.org/coreb2c/yii2-smartadmin/downloads.png)](https://packagist.org/packages/coreb2c/yii2-smartadmin)
[![Build Status](https://travis-ci.org/coreb2c/yii2-smartadmin.svg?branch=master)](https://travis-ci.org/coreb2c/yii2-smartadmin)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist coreb2c/yii2-smartadmin
```

or add

```
"coreb2c/yii2-smartadmin": "~2.0.0"
```

to the require section of your `composer.json` file.

Usage
----

For example, the following
single line of code in a view file would render a Bootstrap Progress plugin:

```php
<?= yii\bootstrap\Progress::widget(['percent' => 60, 'label' => 'test']) ?>
```

<?php

namespace coreb2c\smartadmin;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Nav renders a nav HTML component.
 *
 * For example:
 *
 * ```php
 * echo Nav::widget([
 *     'items' => [
 *         [
 *             'label' => 'Home',
 *             'icon' => '<i class="fa fa-lg fa-fw fa-home"></i>',
 *             'url' => ['site/index'],
 *             'linkOptions' => [...],
 *         ],
 *         [
 *             'label' => 'Dropdown',
 *             'items' => [
 *                  ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
 *                  '<li class="divider"></li>',
 *                  '<li class="dropdown-header">Dropdown Header</li>',
 *                  ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
 *             ],
 *         ],
 *         [
 *             'label' => 'Login',
 *             'url' => ['site/login'],
 *             'visible' => Yii::$app->user->isGuest
 *         ],
 *     ],
 *     'options' => ['class' =>'nav-pills'], // set this to nav-tab to get tab-styled navigation
 * ]);
 * ```
 *
 */

/**
 * Menu widget.
 *
 * @author Abdullah Tulek <abdullah.tulek@coreb2c.com>
 */
class Navigation extends Widget {

    /**
     * @inheritdoc
     */
    public $options = [
    ];

    /**
     * @var array list of items in the nav widget. Each array element represents a single
     * menu item which can be either a string or an array with the following structure:
     *
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - visible: boolean, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - active: boolean, optional, whether the item should be on active state or not.
     * - dropDownOptions: array, optional, the HTML options that will passed to the [[Dropdown]] widget.
     * - items: array|string, optional, the configuration array for creating a [[Dropdown]] widget,
     *   or a string representing the dropdown menu. Note that Bootstrap does not support sub-dropdown menus.
     * - encode: boolean, optional, whether the label will be HTML-encoded. If set, supersedes the $encodeLabels option for only this item.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     */
    public $items = [];

    /**
     * @var boolean whether the nav items labels should be HTML-encoded.
     */
    public $encodeLabels = true;

    /**
     * @var boolean whether the minify button enabled.
     */
    public $encodeMinifyButton = true;
    public $minifyButton = '';

    /**
     * @var boolean whether to automatically activate items according to whether their route setting
     * matches the currently requested route.
     * @see isItemActive
     */
    public $activateItems = true;

    /**
     * @var boolean whether to activate parent menu items when one of the corresponding child menu items is active.
     */
    public $activateParents = false;

    /**
     * @var string the route used to determine if a menu item is active or not.
     * If not set, it will use the route of the current request.
     * @see params
     * @see isItemActive
     */
    public $route;

    /**
     * @var array the parameters used to determine if a menu item is active or not.
     * If not set, it will use `$_GET`.
     * @see route
     * @see isItemActive
     */
    public $params;

    /**
     * Initializes the widget.
     */
    public function init() {
        parent::init();
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        $userModuleClass = 'coreb2c\auth\Module';
        $module = \Yii::$app->getModule('auth');
        $isRbacEnabled = $module->enableRbac === true;

        $this->items = [
            [
                'label' => '',
                'icon' => '<i class="fa fa-lg fa-fw fa-home"></i>',
                'url' => \yii\helpers\Url::home(),
                'encode' => false,
            ],
            [
                'label' => \Yii::t('auth', 'Definitions'),
                'items' => [
                    [
                        'label' => \Yii::t('auth', 'Users'),
                        'url' => ['/auth/admin/index'],
                        'items' => [
                            [
                                'label' => \ Yii::t('auth', 'New user'),
                                'url' => ['/auth/admin/create'],
                            ],
                        ],
                    ],
                    [
                        'label' => \Yii::t('auth', 'Authorization'),
                        'visible' => $isRbacEnabled,
                        'items' => [
                            [
                                'label' => \Yii::t('auth', 'Roles'),
                                'url' => ['/auth/rbac/role/index'],
                            ],
                            [
                                'label' => \Yii::t('auth', 'Permissions'),
                                'url' => ['/auth/rbac/permission/index'],
                            ],
                            [
                                'label' => \Yii::t('auth', 'Rules'),
                                'url' => ['/auth/rbac/rule/index'],
                            ],
                            [
                                'label' => \Yii::t('auth', 'Create'),
                                'items' => [
                                    [
                                        'label' => \Yii::t('auth', 'New role'),
                                        'url' => ['/auth/rbac/role/create'],
                                    ],
                                    [
                                        'label' => \Yii::t('auth', 'New permission'),
                                        'url' => ['/auth/rbac/permission/create'],
                                    ],
                                    [
                                        'label' => \Yii::t('auth', 'New rule'),
                                        'url' => ['/auth/rbac/rule/create'],
                                    ]
                                ]
                            ],
                        ],
                    ],
                ]
            ],
        ];
    }

    /**
     * Renders the widget.
     */
    public function run() {
        return Html::tag('nav', $this->renderItems($this->items)) . $this->renderMinifyButton();
    }

    /**
     * Renders widget items.
     */
    public function renderItems($items) {
        $list = [];
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
            $list[] = $this->renderItem($item);
        }

        return Html::tag('ul', implode("\n", $list), $this->options);
    }

    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item) {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $linkIcon = isset($item['icon']) ? $item['icon'] : '';
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', 'javascript:void();');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }

        if (empty($items)) {
            $items = '';
        } else {
            Html::addCssClass($linkOptions, ['widget' => '']);
            if (is_array($items)) {
                $items = $this->isChildActive($items, $active);
                $items = $this->renderItems($items);
            }
        }

        if ($active) {
            Html::addCssClass($options, 'active');
        }

        return Html::tag('li', Html::a($linkIcon . '<span class="menu-item-parent">' . $label . '</span>', $url, $linkOptions) . $items, $options);
    }

    /**
     * 
     * @param type $options
     * @return string
     */
    public function renderMinifyButton() {
        $options = ArrayHelper::getValue($this->options, 'minifyOptions', []);
        if (!isset($options['class'])) {
            $options['class'] = 'minifyMe';
        }
        if (!isset($options['data-action'])) {
            $options['data-action'] = 'minifyMenu';
        }
        if (!isset($options['icon'])) {
            $iconOptions['icon'] = '<i class="fa fa-arrow-circle-left hit"></i>';
        } else {
            $iconOptions['icon'] = $options['icon'];
            unset($options['icon']);
        }
        return Html::tag('span', $iconOptions['icon'], $options);
    }

    /**
     * Check to see if a child item is active optionally activating the parent.
     * @param array $items @see items
     * @param bool $active should the parent be active too
     * @return array @see items
     */
    protected function isChildActive($items, &$active) {
        foreach ($items as $i => $child) {
            if (is_array($child) && !ArrayHelper::getValue($child, 'visible', true)) {
                continue;
            }
            if (ArrayHelper::remove($items[$i], 'active', false) || $this->isItemActive($child)) {
                Html::addCssClass($items[$i]['options'], 'active');
                if ($this->activateParents) {
                    $active = true;
                }
            }
            $childItems = ArrayHelper::getValue($child, 'items');
            if (is_array($childItems)) {
                $activeParent = false;
                $items[$i]['items'] = $this->isChildActive($childItems, $activeParent);
                if ($activeParent) {
                    Html::addCssClass($items[$i]['options'], 'active');
                    $active = true;
                }
            }
        }
        return $items;
    }

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return bool whether the menu item is active
     */
    protected function isItemActive($item) {
        if (!$this->activateItems) {
            return false;
        }
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = $item['url'][0];
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            if (ltrim($route, '/') !== $this->route) {
                return false;
            }
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                $params = $item['url'];
                unset($params[0]);
                foreach ($params as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }

            return true;
        }

        return false;
    }

}

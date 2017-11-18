<?php

/*
 * This file is part of the CoreB2C project.
 *
 * (c) CoreB2C project <http://github.com/coreb2c>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace coreb2c\smartadmin;


/**
 * Menu widget.
 *
 * @author Abdullah Tulek <abdullah.tulek@coreb2c.com>
 */
class Menu extends Nav {

    /**
     * @inheritdoc
     */
    public $options = [
        'class' => 'nav-tabs pull-left in'
    ];

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        $userModuleClass = 'coreb2c\auth\Module';
        $module = \Yii::$app->getModule('auth');
        $isRbacEnabled = $module->enableRbac === true;

        $this->items = [
            [
                'label' => \Yii::t('auth', 'Users'),
                'url' => ['/auth/admin/index'],
            ],
            [
                'label' => \Yii::t('auth', 'Roles'),
                'url' => ['/auth/rbac/role/index'],
                'visible' => $isRbacEnabled,
            ],
            [
                'label' => \Yii::t('auth', 'Permissions'),
                'url' => ['/auth/rbac/permission/index'],
                'visible' => $isRbacEnabled,
            ],
            [
                'label' => \Yii::t('auth', 'Rules'),
                'url' => ['/auth/rbac/rule/index'],
                'visible' => $isRbacEnabled,
            ],
            [
                'label' => \Yii::t('auth', 'Create'),
                'items' => [
                    [
                        'label' => \ Yii::t('auth', 'New user'),
                        'url' => ['/auth/admin/create'],
                    ],
                    [
                        'label' => \Yii::t('auth', 'New role'),
                        'url' => ['/auth/rbac/role/create'],
                        'visible' => $isRbacEnabled,
                    ],
                    [
                        'label' => \Yii::t('auth', 'New permission'),
                        'url' => ['/auth/rbac/permission/create'],
                        'visible' => $isRbacEnabled,
                    ],
                    [
                        'label' => \Yii::t('auth', 'New rule'),
                        'url' => ['/auth/rbac/rule/create'],
                        'visible' => $isRbacEnabled, 
                    ]
                ]
            ],
        ];
    }

}

<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => 'tf_auth_item',               //该表存放授权条目（译者注：即角色和权限）。默认表名为 "auth_item" 。
            'assignmentTable' => 'tf_auth_assignment',     //该表存放授权条目对用户的指派情况。默认表名为 "auth_assignment"。
            'itemChildTable' => 'tf_auth_item_child',      //该表存放授权条目的层次关系。默认表名为 "auth_item_child"。
            'ruleTable' => 'tf_auth_rule',                 //该表存放规则。默认表名为 "auth_rule"。
        ],
    ],
];

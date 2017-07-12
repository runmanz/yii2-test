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
            'itemTable' => 'tf_auth_item',               //�ñ�����Ȩ��Ŀ������ע������ɫ��Ȩ�ޣ���Ĭ�ϱ���Ϊ "auth_item" ��
            'assignmentTable' => 'tf_auth_assignment',     //�ñ�����Ȩ��Ŀ���û���ָ�������Ĭ�ϱ���Ϊ "auth_assignment"��
            'itemChildTable' => 'tf_auth_item_child',      //�ñ�����Ȩ��Ŀ�Ĳ�ι�ϵ��Ĭ�ϱ���Ϊ "auth_item_child"��
            'ruleTable' => 'tf_auth_rule',                 //�ñ��Ź���Ĭ�ϱ���Ϊ "auth_rule"��
        ],
    ],
];

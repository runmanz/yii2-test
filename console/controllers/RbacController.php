<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = yii::$app->authManager;

        //create auth
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        //update auth
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update a post';
        $auth->add($updatePost);

        //delete auth
        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = "Delete a post";
        $auth->add($deletePost);

        //check auth
        $checkPost = $auth->createPermission('checkPost');
        $checkPost->description = 'Check posts';
        $auth->add($checkPost);

        //��ɫ����Ȩ��
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author,$createPost);

        //���¹���Ա
        $artManager = $auth->createRole('artManager');
        $auth->add($artManager);
        $auth->addChild($artManager,$createPost);
        $auth->addChild($artManager,$updatePost);
        $auth->addChild($artManager,$deletePost);

        //�������Ա
        $auditor = $auth->createRole('auditor');
        $auth->add($auditor);
        $auth->addChild($auditor,$checkPost);

        //���²���Ա
        $operation = $auth->createRole('operation');
        $auth->add($operation);
        $auth->addChild($operation,$deletePost);

        //��̨����Ա
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin,$artManager);
        $auth->addChild($admin,$auditor);

        $auth->assign($auditor,3);
        $auth->assign($admin,1);
        $auth->assign($author,2);
        $auth->assign($operation,4);
    }
}
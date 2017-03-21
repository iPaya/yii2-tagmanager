<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 * @license http://ipaya.cn/license
 */

namespace iPayaUnit\tagManager;


use iPaya\tagManager\TagManagerAsset;

class TagManagerAssetTest extends TestCase
{
    public function testAsset()
    {
        \Yii::$app->view->registerAssetBundle(TagManagerAsset::className());

        $output = \Yii::$app->view->renderAjax('@iPayaUnit/tagManager/data/views/layout.php', [
            'content' => ''
        ]);

        static::assertRegExp(
            '~<link href="/assets/[0-9a-f]+/tagmanager.css" rel="stylesheet">~',
            $output,
            'css asset should be registered.'
        );

        static::assertRegExp(
            '~<script src="/assets/[0-9a-f]+/tagmanager.js"></script>~',
            $output,
            'js asset should be registered.'
        );
    }
}

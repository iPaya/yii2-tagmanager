<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 * @license http://ipaya.cn/license
 */

namespace iPayaUnit\tagManager;


use iPaya\tagManager\TagManager;
use iPaya\tagManager\TagManagerAsset;

class TagManagerTest extends TestCase
{
    public function testTagManager()
    {
        TagManagerAsset::register(\Yii::$app->view);

        $input = TagManager::widget([
            'name' => 'test-tag-manager',
            'value' => 'ab,cd,ef'
        ]);

        $out = \Yii::$app->view->renderAjax('@iPayaUnit/tagManager/data/views/layout.php', [
            'content' => $input
        ]);

        static::assertContains('test-tag-manager', $out);
        static::assertContains('["ab","cd","ef"]', $out);
    }

    /**
     * 测试匹配标签
     */
    public function testParseTags()
    {
        $except = ['ab', 'cd', 'ef'];
        $tagManager = new TagManager(['name' => 'test-tag-manager']);
        $test1 = $tagManager->parseTags($except);
        static::assertEquals($except, $test1);

        $test2 = $tagManager->parseTags('ab,cd, ef');
        static::assertEquals($except, $test2);

        $test3 = $tagManager->parseTags('ab，cd，ef');
        static::assertEquals($except, $test3);
    }
}

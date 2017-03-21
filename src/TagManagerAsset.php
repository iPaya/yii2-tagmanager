<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 * @license http://ipaya.cn/license
 */

namespace iPaya\tagManager;


use yii\web\AssetBundle;

class TagManagerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/tagmanager';
    public $js = [
        'tagmanager.js'
    ];
    public $css = [
        'tagmanager.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}

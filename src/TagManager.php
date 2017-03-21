<?php
/**
 * @link http://ipaya.cn/
 * @copyright Copyright (c) 2016 ipaya.cn
 * @license http://ipaya.cn/license
 */

namespace iPaya\tagManager;


use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class TagManager extends InputWidget
{
    public $clientOptions = [];

    public function init()
    {
        parent::init();
        if ($this->model) {
            $this->clientOptions['prefilled'] = $this->parseTags($this->model->{$this->attribute});
        } else {
            $this->clientOptions['prefilled'] = $this->parseTags($this->value);
        }
    }

    public function run()
    {
        $this->registerClientScript();
        if ($this->model) {
            $input = Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            $input = Html::textInput($this->name, $this->value, $this->options);
        }
        return $input;
    }

    public function registerClientScript()
    {
        TagManagerAsset::register($this->getView());
        $inputId = $this->options['id'];

        $clientOptions = Json::encode($this->clientOptions);
        $this->getView()->registerJs("jQuery('#{$inputId}').tagsManager($clientOptions);");
    }

    /**
     * 匹配标签
     *
     * @param string $input
     * @return array
     */
    public function parseTags($input)
    {
        if (is_string($input)) {
            return preg_split('/\s*[,，]\s*/', $input, -1, PREG_SPLIT_NO_EMPTY);
        } elseif (is_array($input)) {
            return $input;
        } else {
            return [];
        }
    }
}

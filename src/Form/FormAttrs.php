<?php

namespace SmallRuralDog\Admin\Form;


class FormAttrs
{
    public $className;
    public $style;

    public $rules;
    public $inline = false;
    public $labelPosition = 'right';
    public $labelWidth = "auto";
    public $labelSuffix = "：";
    public $hideRequiredAsterisk = false;
    public $showMessage = true;
    public $inlineMessage = true;
    public $statusIcon = true;
    public $validateOnRuleChange = true;
    public $size;
    public $disabled = false;

    public $hideTab = true;
    /**
     * left，right，top，bottom 表示展示的方向
     * @var string
     */
    public $tabPosition = 'top';

    public $isDialog = false;

    public $createButtonName = "立即添加";
    public $updateButtonName = "立即修改";
    public $backButtonName = "返回";
    public $buttonWidth;

}

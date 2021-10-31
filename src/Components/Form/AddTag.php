<?php

namespace SmallRuralDog\Admin\Components\Form;

use SmallRuralDog\Admin\Components\Component;

class AddTag extends Component
{
    protected $componentName = "AddTag";

    protected $size = 'mini';
    protected $type = 'info';
    protected $closable = true;
    protected $disableTransitions = true;
    protected $hit = false;
    protected $color;
    protected $effect = 'plain';
    protected $btnName = '添加';
    protected $dynamicTags = [];

    static public function make($value = '')
    {
        return new AddTag($value);
    }

    /**
     * AddTag 的尺寸，medium/small/mini
     * @param string $size
     * @return $this
     */
    public function size(string $size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * AddTag 的类型, success/info/warning/danger
     * @param  $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * 是否可以关闭
     * @param bool $closable
     * @return $this
     */
    public function closable(bool $closable)
    {
        $this->closable = $closable;
        return $this;
    }

    /**
     * 是否有边框描边
     * @param bool $hit
     * @return $this
     */
    public function hit(bool $hit)
    {
        $this->hit = $hit;
        return $this;
    }

    /**
     * 背景色
     * @param string $color
     * @return $this
     */
    public function color(string $color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * 主题: dark/light/plain
     * @param string $effect
     * @return $this
     */
    public function effect(string $effect)
    {
        $this->effect = $effect;
        return $this;
    }

    /**
     * AddTag 按钮文本
     * @param string $btnName
     * @return $this
     */
    public function btnName(string $btnName)
    {
        $this->btnName = $btnName;
        return $this;
    }

    /**
     * AddTag 编辑时的原始数据，Array['第一'，第二]
     * @param array $dynamicTags
     * @return $this
     */
    public function dynamicTags(array $dynamicTags)
    {
        $this->dynamicTags = $dynamicTags;
        return $this;
    }

}

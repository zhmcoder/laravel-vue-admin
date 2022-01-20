<?php


namespace SmallRuralDog\Admin\Components\Widgets;


use SmallRuralDog\Admin\Components\Component;

class Markdown extends Component
{
    protected $componentName = "Markdown";

    protected $content;
    protected $language = 'zh-CN';
    protected $fontSize = '14px';
    protected $scrollStyle = true;
    protected $boxShadow = true;
    protected $boxShadowStyle = '0 2px 12px 0 rgba(0, 0, 0, 0.1)';
    protected $transition = true;
    protected $toolbarsBackground = '#ffffff';
    protected $previewBackground = '#fbfbfb';
    protected $editable = true;
    protected $subfield = true;
    protected $defaultOpen = 'edit';//edit,preview
    protected $toolbarsFlag = true;//edit,preview
    protected $placeholder = '';
    protected $codeStyle = 'code-github';
    protected $navigation = false;
    protected $shortCut = true;
    protected $ishljs = true;
    protected $tabSize = null;
    protected $html = true;

    protected $toolbars;


    public function __construct($content)
    {
        $this->content = $content;
        $this->toolbars = config('admin.markdown_toolbars');
    }

    public static function make($content = "")
    {
        return new Markdown($content);
    }


    public function language($language)
    {
        $this->language = $language;
        return $this;
    }

    public function content($content)
    {
        $this->content = $content;
        return $this;
    }

    public function fontSize($fontSize)
    {
        $this->fontSize = $fontSize;
        return $this;
    }

    public function scrollStyle($scrollStyle)
    {
        $this->scrollStyle = $scrollStyle;
        return $this;
    }

    public function boxShadow($boxShadow)
    {
        $this->boxShadow = $boxShadow;
        return $this;
    }

    public function boxShadowStyle($boxShadowStyle)
    {
        $this->boxShadowStyle = $boxShadowStyle;
        return $this;
    }

    public function transition($transition)
    {
        $this->transition = $transition;
        return $this;
    }

    public function toolbarsBackground($toolbarsBackground)
    {
        $this->toolbarsBackground = $toolbarsBackground;
        return $this;
    }

    public function previewBackground($previewBackground)
    {
        $this->previewBackground = $previewBackground;
        return $this;
    }

    public function editable($editable)
    {
        $this->editable = $editable;
        return $this;
    }

    public function subfield($subfield)
    {
        $this->subfield = $subfield;
        return $this;
    }

    public function defaultOpen($defaultOpen)
    {
        $this->defaultOpen = $defaultOpen;
        return $this;
    }

    public function toolbarsFlag($toolbarsFlag)
    {
        $this->toolbarsFlag = $toolbarsFlag;
        return $this;
    }

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function codeStyle($codeStyle)
    {
        $this->codeStyle = $codeStyle;
        return $this;
    }

    public function navigation($navigation)
    {
        $this->navigation = $navigation;
        return $this;
    }

    public function shortCut($shortCut)
    {
        $this->shortCut = $shortCut;
        return $this;
    }

    public function ishljs($ishljs)
    {
        $this->ishljs = $ishljs;
        return $this;
    }

    public function tabSize($tabSize)
    {
        $this->tabSize = $tabSize;
        return $this;
    }

    public function html($html)
    {
        $this->html = $html;
        return $this;
    }

}



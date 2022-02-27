<?php


namespace SmallRuralDog\Admin\Components\Form;


use SmallRuralDog\Admin\Components\Component;

class Markdown extends Component
{
    protected $componentName = "Markdown";

    protected $language = 'zh-CN';
    protected $fontSize = '14px';
    protected $scrollStyle = true;
    protected $boxShadow = true;
    protected $boxShadowStyle = '0 2px 12px 0 rgba(0, 0, 0, 0.1)';
    protected $transition = true;
    protected $toolbarsBackground = '#ffffff';
    protected $previewBackground = '#fbfbfb';
    protected $editable = true;
    protected $subfield = false;
    protected $defaultOpen = 'edit';//edit,preview
    protected $toolbarsFlag = true;
    protected $placeholder = '';
    protected $codeStyle = 'code-github';
    protected $navigation = false;
    protected $shortCut = true;
    protected $ishljs = true;
    protected $tabSize = null;
    protected $html = true;

    protected $toolbars;

    protected $imageUploadUrl;
    protected $showCustomTools = false;


    public function __construct($value = null)
    {
        $this->componentValue($value);
        $this->toolbars = config('admin.markdown_toolbars');
        $this->imageUploadUrl = route(config('admin.upload.file_handle_router', 'admin.handle-upload-file'));
    }

    public static function make($value = "")
    {
        return new Markdown($value);
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

    public function imageUploadUrl($imageUploadUrl)
    {
        $this->imageUploadUrl = $imageUploadUrl;
        return $this;
    }

    public function showCustomTools($showCustomTools)
    {
        $this->showCustomTools = $showCustomTools;
        return $this;
    }

}



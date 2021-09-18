<?php

namespace SmallRuralDog\Admin\Layout;

use Closure;
use SmallRuralDog\Admin\Components\Component;

class Content extends Component
{
    protected $componentName = 'Content';

    protected $showHeader = false;
    protected $title = "";
    protected $description = "";

    protected $rows = [];
    protected $isMsgDialogShow = false;
    protected $msgDialog = null;

    public static function make()
    {
        return new Content();
    }

    public function body($content)
    {
        return $this->row($content);
    }

    public function row($content)
    {

        if ($content instanceof Closure) {
            $row = new Row();
            call_user_func($content, $row);
            $this->addRow($row);
        } else {
            $row = new Row($content);
            $this->addRow($row);
        }
        return $this;
    }


    protected function addRow(Row $row)
    {
        $this->rows[] = $row;
    }

    /**
     * @param bool $showHeader
     * @return $this
     */
    public function showHeader($showHeader = true)
    {
        $this->showHeader = $showHeader;
        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function description($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * 是否显示对话框
     *
     * @param $isMsgDialogShow
     * @return $this
     */
    public function isMsgDialogShow($isMsgDialogShow)
    {
        $this->isMsgDialogShow = $isMsgDialogShow;
        return $this;
    }

    /**
     * 对话属性
     * [
    'title'=>'系统提示',
    'content'=>'系统提示',
    'okText'=>'确认好了',
    'width'=>'400px'
    ];
     *
     * @param $msgDialog
     * @return $this
     */
    public function msgDialog($msgDialog)
    {
        $this->msgDialog = $msgDialog;
        return $this;
    }

}

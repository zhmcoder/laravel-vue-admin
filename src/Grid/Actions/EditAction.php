<?php


namespace SmallRuralDog\Admin\Grid\Actions;


use SmallRuralDog\Admin\Actions\BaseRowAction;

class EditAction extends BaseRowAction
{


    protected $componentName = "EditAction";

    protected $type = "text";

    protected $content = "编辑";

    /**
     * @var int 1表示气泡确认框样式，2表示消息提示框样式
     */
    protected $tipsType = 1;

    protected $isDialog = false;

    /**
     * @param bool $isDialog
     * @return EditAction
     */
    public function isDialog(bool $isDialog=true)
    {
        $this->isDialog = $isDialog;
        return $this;
    }
    ##deep admin start
    public function content($content){
        $this->content = $content;
        return $this;
    }
    ##deep admin end


}

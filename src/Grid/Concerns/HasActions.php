<?php


namespace SmallRuralDog\Admin\Grid\Concerns;

use SmallRuralDog\Admin\Grid;
use SmallRuralDog\Admin\Grid\Actions\DeleteAction;
use SmallRuralDog\Admin\Grid\Actions\EditAction;
use SmallRuralDog\Admin\Grid\Actions\DeleteDialogAction;
use SmallRuralDog\Admin\Grid\Tools\Action;

trait HasActions
{

    protected $actions = [];
    protected $addActions = [];
    private $hide = false;
    private $hideViewAction = false;
    private $hideEditAction = false;
    private $hideDeleteAction = false;
    private $showMore = false;
    private $fixed = false;


    protected $editAction;
    protected $deleteAction;
    protected $deleteDialogAction;

    private $grid;

    private $styleCenter = true;


    public function __construct(Grid $grid)
    {

        $this->grid = $grid;

        $this->editAction = new EditAction();
        $this->deleteAction = new DeleteAction();
        $this->deleteDialogAction = new DeleteDialogAction();

    }

    /**
     * 编辑操作实例
     * @return EditAction
     */
    public function editAction(): EditAction
    {
        return $this->editAction;
    }

    /**
     * 删除操作实例
     * @return DeleteAction
     */
    public function deleteAction(): DeleteAction
    {
        return $this->deleteAction;
    }

    /**
     * 删除操作实例
     * @return DeleteAction
     */
    public function setDeleteAction(DeleteDialogAction $deleteDialog)
    {
        $this->deleteAction = $deleteDialog;
        return $this->deleteAction;
    }


    /**
     * 隐藏所有操作
     * @return $this
     */
    public function hideActions()
    {
        $this->hide = true;
        return $this;
    }

    /**
     * 隐藏详情操作
     * @return $this
     */
    public function hideViewAction()
    {
        $this->hideViewAction = true;
        return $this;
    }

    /**
     * 隐藏编辑操作
     * @return $this
     */
    public function hideEditAction()
    {
        $this->hideEditAction = true;
        return $this;
    }

    /**
     * 隐藏删除操作
     * @return $this
     */
    public function hideDeleteAction()
    {
        $this->hideDeleteAction = true;
        return $this;
    }

    /**
     * 添加自定义Action
     * @param $action
     * @return $this
     */
    public function add($action)
    {
        if ($action instanceof \Closure) {
            $this->addActions = collect($this->addActions)->push(call_user_func($action))->all();
        } else {
            $this->addActions = collect($this->addActions)->push($action)->all();
        }


        return $this;
    }


    public function builderActions()
    {
        $actions = collect($this->actions);

        if ($this->grid->getDialogForm() || $this->grid->getAddDialogForm() || $this->grid->getEditDialogForm() || $this->grid->getDrawerForm()) {
            $this->editAction->isDialog(true);
        }

        if (!$this->hideEditAction) {
            $actions->add($this->editAction);
        }
        if (!$this->hideDeleteAction) {
            $actions->add($this->deleteAction);
        }
        foreach ($this->addActions as $addAction) {
            $actions->add($addAction);
        }


        return [
            'hide' => $this->hide,
            'data' => $actions
        ];
    }

}

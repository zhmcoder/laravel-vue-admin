<?php

namespace SmallRuralDog\Admin\Controllers;

use SmallRuralDog\Admin\Components\Attrs\TransferData;
use SmallRuralDog\Admin\Components\Form\Transfer;
use SmallRuralDog\Admin\Components\Grid\Tag;
use SmallRuralDog\Admin\Form;
use SmallRuralDog\Admin\Grid;

class RoleController extends AdminController
{
    protected function grid()
    {
        $roleModel = config('admin.database.roles_model');

        $grid = new Grid(new $roleModel());

        $grid->addDialogForm($this->form()->isDialog()->className('p-15'), '800px');
        $grid->editDialogForm($this->form(true)->isDialog()->className('p-15'), '800px');

        $grid->quickSearch(['slug', 'name'])
            ->quickSearchPlaceholder('名称 / 标识')
            ->emptyText("暂无角色");

        $grid->column('id', '序号')->width(100)->sortable(true)->align('center');
        $grid->column('slug', "标识");
        $grid->column('name', "名称");
        $grid->column('permissions.name', "权限")->component(Tag::make()->type('info'));
        //$grid->dialogForm($this->form()->isDialog()->labelPosition("top")->className('p-15'), '600px', ['添加角色', '编辑角色']);

        $grid->actions(function (Grid\Actions $actions) {
            $actions->setDeleteAction(new Grid\Actions\DeleteDialogAction());
        })->toolbars(function (Grid\Toolbars $toolbars) {

        });

        return $grid;
    }

    public function form()
    {
        $permissionModel = config('admin.database.permissions_model');
        $roleModel = config('admin.database.roles_model');

        $form = new Form(new $roleModel());

        $form->getActions()->buttonCenter();
        $form->labelWidth('120px');

        $form->item('slug', "标识")->required()->inputWidth(6);
        $form->item('name', "名称")->required()->inputWidth(6);
        $form->item('permissions', "权限", 'permissions.id')->component(
            Transfer::make()->data($permissionModel::get()->map(function ($item) {
                return TransferData::make($item->id, $item->name);
            }))->titles(['可授权', '已授权'])->filterable()
        )->inputWidth(24);
        return $form;
    }
}

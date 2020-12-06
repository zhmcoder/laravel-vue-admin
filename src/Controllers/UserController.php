<?php

namespace SmallRuralDog\Admin\Controllers;

use SmallRuralDog\Admin\Components\Attrs\SelectOption;
use SmallRuralDog\Admin\Components\Form\Input;
use SmallRuralDog\Admin\Components\Form\Select;
use SmallRuralDog\Admin\Components\Form\Upload;
use SmallRuralDog\Admin\Components\Grid\Avatar;
use SmallRuralDog\Admin\Components\Grid\Tag;
use SmallRuralDog\Admin\Form;
use SmallRuralDog\Admin\Grid;
use Admin;

class UserController extends AdminController
{
    protected function grid()
    {
        $userModel = config('admin.database.users_model');
        $grid = new Grid(new $userModel());
        $grid
            ->quickSearch(['name', 'username'])
            ->quickSearchPlaceholder("用户名 / 昵称")
            ->pageBackground()
            ->defaultSort('id', 'desc')
            ->selection()
            ->stripe(true)->emptyText("暂无用户")
            ->perPage(10);

        $user = Admin::user();
        $grid->model()->where('id', '>=', $user['id']);

        $grid->column('id', "ID")->sortable(true)->width(80);
        $grid->column('avatar', '头像')->width(80)->align('center')->component(Avatar::make());
        $grid->column('username', "用户名");
        $grid->column('name', '用户昵称');
        $grid->column('roles.name', "角色")->component(Tag::make()->effect('dark'));
        $grid->column('created_at', '添加时间')->width(150);
        $grid->column('updated_at', '更新时间')->width(150);

        return $grid;
    }

    protected function form($isEdit = 0)
    {

        $userModel = config('admin.database.users_model');
        $permissionModel = config('admin.database.permissions_model');
        $roleModel = config('admin.database.roles_model');
        $form = new Form(new $userModel());

        $userTable = config('admin.database.users_table');
        $connection = config('admin.database.connection');

        $form->labelWidth('150px');

        $form->item('username', '用户名')->inputWidth(6)
            ->serveCreationRules(['required', "unique:{$connection}.{$userTable}"])
            ->serveUpdateRules(['required', "unique:{$connection}.{$userTable},username,{{id}}"])
            ->component(Input::make())->required();
        $form->item('name', '名称')->component(Input::make()->showWordLimit()->maxlength(20))->inputWidth(6)->required();
        $form->item('avatar', '头像')->component(Upload::make()->avatar()->path('avatar')->uniqueName());
        $form->item('password', '密码')->serveCreationRules(['required', 'string', 'confirmed'])->serveUpdateRules(['confirmed'])
            ->component(function () {
                return Input::make()->password()->showPassword();
            })->inputWidth(6)->ignoreEmpty()->required(!$isEdit);
        $form->item('password_confirmation', '确认密码')
            ->copyValue('password')->ignoreEmpty()
            ->component(function () {
                return Input::make()->password()->showPassword();
            })->inputWidth(6)->required(!$isEdit);
        $form->item('roles', '角色')->component(Select::make()->block()->multiple()->options($roleModel::all()->map(function ($role) {
            return SelectOption::make($role->id, $role->name);
        })->toArray()))->inputWidth(10);
        $form->item('permissions', '权限')->component(Select::make()->clearable()->block()->multiple()->options($permissionModel::all()->map(function ($role) {
            return SelectOption::make($role->id, $role->name);
        })->toArray()))->inputWidth(10);

        $form->saving(function (Form $form) {
            if ($form->password) {
                $form->password = bcrypt($form->password);
            }
        });

        $form->deleting(function (Form $form, $id) {
            if (\Admin::user()->id == $id || $id == 1) {
                return \Admin::responseError("删除失败");
            }
        });
        return $form;
    }
}

<?php

namespace SmallRuralDog\Admin;

use Admin;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use SmallRuralDog\Admin\Components\Component;
use SmallRuralDog\Admin\Components\Form\Upload;
use SmallRuralDog\Admin\Form\FormActions;
use SmallRuralDog\Admin\Form\FormAttrs;
use SmallRuralDog\Admin\Form\FormItem;
use SmallRuralDog\Admin\Form\HasHooks;
use SmallRuralDog\Admin\Form\HasRef;
use SmallRuralDog\Admin\Form\TraitFormAttrs;
use SmallRuralDog\Admin\Layout\Content;

//deep admin start
use Illuminate\Support\Str;

//deep admin end
use Symfony\Component\HttpFoundation\Response;

class TabForm extends Form
{

}

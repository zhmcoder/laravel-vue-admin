<?php

namespace SmallRuralDog\Admin\Grid\Tools;

use JsonSerializable;

//<!--deep admin start-->
class QuickFilter implements JsonSerializable
{
    public $filterKey;

    public $options;
    public $defaultValue;
    public $value;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'filterKey' => $this->filterKey,
            'value'=>$this->value,
            'options'=>$this->options
        ];
    }
}
//<!--deep admin end-->

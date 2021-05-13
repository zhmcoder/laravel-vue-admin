<?php

namespace SmallRuralDog\Admin\Grid\Tools;

use JsonSerializable;

//<!--deep admin start-->
class QuickFilter implements JsonSerializable
{
    public $filterKey;

    public $options;
    public $defaultValue;

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'filterKey' => $this->filterKey,
            'defaultValue'=>$this->defaultValue,
            'options'=>$this->options
        ];
    }
}
//<!--deep admin end-->

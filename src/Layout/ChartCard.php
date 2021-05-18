<?php

namespace SmallRuralDog\Admin\Layout;

use SmallRuralDog\Admin\Components\Component;
use SmallRuralDog\Admin\Components\Form\Select;
use SmallRuralDog\Admin\Components\Widgets\Html;

class ChartCard extends Component
{

    protected $componentName = "ChartCard";

    protected $title;
    protected $filters = [];
    protected $chart;
    protected $data_url;

    public function __construct()
    {
        $this->title = "test test";
    }


    public static function make()
    {
        return new ChartCard();
    }

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function addFilter(Select $select)
    {
        $this->filters[] = $select;
        return $this;
    }

    public function chart($chart)
    {
        $this->chart = $chart;
        return $this;
    }

    public function data_url($data_url)
    {
        $this->data_url = $data_url;
        return $this;
    }


}

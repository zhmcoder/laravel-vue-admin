<?php


namespace SmallRuralDog\Admin\Grid\Concerns;


use SmallRuralDog\Admin\Components\Form\Radio;
use SmallRuralDog\Admin\Grid\Column;
use SmallRuralDog\Admin\Grid\Model;
use SmallRuralDog\Admin\Grid\Tools\QuickFilter;
use SmallRuralDog\Admin\Grid\Tools\QuickSearch;

//<!--deep admin start-->

/**
 * @method  Model model()
 */
trait HasQuickFilter
{

    /**
     * @property Column $columns
     * @var QuickFilter
     */
    public $quickFilter;
    public $or = false;
    public $operator = '=';

    public function quickFilter()
    {
        $this->quickFilter = new QuickFilter();
        $this->quickFilter->defaultValue = '';
        return $this;
    }

    /**
     * @param string $filterKey 过滤的数据库字段
     * @return $this
     */
    public function filterKey(string $filterKey)
    {
        if ($this->quickFilter == null) {
            $this->quickFilter = new QuickFilter();
        }

        $this->quickFilter->filterKey = $filterKey;


        return $this;
    }

    public function quickOptions($options = [])
    {
        if ($this->quickFilter == null) {
            $this->quickFilter = new QuickFilter();
        }
        $this->quickFilter->options = $options;
        array_unshift($this->quickFilter->options,
            Radio::make('', '全部'));
        return $this;
    }

    public function defaultValue($defaultValue)
    {
        if ($this->quickFilter == null) {
            $this->quickFilter = new QuickFilter();
        }
        $this->quickFilter->defaultValue = $defaultValue;
        return $this;
    }

    public function or($or = true)
    {
        $this->or = $or;
    }

    public function operator($operator = '=')
    {
        $this->operator = $operator;
    }

    /**
     * Apply the search query to the query.
     *
     * @return mixed|void
     */
    protected function applyQuickFilter()
    {

        debug_log_info('quick filter = ' . json_encode($this->quickFilter));
        if (!$this->quickFilter) {
            return;
        }
        debug_log_info('quick filter query = ' . request()->get($this->quickFilter->filterKey));
        $query = request()->get($this->quickFilter->filterKey);
        if ($query === 'NULL') {
            $query = null;
        }
        if ($query == '' || $query == null) {
            return;
        }
        if (strpos($query, 'default_') !== false) {
            return;
        }
        $this->addWhereBasicBinding($this->quickFilter->filterKey, $this->or, $this->operator, $query);
    }

}
//<!--deep admin end-->

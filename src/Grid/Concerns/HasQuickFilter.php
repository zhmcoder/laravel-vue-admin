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


    public function quickFilter()
    {
        $this->quickFilter = new QuickFilter();
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

//    public function defaultValue($defaultValue)
//    {
//        if ($this->quickFilter == null) {
//            $this->quickFilter = new QuickFilter();
//        }
//        $this->quickFilter->defaultValue = $defaultValue;
//        return $this;
//    }

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
        if (!$query = request()->get($this->quickFilter->filterKey)) {
            return;
        }
        $this->addWhereBasicBinding($this->quickFilter->filterKey, false, '=', $query);
    }

}
//<!--deep admin end-->

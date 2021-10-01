<?php


namespace SmallRuralDog\Admin\Grid\Concerns;


use Closure;
use SmallRuralDog\Admin\Grid\Filter;
use SmallRuralDog\Admin\Grid\LeftFilter;

trait HasFilter
{
    /**
     * @var Filter
     * @var LeftFilter
     */
    protected $filter;
    protected $leftFilter;


    public function applyFilter($toArray = true)
    {

        return $this->filter->execute($toArray);
    }

    public function filter(Closure $callback)
    {
        call_user_func($callback, $this->filter);
    }

    public function leftFilter(Closure $callback)
    {
        call_user_func($callback, $this->leftFilter);
    }
}

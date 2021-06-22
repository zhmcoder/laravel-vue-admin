<?php


namespace SmallRuralDog\Admin\Traits;


class AdminJsonBuilder implements \JsonSerializable
{

    protected $hideAttrs = ['is_filter_null'];

    protected $is_filter_null = false;

    public function is_filter_null($is_filter_null = false)
    {
        $this->is_filter_null = $is_filter_null;
        return $this;
    }

    public function addHideAttrs($attrs)
    {
        $this->hideAttrs[] = $attrs;
        return $this;
    }

    public function jsonSerialize()
    {
        $data = null;
        $hide = collect($this->hideAttrs)->push("hideAttrs")->toArray();
        foreach ($this as $key => $val) {
            if (!in_array($key, $hide)) {
                if ($this->is_filter_null) {
                    if (!is_null($val)) {
                        $data[$key] = $val;
                    }
                } else {
                    $data[$key] = $val;
                }

            }
        }
        return $data;
    }
}

<?php

namespace SmallRuralDog\Admin\Components\Attrs;

trait Depend
{
    protected $depend;
    protected $paginate = 0;
    protected $extUrlParams;
    protected $label;
    //deep admin start
    protected $relatedComponents;
    protected $isRelatedSelect;
    protected $relatedSelectRef;
    //deep admin end

    /**
     * @param mixed $depend
     * @return $this
     */
    public function depend($depend)
    {
        $this->depend = $depend;
        return $this;
    }

    /**
     * @param mixed $paginate
     * @return $this
     */
    public function paginate($paginate)
    {
        $this->paginate = $paginate;
        return $this;
    }
    /**
     * @param mixed $extUrlParams
     * @return $this
     */
    public function extUrlParams($extUrlParams)
    {
        $this->extUrlParams = $extUrlParams;
        return $this;
    }
    /**
     * 远程加载时的默认显示名称，因远程时一般仅有value
     * @param object form 所属表单
     * @param array $label ['key'=>'model','value'=>['value'=>'id','label'=>['title','label']]] // 所属关联模型 用于从data取值
     * @return $this
     */
    public function label(&$form, $label)
    {
        $this->label = $label;
        $form->item($label['key'])->vif('label' . mt_rand(10000, 99999), false);
        return $this;
    }
    //deep admin start

    /**
     * @param mixed $relatedSelectRef
     * @return $this
     */
    public function relatedSelectRef($relatedSelectRef)
    {
        $this->relatedSelectRef = $relatedSelectRef;
        return $this;
    }

    /**
     * @param mixed $relatedComponents
     * @return $this
     */
    public function relatedComponents($relatedComponents)
    {
        $this->relatedComponents = $relatedComponents;
        return $this;
    }

    /**
     * @param boolean $isRelatedSelect true or false
     * @return $this
     */
    public function isRelatedSelect($isRelatedSelect)
    {
        $this->isRelatedSelect = $isRelatedSelect;
        return $this;
    }
    //deep admin end
}

<?php

/**
 * Class Model_ConfigurableProduct
 */
class Model_ConfigurableProduct extends Model_ProductAbstract
{
    /**
     * @var string items
     */
    protected $_items = '';

    /**
     * set items
     *
     * @param string $items items
     *
     * @return void
     */
    public function setItems($items)
    {
        $this->_items = $items;
    }

    /**
     * get items
     *
     * @return string
     */
    public function getItems()
    {
        return $this->_items;
    }

    /**
     * get type
     *
     * @return string
     */
    public function getType()
    {
        return 'Csoportos';
    }

}
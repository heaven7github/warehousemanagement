<?php

/**
 * Class Model_SimpleProduct
 */
class Model_SimpleProduct extends Model_ProductAbstract
{
    protected $_weight = 0;

    /**
     * set weight
     *
     * @param int $weight weight
     * @return void
     */
    public function setWeight($weight)
    {
        $this->_weight = $weight;
    }

    /**
     * get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->_weight;
    }

    /**
     * get type
     *
     * @return string
     */
    public function getType()
    {
        return 'Szimpla';
    }
}
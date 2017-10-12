<?php

/**
 * Class Model_ProductAbstract
 */
class Model_ProductAbstract extends ModelAbstract
{
    /**
     * @var string
     */
    protected $_dataType = 'products';

    /**
     * @var int
     */
    protected $_id = 0;

    /**
     * @var string
     */
    protected $_name = '';

    /**
     * @var string
     */
    protected $_sku = '';

    /**
     * @var int
     */
    protected $_price = 0;

    /**
     * @var bool
     */
    protected $_manufacturer = false;


    /**
     * set id
     *
     * @param int $id id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * set name
     *
     * @param string $name name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * set sku
     *
     * @param string $sku sku
     *
     * @return void
     */
    public function setSku($sku)
    {
        $this->_sku = $sku;
    }

    /**
     * get sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->_sku;
    }

    /**
     * set price
     *
     * @param int $price price
     *
     * @return void
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * set manufacturer
     *
     * @param object $manufacturer manufacturer
     *
     * @return void
     */
    public function setManufacturer($manufacturer)
    {
        $this->_manufacturer = $manufacturer;
    }

    /**
     * get manufacturer
     *
     * @return Model_Manufacturer|bool
     */
    public function getManufacturer()
    {
        return $this->_manufacturer;
    }
}
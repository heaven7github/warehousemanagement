<?php

/**
 * Class Model_Manufacturer
 */
class Model_Manufacturer extends ModelAbstract
{
    /**
     * @var string
     */
    protected $_dataType = 'manufacturer';

    /**
     * get manufacturer name by id
     *
     * @param int $manufacturerId manufacturer id
     * @return string
     */
    public function getManufacturerNameById($manufacturerId)
    {
        $manufacturers = $this->getList();
        return isset($manufacturers[$manufacturerId]) ? $manufacturers[$manufacturerId]['name'] : '';
    }
}
<?php

/**
 * Class Model_Products
 */
class Model_Products extends ModelAbstract
{
    protected $_dataType = 'products';

    /**
     * get all products
     *
     * @return array
     */
    public function getAllProducts()
    {
        $ret = [];
        if ('' != $this->_dataType) {
            $dataConfig = new DataConfig($this->_dataType);
            $products = $dataConfig->read();

            foreach ($products as $productData) {
                $ret[] = $this->_initProductObject($productData);
            }
        }
        return $ret;
    }

    /**
     * get product by id
     *
     * @param int $id id
     * @return Model_ProductAbstract
     */
    public function getProductById($id)
    {
        $dataConfig = new DataConfig($this->_dataType);
        $products = $dataConfig->read();
        $productData = $products[(int)$id];
        return $this->_initProductObject($productData);
    }

    /**
     * otot product object
     *
     * @param array $productData product data
     * @return Model_ProductAbstract
     */
    protected function _initProductObject($productData)
    {
        /** @var Model_ProductAbstract $product */
        switch ($productData['type']) {
            case 'configurable':
                $product = new Model_ConfigurableProduct();
                $product->setItems($productData['items']);
                break;

            case 'simple':
                $product = new Model_SimpleProduct();
                $product->setWeight($productData['weight']);
                break;
        }

        $product->setName($productData['name']);
        $product->setId($productData['id']);
        $product->setSku($productData['sku']);
        $product->setPrice($productData['price']);

        $manufacturer = new Model_Manufacturer();
        $product->setManufacturer($manufacturer->getManufacturerNameById($productData['manufacturer_id']));
        return $product;
    }


}
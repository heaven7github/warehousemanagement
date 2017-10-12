<?php

/**
 * Class Model_WarehouseProducts
 */
class Model_WarehouseProducts extends ModelAbstract
{
    /**
     * @var string
     */
    protected $_dataType = 'warehouse_products';

    /**
     * get products by warehouse id
     *
     * @param int $warehouseId warehouse id
     * @return array
     */
    public function getProductsByWarehouseId($warehouseId)
    {
        $dataConfig = new DataConfig($this->_dataType);
        $productsData = $dataConfig->read();

        if (!isset($productsData[$warehouseId])) {
            return [];
        }

        $warehouseProducts = $productsData[$warehouseId];

        $products = new Model_Products('warehouse_products' != $this->_dataType ? 'simulation/products' : false);
        foreach ($warehouseProducts as &$productData) {
            $product = $products->getProductById($productData['product_id']);
            $productData['product'] = $product;
        }
        return $warehouseProducts;
    }

    public function getNewProductsInWarehouse($warehouseId)
    {
        $products = new Model_Products();
        $productList = $products->getAllProducts();

        $warehouseProducts = $this->getProductsByWarehouseId($warehouseId);
        $warehouseProductIds = array_keys($warehouseProducts);

        foreach ($productList as $key => $product) {
            if (in_array($product->getId(), $warehouseProductIds)) {
                unset($productList[$key]);
            }
        }
        return $productList;
    }

    /**
     * save to json file
     *
     * @return void
     * @throws Exception
     */
    public function save()
    {
        if ('' != $this->_dataType) {
            $dataConfig = new DataConfig($this->_dataType);
            $data = $dataConfig->read();

            $tmp = $data[$this->getId()];
            $tmp[$this->getProductId()] = $this->getData();

            $dataConfig->write(
                $tmp,
                $this->getId()
            );
        } else {
            throw new Exception('Érvénytelen adattípus.');
        }
    }

    /**
     * remove element from json file
     *
     * @return void
     * @throws Exception
     */
    public function remove()
    {
        if ('' != $this->_dataType) {
            $dataConfig = new DataConfig($this->_dataType);
            $data = $dataConfig->read();

            $tmp = $data[$this->getId()];
            unset($tmp[$this->getProductId()]);// = $this->getData();

            $dataConfig->write(
                $tmp,
                $this->getId()
            );
        } else {
            throw new Exception('Érvénytelen adattípus.');
        }
    }
}
<?php

/**
 * Class Model_Warehouse
 */
class Model_Warehouse extends ModelAbstract
{
    /**
     * @var string
     */
    protected $_dataType = 'warehouse';

    /**
     * get warehouse by id
     *
     * @param int $warehouseId warehouse id
     * @return array
     */
    public function getWarehouseById($warehouseId)
    {
        $warehouses = $this->getList();
        return isset($warehouses[$warehouseId]) ? $warehouses[$warehouseId] : [];
    }

    /**
     * get next warehouse by id
     *
     * @param int $warehouseId warehouse id
     * @return array
     */
    public function getNextWarehouseById($warehouseId)
    {
        $warehouses = $this->getList();
        return isset($warehouses[$warehouseId + 1]) ? $warehouses[$warehouseId + 1] : [];
    }

    /**
     * increase capacity
     *
     * @param int $warehouseId warehouse id
     * @param int $productId   product id
     * @param int $change      change
     * @return array
     * @throws Exception
     */
    public function increaseCapacity($warehouseId, $productId, $change)
    {
        $warehouse = $this->getWarehouseById($warehouseId);

        if ((int)$warehouse['capacity'] >= $change) {
            $warehouse['capacity'] = (int)$warehouse['capacity'] - $change;
            $dataConfig = new DataConfig($this->_dataType);
            $warehouseProducts = new Model_WarehouseProducts('warehouse' != $this->_dataType ? 'simulation' : false);
            $warehouseProducts->setId($warehouseId);
            $warehouseProducts->setProductId($productId);
            $warehouseProducts->setQty($change);
            $warehouseProducts->save();

            return $dataConfig->write($warehouse, $warehouseId);
        } else {
            $diff = $change - $warehouse['capacity'];
            $dataConfig = new DataConfig($this->_dataType);
            $warehouseProducts = new Model_WarehouseProducts('warehouse' != $this->_dataType ? 'simulation' : false);
            $warehouseProducts->setId($warehouseId);
            $warehouseProducts->setProductId($productId);
            $warehouseProducts->setQty($warehouse['capacity']);
            $warehouseProducts->save();

            $warehouse['capacity'] = 0;
            $dataConfig->write($warehouse, $warehouseId);

            $nextWarehouse = $this->getNextWarehouseById($warehouseId);
            if (isset($nextWarehouse)) {
                echo 6;
                return $this->increaseCapacity($nextWarehouse['id'], $productId, $diff);
            } else {
                throw new Exception($diff . ' darab terméket egy raktárban sem tudtunk elhelyezni.');
            }

        }
    }

    /**
     * @param int $warehouseId warehouse id
     * @param int $productId product id
     * @param int $qty qty
     * @throws Exception
     */
    public function removeCapacity($warehouseId, $productId, $qty)
    {
        $warehouse = $this->getWarehouseById($warehouseId);


        $warehouseProducts = new Model_WarehouseProducts('warehouse' != $this->_dataType ? 'simulation' : false);
        $warehouseProductList = $warehouseProducts->getProductsByWarehouseId($warehouseId);
        $originalQty = (int)$warehouseProductList[$productId]['qty'];

        if ($originalQty - $qty == 0) {
            $warehouseProducts = new Model_WarehouseProducts('warehouse' != $this->_dataType ? 'simulation' : false);
            $warehouseProducts->setId($warehouseId);
            $warehouseProducts->setProductId($productId);
            $warehouseProducts->remove();
        } elseif ($originalQty > $qty) {
            $warehouseProducts = new Model_WarehouseProducts('warehouse' != $this->_dataType ? 'simulation' : false);
            $warehouseProducts->setId($warehouseId);
            $warehouseProducts->setProductId($productId);
            $warehouseProducts->setQty($originalQty - $qty);
            $warehouseProducts->save();
        } else {
            throw new Exception('A kikért mennyiség nagyobb mint a raktárban lévő mennyiség.');
        }

        $dataConfig = new DataConfig($this->_dataType);
        $warehouse['capacity'] += $qty;
        $dataConfig->write($warehouse, $warehouseId);

    }
}
<?php

/**
 * Class Controller_Warehouse
 */
class Controller_Warehouse extends ControllerAbstract
{
    /**
     * index action
     *
     * @return void
     */
    public function indexAction()
    {
        $warehouse = new Model_Warehouse();

        $this->_renderer->render(
            'warehouse',
            [
                'warehouses' => $warehouse->getList()
            ]
        );
    }

    /**
     * add warehouse action
     *
     * @return void
     */
    public function add_warehouseAction()
    {
        if ($this->_post) {

            if ((int)$this->_post['capacity'] <= 0) {
                $this->_session->addError('A megadott kapacitás nem megfelelő. Kérem pozitív egész számot adjon meg');
            } else {

                try {
                    $warehouse = new Model_Warehouse();
                    $warehouse->setName($this->_post['name']);
                    $warehouse->setAddress($this->_post['address']);
                    $warehouse->setCapacity($this->_post['capacity']);
                    $warehouse->save();

                    $this->_session->addSuccess('Sikeres mentés.');

                    $this->redirect('warehouse/index');
                } catch (Exception $e) {
                    $this->_session->addError($e->getMessage());
                }

            }
        }
        $this->_renderer->render(
            'warehouse_add',
            [
                'type' => 'Új raktár hozzáadása',
                'warehouse' => $this->_post
            ]
        );
    }

    /**
     * warehouse product action
     *
     * @param array $params params
     *
     * @return void
     */
    public function warehouse_productAction($params)
    {
        if (!isset($params) || !isset($params['id'])) {
            $this->redirect('warehouse/index');
        }

        $warehouseProducts = new Model_WarehouseProducts();
        $warehouseProductList = $warehouseProducts->getProductsByWarehouseId($params['id']);

        $productList = $warehouseProducts->getNewProductsInWarehouse($params['id']);


        $warehouse = new Model_Warehouse();

        $this->_renderer->render(
            'warehouse_products',
            [
                'warehouseProducts' => $warehouseProductList,
                'warehouse' => $warehouse->getWarehouseById($params['id']),
                'products' => $productList
            ]
        );
    }

    /**
     * warehouse add product action
     *
     * @param array $params params
     *
     * @return void
     */
    public function warehouse_add_productAction($params)
    {
        if ($this->_post) {
            if ($this->_post['id']) {
                try {
                    if ((int)$this->_post['qty'] <= 0) {
                        $this->_session->addError('A megadott mennyiség nem megfelelő. Kérem pozitív egész számot adjon meg');
                    } else {
                        $warehouse = new Model_Warehouse();
                        $warehouse->increaseCapacity($this->_post['id'], $this->_post['product_id'], (int)$this->_post['qty']);
                    }
                    $this->redirect(
                        'warehouse/warehouse_product',
                        [
                            'id' => $this->_post['id']
                        ]
                    );

                    $this->_session->addSuccess('Sikeres mentés.');
                } catch (Exception $e) {
                    $this->_session->addError($e->getMessage());
                }
            }
        }
        $this->redirect('warehouse/warehouse_product');
    }

    /**
     * warehouse add product action
     *
     * @param array $params params
     *
     * @return void
     */
    public function remove_productAction($params)
    {
        if ((int)$params['warehouse_id'] > 0 && (int)$params['product_id'] > 0) {
            try {
                if ((int)$params['qty'] <= 0) {
                    $this->_session->addError('A megadott mennyiség nem megfelelő. Kérem pozitív egész számot adjon meg');
                } else {
                    $warehouse = new Model_Warehouse();
                    $warehouse->removeCapacity((int)$params['warehouse_id'], (int)$params['product_id'], (int)$params['qty']);
                }

                $this->_session->addSuccess('Sikeres mentés.');
            } catch (Exception $e) {
                $this->_session->addError($e->getMessage());
            }

            $this->redirect(
                'warehouse/warehouse_product',
                [
                    'id' => $params['warehouse_id']
                ]
            );
        }
        $this->redirect('warehouse/warehouse_product');
    }
}
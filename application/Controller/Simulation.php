<?php

/**
 * Class Controller_Simulation
 */
class Controller_Simulation extends ControllerAbstract
{
    /**
     * index action
     *
     * @return void
     */
    public function indexAction()
    {
        $this->_renderer->render('simulation');
    }

    /**
     * index action
     *
     * @return void
     */
    public function startAction($params)
    {
        switch ((int)$params['type']) {
            case 1:
                try {
                    $warehouse = new Model_Warehouse('simulation');
                    $warehouse->removeAll();

                    $warehouseProducts = new Model_WarehouseProducts('simulation');
                    $warehouseProducts->removeAll();

                    $warehouse->setName('Szimuláció raktár');
                    $warehouse->setAddress('Szimuláció cím');
                    $warehouse->setCapacity(5);
                    $warehouse->save();

                    $warehouse = new Model_Warehouse('simulation');
                    $warehouse->setName('Szimuláció raktár 2');
                    $warehouse->setAddress('Szimuláció cím 2');
                    $warehouse->setCapacity(5);
                    $warehouse->save();

                    $productId = 2;
                    $warehouse->increaseCapacity($warehouse->getNextId(), $productId, 5);
                    $warehouse->removeCapacity($warehouse->getNextId(), $productId, 2);

                } catch (Exception $e) {
                    $this->_session->addError($e->getMessage());
                }

                $this->_session->addSuccess('A szimuláció sikeresen lefutott. 2 raktár és 5 termék felvéve, 2 termék kikérve');
                break;

            case 2:

                try {
                    $warehouse = new Model_Warehouse('simulation');
                    $warehouse->removeAll();

                    $warehouseProducts = new Model_WarehouseProducts('simulation');
                    $warehouseProducts->removeAll();

                    $warehouse->setName('Szimuláció raktár');
                    $warehouse->setAddress('Szimuláció cím');
                    $warehouse->setCapacity(5);
                    $warehouse->save();

                    $warehouse = new Model_Warehouse('simulation');
                    $warehouse->setName('Szimuláció raktár 2');
                    $warehouse->setAddress('Szimuláció cím 2');
                    $warehouse->setCapacity(5);
                    $warehouse->save();

                    $productId = 2;
                    $warehouse->increaseCapacity($warehouse->getNextId(), $productId, 5);
                    $warehouse->removeCapacity($warehouse->getNextId(), $productId, 6);

                } catch (Exception $e) {
                    $this->_session->addError($e->getMessage());
                }

                $this->_session->addSuccess('A szimuláció sikeresen lefutott. 2 raktár és 5 termék kikérve, 6 terméket megpróbált kikérni.');
                break;

            case 3:

                try {
                    $warehouse = new Model_Warehouse('simulation');
                    $warehouse->removeAll();

                    $warehouseProducts = new Model_WarehouseProducts('simulation');
                    $warehouseProducts->removeAll();

                    $warehouse->setName('Szimuláció raktár');
                    $warehouse->setAddress('Szimuláció cím');
                    $warehouse->setCapacity(5);
                    $warehouse->save();

                    $warehouse = new Model_Warehouse('simulation');
                    $warehouse->setName('Szimuláció raktár 2');
                    $warehouse->setAddress('Szimuláció cím 2');
                    $warehouse->setCapacity(5);
                    $warehouse->save();

                    $productId = 2;
                    $warehouse->increaseCapacity($warehouse->getNextId(), $productId, 5);
                    $warehouse->removeCapacity($warehouse->getNextId(), $productId, 10);

                } catch (Exception $e) {
                    $this->_session->addError($e->getMessage());
                }

                $this->_session->addSuccess('A szimuláció sikeresen lefutott. 2 raktár és 5 termék kikérve, 10 terméket megpróbált kikérni.');

                break;

            default:

                break;
        }
        $this->redirect('simulation');
        $this->_renderer->render('simulation_start');
    }
}
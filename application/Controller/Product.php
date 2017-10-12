<?php

/**
 * Class Controller_Product
 */
class Controller_Product extends ControllerAbstract
{
    /**
     * index action
     *
     * @return void
     */
    public function indexAction()
    {
        $products = new Model_Products();
        $productList = $products->getAllProducts();
        $this->_renderer->render(
            'product',
            [
                'products' => $productList
            ]
        );
    }
}
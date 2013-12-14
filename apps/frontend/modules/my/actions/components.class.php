<?php

class myComponents extends sfComponents {

    /** generating tree of the categories
     * @param $carLabel
     * @param $carLabelId
     * @param $categoryId
     */
    public function executeProductList() {
        $this->hasProducts = $this->getUser()->hasAttribute('cart');
        $this->products = $this->getUser()->getAttribute('cart');
    }

}

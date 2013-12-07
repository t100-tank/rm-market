<?php

/**
 * zapchasti actions.
 *
 * @package    rm-market
 * @subpackage tehcenter
 * @author     Arij
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class zapchastiActions extends sfActions {

    public function executeLabel(sfWebRequest $request) {
        $this->label = CarLabelPeer::retrieveBySlug($request->getParameter('car_label'));
        if (is_null($this->label))
            $this->redirect404();

//        default values
        $this->breadcrumb = array(
            array(
                'link' => '@homepage',
                'title' => 'Главная'
            ),
            array(
                'link' => '@zapchasti',
                'title' => 'Автозапчасти'
            ),
            array(
                'link' => null,
                'title' => $this->label->getName()
            )
        );
        $this->getResponse()->setTitle($this->label->getName());
        $this->getResponse()->addMeta('description', $this->label->getName());
        $this->getResponse()->addMeta('keywords', $this->label->getName());

        $this->pager = new sfPropelPager('Product', sfConfig::get('app_products_per_page'));
        $this->pager->setCriteria( ProductPeer::getProductsByCarLabelCriteria( $this->label->getId() ) );
        $this->pager->setPage( $request->getParameter('page', 1) );
        $this->pager->init();
//        check existing page
        $this->workoutPage();
    }

    public function executeCategory(sfWebRequest $request) {
        $this->label = CarLabelPeer::retrieveBySlug($request->getParameter('car_label'));
        $this->category = CategoryPeer::retrieveBySlug($request->getParameter('category'));
        $isCarCategory = $this->category->checkCarId($this->label->getId());
        if (!is_null($this->category)) {
            if (!is_null($this->category->getCategoryRelatedByParentId())) {
                $this->topCategory = $this->category->getCategoryRelatedByParentId();
            } else {
                $this->topCategory = $this->category;
                $this->category = null;
            }
        }
        if (!$isCarCategory)
            $this->redirect404();

//        default values
        $this->breadcrumb = array(
            array(
                'link' => '@homepage',
                'title' => 'Главная'
            ),
            array(
                'link' => '@zapchasti',
                'title' => 'Автозапчасти'
            ),
            array(
                'link' => '@zapchasti_label?car_label='.$this->label->getSlug(),
                'title' => $this->label->getName()
            )
        );
        if (is_null($this->category)) {
            $this->breadcrumb[] = array(
                'link' => null,
                'title' => $this->topCategory->getName()
            );
        } else {
            $this->breadcrumb[] = array(
                'link' => '@zapchasti_label_category?car_label='.$this->label->getSlug().'&category='.$this->topCategory->getSlug(),
                'title' => $this->topCategory->getName()
            );
            $this->breadcrumb[] = array(
                'link' => null,
                'title' => $this->category->getName()
            );
        };
        $this->getResponse()->setTitle($this->label->getName());
        $this->getResponse()->addMeta('description', $this->label->getName());
        $this->getResponse()->addMeta('keywords', $this->label->getName());

        $this->pager = new sfPropelPager('Product', sfConfig::get('app_products_per_page'));
        $this->pager->setCriteria( ProductPeer::getProductsByCarLabelCategoryCriteria( $this->label->getId(), $this->topCategory->getId(), ($this->category) ? $this->category->getId(): null ) );
        $this->pager->setPage( $request->getParameter('page', 1) );
        $this->pager->init();

//        check existing page
        $this->workoutPage();
    }

    public function executeProduct(sfWebRequest $request) {
        $this->label = CarLabelPeer::retrieveBySlug($request->getParameter('car_label'));
        $this->category = CategoryPeer::retrieveBySlug($request->getParameter('category'));
        $this->product = ProductPeer::retrieveBySlug($request->getParameter('product'));
        $isCarProduct = false; // CarProductPeer::retrieveByPK()instanceof CarProduct;
        if (!is_null($this->label) && !is_null($this->category) && !is_null($this->product)) {
            if (!is_null($this->category->getCategoryRelatedByParentId())) {
                $this->topCategory = $this->category->getCategoryRelatedByParentId();
                $isCarProduct = $this->category->checkCarId($this->label->getId()) && (CarProductPeer::retrieveByPK($this->label->getId(), $this->product->getId()) instanceof CarProduct);
            }
        }
        if (!$isCarProduct)
            $this->redirect404();

//        default values
        $this->breadcrumb = array(
            array(
                'link' => '@homepage',
                'title' => 'Главная'
            ),
            array(
                'link' => '@zapchasti',
                'title' => 'Автозапчасти'
            ),
            array(
                'link' => '@zapchasti_label?car_label='.$this->label->getSlug(),
                'title' => $this->label->getName()
            ),
            array(
                'link' => '@zapchasti_label_category?car_label='.$this->label->getSlug().'&category='.$this->topCategory->getSlug(),
                'title' => $this->topCategory->getName()
            ),
            array(
                'link' => '@zapchasti_label_category?car_label='.$this->label->getSlug().'&category='.$this->category->getSlug(),
                'title' => $this->category->getName()
            ),
            array(
                'link' => null,
                'title' => $this->product->getName()
            )
        );

        $this->getResponse()->setTitle($this->label->getName());
        $this->getResponse()->addMeta('description', $this->label->getName());
        $this->getResponse()->addMeta('keywords', $this->label->getName());

//        check existing page
        $this->workoutPage();
    }

    /**
     * $this->breadcrumb (array) default breadcrumb
     */
    private function workoutPage() {
        $opt = $this->getContext()->getRouting()->getOptions('context');
        $link = $opt['context']['path_info'];
        $this->page = PagesPeer::retrieveBySlug($link);

        if ($this->page instanceof Pages) {
            $this->getResponse()->setTitle($this->page->getTitle());
            $this->getResponse()->addMeta('description', $this->page->getMetaDescription());
            $this->getResponse()->addMeta('keywords', $this->page->getMetaKeywords());

            $breadcrumb = json_decode($this->page->getBreadcrumb(), true);
            if (is_array($breadcrumb)) {
                $this->breadcrumb = array_splice($this->breadcrumb, 0, count($this->breadcrumb) - count($breadcrumb));
                foreach ($breadcrumb as $item) {
                    $this->breadcrumb[] = array(
                        'link' => (!empty($item['link'])) ? $item['link']: null,
                        'title' => (!empty($item['title'])) ? $item['title']: ''
                    );
                }
            } else {
                $this->breadcrumb = array_splice($this->breadcrumb, 0, count($this->breadcrumb)-1);
                $this->breadcrumb[] = array(
                    'link' => null,
                    'title' => $this->page->getBreadcrumb()
                );
            }
        }
    }

}

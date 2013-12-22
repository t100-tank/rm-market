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
        $this->getUser()->setAttribute('search', array());

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
        $this->getUser()->setAttribute('search', array());

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
        $this->getResponse()->setTitle(($this->category) ? $this->category->getName(): $this->topCategory->getName());
        $this->getResponse()->addMeta('description', ($this->category) ? $this->category->getName(): $this->topCategory->getName());
        $this->getResponse()->addMeta('keywords', ($this->category) ? $this->category->getName(): $this->topCategory->getName());

        $this->pager = new sfPropelPager('Product', sfConfig::get('app_products_per_page'));
        $this->pager->setCriteria( ProductPeer::getProductsByCarLabelCategoryCriteria( $this->label->getId(), $this->topCategory->getId(), ($this->category) ? $this->category->getId(): null ) );
        $this->pager->setPage( $request->getParameter('page', 1) );
        $this->pager->init();

//        check existing page
        $this->workoutPage();
    }

    public function executeProduct(sfWebRequest $request) {
        $this->getUser()->setAttribute('search', array());

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
            )
        );
        if ($this->topCategory) {
            $this->breadcrumb[] = array(
                    'link' => '@zapchasti_label_category?car_label='.$this->label->getSlug().'&category='.$this->topCategory->getSlug(),
                    'title' => $this->topCategory->getName()
                );
        }
        $this->breadcrumb[] = array(
                'link' => '@zapchasti_label_category?car_label='.$this->label->getSlug().'&category='.$this->category->getSlug(),
                'title' => $this->category->getName()
            );
        $this->breadcrumb[] = array(
                'link' => null,
                'title' => $this->product->getName()
            );

        $this->getResponse()->setTitle($this->product->getName());
        $this->getResponse()->addMeta('description', $this->product->getName());
        $this->getResponse()->addMeta('keywords', $this->product->getName());

//        check existing page
        $this->workoutPage();
    }

    public function executeSearch(sfWebRequest $request) {
        // retrieve search params
        $search = $request->getPostParameter('search',
            $this->getUser()->getAttribute('search', null)
        );

        // clean-up params
        $list = array('check', 'car_label', 'uid', 'name');
        $search = is_null($search) ? array(): $search;
        foreach ($list as $index) {
            $search[$index] = isset($search[$index]) ? trim($search[$index]): '';
        }

        // check human
        if (is_null($this->getUser()->getAttribute('search_key')) ||
            (!empty($search['check']) && $search['check'] != $this->getUser()->getAttribute('search_key')) ||
            empty($search['car_label']) || strlen($search['uid'].$search['name']) == 0) {
            $this->redirect('zapchasti_label', array('car_label' => $request->getParameter('car_label')));
        }

        // set session
        unset($search['check']);
        $this->getUser()->setAttribute('search', $search);

        // redirect to correct label, if there is a necessity
        if ($request->getParameter('car_label') != $search['car_label']) {
            $this->redirect('zapchasti_label_search', array('car_label' => $search['car_label']));
        }

        $this->label = CarLabelPeer::retrieveBySlug($request->getParameter('car_label'));

        $this->pager = new sfPropelPager('Product', sfConfig::get('app_products_per_page'));
        $this->pager->setCriteria( ProductPeer::getProductsBySearchCriteria( $this->label->getId(), str_replace(' ', '', $search['uid']), $search['name'] ) );
        $this->pager->setPage( $request->getParameter('page', 1) );
        $this->pager->init();

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
                'link' => null,
                'title' => 'Поиск'
            )
        );

        $this->getResponse()->setTitle($this->label->getName().' Поиск');
        $this->getResponse()->addMeta('description', $this->label->getName());
        $this->getResponse()->addMeta('keywords', $this->label->getName());

        $this->workoutPage();
    }

    public function executeAddToCart(sfWebRequest $request) {
        // check only ajax
        if (!$request->isXmlHttpRequest())
            return $this->redirect('content_page404');

        $this->label = CarLabelPeer::retrieveBySlug($request->getParameter('car_label'));
        $this->product = ProductPeer::retrieveBySlug($request->getParameter('product'));
        $this->amount = $request->getPostParameter('amount', 1);

        $response = array('amount' => 0);
        if (
            $this->label instanceof CarLabel &&
            $this->product instanceof Product &&
            is_numeric($this->amount)
        ) {
            $stored = $this->getUser()->getAttribute('cart', array());
            $index = 'cl'.$this->label->getId().'p'.$this->product->getId();
            if (isset($stored[$index])) {
                $stored[$index]['amount'] += $this->amount;
            } else {
                $this->category = $this->product->getCategory();
                $stored[$index] = array(
                    'label' => $this->label->toArray(BasePeer::TYPE_FIELDNAME),
                    'category' => $this->category->toArray(BasePeer::TYPE_FIELDNAME),
                    'product' => $this->product->toArray(BasePeer::TYPE_FIELDNAME),
                    'amount' => $this->amount
                );
            }
            $this->getUser()->setAttribute('cart', $stored);
            $response['amount'] = count($stored);
        } else {
            $this->getResponse()->setStatusCode(404, 'Not found');
            return sfView::HEADER_ONLY;
        }

        return $this->renderText(json_encode($response));
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

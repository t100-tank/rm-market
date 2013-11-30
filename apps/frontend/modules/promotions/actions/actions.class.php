<?php

/**
 * promotions actions.
 *
 * @package    rm-market
 * @subpackage promotions
 * @author     Arij
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class promotionsActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->page = PagesPeer::retrieveBySlug('/'.PagesPeer::PROMOTIONS);
        
        if (is_object($this->page)) {
            $this->getResponse()->setTitle($this->page->getTitle());
            $this->getResponse()->addMeta('description', $this->page->getMetaDescription());
            $this->getResponse()->addMeta('keywords', $this->page->getMetaKeywords());
        } else {
            $this->getResponse()->setTitle('Акции');
        }
        
        $this->breadcrumb = array(
            array(
                'link' => '@homepage',
                'title' => 'Главная'
            ),
            array(
                'link' => null,
                'title' => is_object($this->page) ? $this->page->getBreadcrumb(): 'Акции'
            )
        );
        
        $this->list = AdvertisePeer::retrieveActive();
    }
    
    public function executeShow(sfWebRequest $request) {
        $this->promo = AdvertisePeer::retrieveBySlug($request->getParameter('slug'));
        if (!is_object($this->promo) || ($this->promo instanceof Advertise && !$this->promo->getIsActive())) {
            $this->redirect404();
        }
        
        $this->promoPage = PagesPeer::retrieveBySlug('/'.PagesPeer::PROMOTIONS);
        $this->page = PagesPeer::retrieveBySlug('/'.PagesPeer::PROMOTIONS.$this->promo->getSlug().'/');
        $this->breadcrumb = array(
            array(
                'link' => '@homepage',
                'title' => 'Главная'
            ),
            array(
                'link' => '@promotions',
                'title' => is_object($this->promoPage) ? $this->promoPage->getBreadcrumb(): 'Акции'
            ),
            array(
                'link' => null,
                'title' => is_object($this->page) ? $this->page->getBreadcrumb(): $this->promo->getTitle()
            )
        );
    }

}

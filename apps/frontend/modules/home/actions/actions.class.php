<?php

/**
 * home actions.
 *
 * @package    rm-market
 * @subpackage home
 * @author     Arij
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions {
    public function preExecute() {
        parent::preExecute();
        $this->getContext()->getConfiguration()->loadHelpers(array('Url', 'UrlExt'));
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->page = PagesPeer::retrieveBySlug('/');
        if ($this->page instanceof Pages) {
            $this->getResponse()->setTitle($this->page->getTitle());
            $this->getResponse()->addMeta('description', $this->page->getMetaDescription());
            $this->getResponse()->addMeta('keywords', $this->page->getMetaKeywords());
        }
    }
    
    public function executePage(sfWebRequest $request) {
        $slug = '/'.preg_replace("/^\/*/", '', $request->getParameter('slug'));
        $this->page = PagesPeer::retrieveBySlug($slug);
        
        if ($slug == '/'.PagesPeer::SLUG_404)
            $this->getResponse()->setStatusCode(404, '');
        if (!($this->page instanceof Pages))
            $this->redirect(url_for_ext('@content_page?slug='.PagesPeer::SLUG_404), 404);
        
        if ($this->page->getOldLink() == $slug && $this->page->is301() && $this->page->getOldLink() != $this->page->getSlug())
            $this->redirect(url_for_ext('@content_page?slug='.$this->page->getTrimmedSlug()), 301);
        
        $this->getResponse()->setTitle($this->page->getTitle());
        $this->getResponse()->addMeta('description', $this->page->getMetaDescription());
        $this->getResponse()->addMeta('keywords', $this->page->getMetaKeywords());
        
        $breadcrumb = json_decode($this->page->getBreadcrumb(), true);
        $this->breadcrumb = array(
            array(
                'link' => '@homepage',
                'title' => 'Главная'
            )
        );
        if (is_array($breadcrumb)) {
            foreach ($breadcrumb as $item) {
                $this->breadcrumb[] = array(
                    'link' => (!empty($item['link'])) ? $item['link']: null,
                    'title' => (!empty($item['title'])) ? $item['title']: ''
                );
            }
        } else {
            $this->breadcrumb[] = array(
                    'link' => null,
                    'title' => $this->page->getBreadcrumb()
            );
        }
    }
    
    public function executePage404(sfWebRequest $request) {
        $this->redirect(url_for_ext('@content_page?slug='.PagesPeer::SLUG_404));
    }

}

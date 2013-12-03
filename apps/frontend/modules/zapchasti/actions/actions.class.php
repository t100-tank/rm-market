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

    public function executeIndex(sfWebRequest $request) {

    }

    public function executeLabel(sfWebRequest $request) {
        $this->label = CarLabelPeer::retrieveBySlug($request->getParameter('car_label'));
        if (!$this->label)
            $this->redirect404();

        $opt = $this->getContext()->getRouting()->getOptions('context');
        $link = $opt['context']['path_info'];
        $this->page = PagesPeer::retrieveBySlug($link);

        $this->breadcrumb = array(
            array(
                'link' => '@homepage',
                'title' => 'Главная'
            )
        );
        if ($this->page instanceof Pages) {
            $this->getResponse()->setTitle($this->page->getTitle());
            $this->getResponse()->addMeta('description', $this->page->getMetaDescription());
            $this->getResponse()->addMeta('keywords', $this->page->getMetaKeywords());

            $breadcrumb = json_decode($this->page->getBreadcrumb(), true);
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
        } else {
            $this->getResponse()->setTitle($this->label->getName());
            $this->getResponse()->addMeta('description', $this->label->getName());
            $this->getResponse()->addMeta('keywords', $this->label->getName());

            $this->breadcrumb[] = array(
                    'link' => '@zapchasti',
                    'title' => 'Автозапчасти'
                );
            $this->breadcrumb[] = array(
                    'link' => null,
                    'title' => $this->label->getName()
                );
        }

    }

}

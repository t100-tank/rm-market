<?php

/**
 * my actions.
 *
 * @package    rm-market
 * @subpackage my
 * @author     Arij
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myActions extends sfActions
{
    public function executeCart(sfWebRequest $request) {
        $this->products = $this->getUser()->getAttribute('cart');
        if (empty($this->products)) {
            if ($request->isXmlHttpRequest()) {
                $this->getResponse()->clearHeaders();
                $this->getResponse()->setStatusCode('404', 'Not found');
                return sfView::HEADER_ONLY;
            } else {
                $this->redirect('homepage');
            }
        }
    }
}

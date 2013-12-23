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
        $this->isFromOrder = $this->getUser()->getAttribute('order', 0) == 1;
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

    public function executeRemove(sfWebRequest $request) {
        $index = $request->getParameter('index');
        $products = $this->getUser()->getAttribute('cart', array());
        if (isset($products[$index])) {
            unset($products[$index]);
        }
        $response = array(
            'amount' => count($products),
            'sum' => 0
        );
        if ($response['amount'] != 0) {
            $sum = 0;
            foreach ($products as $index => $product) {
                $sum += $product['product']['distrib_price']*$product['amount'];
            }
            $response['sum'] = sprintf('%.2f', $sum).'р.';
            $this->getUser()->setAttribute('cart', $products);
        } else {
            $this->getUser()->getAttributeHolder()->remove('cart');
        }
        return $this->renderText(json_encode($response));
    }

    public function executeOrder(sfWebRequest $request) {
        $this->products = $this->getUser()->getAttribute('cart');
        if (!count($this->products)) {
            $this->redirect( $request->getReferer() ?
                $request->getReferer():
                'homepage'
            );
        }

        $this->hasProducts = $this->getUser()->hasAttribute('cart');

        $this->form = ServiceFormPeer::retrieveByName('order');

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
                'title' => 'Оформление заказа'
            )
        );
    }

    public function executeUpdateProducts(sfWebRequest $request) {
        $this->products = $this->getUser()->getAttribute('cart');
        $this->hasProducts = $this->getUser()->hasAttribute('cart');
    }

    public function executeSet(sfWebRequest $request) {
        $this->products = $this->getUser()->getAttribute('cart');
        $this->index = $request->getParameter('index');
        $this->amount = $request->getPostParameter('amount');
        $return = array(
            'amount' => null,
            'price' => null,
            'total' => null
        );
        if ($this->products && isset($this->products[$this->index])) {
            $this->products[$this->index]['amount'] = $this->amount;
            $this->getUser()->setAttribute('cart', $this->products);

            $return['amount'] = $this->products[$this->index]['amount'];
            $return['price'] = $this->products[$this->index]['amount'] * $this->products[$this->index]['product']['distrib_price'];

            $return['total'] = 0;
            foreach ($this->products as $index => $p) {
                $return['total'] += $p['amount'] * $p['product']['distrib_price'];
            }
            $return['price'] = sprintf('%.2f', $return['price']);
            $return['total'] = sprintf('%.2f', $return['total']).'р.';
        }
        return $this->renderText(json_encode($return));
    }
}

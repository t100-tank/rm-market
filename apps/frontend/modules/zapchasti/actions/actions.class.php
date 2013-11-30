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
        $label = CarLabelPeer::retrieveBySlug($request->getParameter('car_label'));
        if (!$label)
            $this->redirect404();
    }

}

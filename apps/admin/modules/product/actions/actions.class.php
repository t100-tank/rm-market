<?php

require_once dirname(__FILE__).'/../lib/productGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/productGeneratorHelper.class.php';

/**
 * product actions.
 *
 * @package    rm-market
 * @subpackage product
 * @author     Arij
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class productActions extends autoProductActions
{
    public function preExecute() {
        parent::preExecute();
        if (!$this->getUser()->getGuardUser()->hasPermission('zapchasti')) {
            $this->redirect('@homepage');
        }
    }
}

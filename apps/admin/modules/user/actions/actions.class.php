<?php

require_once dirname(__FILE__) . '/../lib/userGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/userGeneratorHelper.class.php';

/**
 * user actions.
 *
 * @package    rm-market
 * @subpackage user
 * @author     Arij
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class userActions extends autoUserActions {
    
    public function preExecute() {
        parent::preExecute();
        if (!$this->getUser()->getGuardUser()->hasPermission('users')) {
            $this->redirect('@homepage');
        }
    }
}

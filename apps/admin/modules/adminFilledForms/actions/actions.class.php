<?php

require_once dirname(__FILE__) . '/../lib/adminFilledFormsGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/adminFilledFormsGeneratorHelper.class.php';

/**
 * adminFilledForms actions.
 *
 * @package    rm-market
 * @subpackage adminFilledForms
 * @author     Arij
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class adminFilledFormsActions extends autoAdminFilledFormsActions {
    
    public function preExecute() {
        parent::preExecute();
        if (!$this->getUser()->getGuardUser()->hasPermission('forms')) {
            $this->redirect('@homepage');
        }
    }
    
}

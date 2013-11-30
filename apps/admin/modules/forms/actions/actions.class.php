<?php

require_once dirname(__FILE__) . '/../lib/formsGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/formsGeneratorHelper.class.php';

/**
 * forms actions.
 *
 * @package    rm-market
 * @subpackage forms
 * @author     Arij
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class formsActions extends autoFormsActions {
    
    public function preExecute() {
        parent::preExecute();
        if (!$this->getUser()->getGuardUser()->hasPermission('forms')) {
            $this->redirect('@homepage');
        }
    }

    public function executeListFields(sfWebRequest $request) {
        $this->redirect('@field_filter?field_filters[form_id]=' . $this->getRoute()->getObject()->getId());
    }

}

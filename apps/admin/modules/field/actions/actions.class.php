<?php

require_once dirname(__FILE__) . '/../lib/fieldGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/fieldGeneratorHelper.class.php';

/**
 * field actions.
 *
 * @package    rm-market
 * @subpackage field
 * @author     Arij
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class fieldActions extends autoFieldActions {
    
    public function preExecute() {
        parent::preExecute();
        if (!$this->getUser()->getGuardUser()->hasPermission('forms')) {
            $this->redirect('@homepage');
        }

        $filters = $this->getFilters();
        if (empty($filters['form_id']) && $this->getRequest()->getParameter('action') != 'filter')
            $this->redirect('@service_form');
    }

    public function executeIndex(sfWebRequest $request) {
        $filters = $this->getFilters();
//        if (empty)
        parent::executeIndex($request);
    }

    public function executeNew(sfWebRequest $request) {
        $fieldForm = get_class($this->configuration->getForm());

        $filters = $this->getFilters();
        $field = new Field();
        $field->setSort(FieldPeer::getMaxSort($filters['form_id']));
        $field->setFormId($filters['form_id']);
        $this->form = new $fieldForm($field);
        $this->field = $field;
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();
        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        if ($this->getRoute()->getObject()->getIsDeletable()) {
            $this->getRoute()->getObject()->delete();
            $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }
        $this->redirect('@field');
    }

}

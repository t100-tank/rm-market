<?php

require_once dirname(__FILE__) . '/../lib/operatorFilledFormsGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/operatorFilledFormsGeneratorHelper.class.php';

/**
 * operatorFilledForms actions.
 *
 * @package    rm-market
 * @subpackage operatorFilledForms
 * @author     Arij
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class operatorFilledFormsActions extends autoOperatorFilledFormsActions {

    public function preExecute() {
        parent::preExecute();
        if (!$this->getUser()->getGuardUser()->hasPermission('form_respondent') ||
                !in_array($this->getRequest()->getParameter('action'), array('index', 'ListOperate', 'status', 'bind', 'change'))
        ) {
            $this->redirect('@homepage');
        }
    }

    public function executeListOperate(sfWebRequest $request) {
        $this->filled = $this->getRoute()->getObject();
    }

    public function executeStatus(sfWebRequest $request) {
        $this->filled = FilledFormPeer::retrieveByPK($request->getParameter('id'));
        $this->setting = $request->getParameter('setting');
//        if (!$request->isXmlHttpRequest()) $this->redirect404();
        
        if (!$request->isMethod('post')) {
            $this->filled->setIsClosed($this->setting == 'close');
            $this->form = new OperatorFilledFormForm($this->filled);
        } else {
            $this->form = $this->configuration->getForm($this->filled);
            $this->form->bind($request->getParameter($this->form->getName()));
            if ($this->form->isValid()) {
                $this->form->save();
                $this->getUser()->setFlash('notice', 'Статус сменен');
            } else {
                $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
            }
            $this->redirect('@filled_form_operatorFilledForms');
        }
    }

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }
    
    public function executeBind(sfWebRequest $request) {
        $filled = FilledFormPeer::retrieveByPK($request->getParameter('id'));
        $bind = (bool)$request->getParameter('binding');
        if (!$filled) {
        } else {
            $operator = $this->getUser()->getGuardUser();
            if ($operator->hasPermission('form_respondent')) {
                if ($bind && is_null($filled->getOperatorId())) {
                    $filled->setOperatorId($operator->getId());
                    $filled->save();
                    $this->getUser()->setFlash('notice', 'The item was updated successfully.');
                } else if (!$bind && ($filled->getOperatorId() == $operator->getId())) {
                    $filled->setOperatorId(null);
                    $filled->save();
                    $this->getUser()->setFlash('notice', 'The item was updated successfully.');
                }
            } else {
            }
        }
        $this->redirect($request->getReferer());
    }
    
    public function executeChange(sfWebRequest $request) {
        $this->filled = FilledFormPeer::retrieveByPK($request->getParameter('id'));
        if ($this->getUser()->getGuardUser()->hasPermission('forms') && is_object($this->filled)) {
            if ($request->isMethod('post')) {
                $operator = sfGuardUserPeer::retrieveByPK($request->getParameter('operator_id'));
                if ($operator) {
                    if ($operator->hasPermission('form_respondent')) {
                        $this->filled->setOperatorId($operator->getId());
                        $this->filled->save();
                        $this->getUser()->setFlash('notice', 'The item was updated successfully.');
                    }
                } else {
                    if (!(int)$request->getParameter('operator_id')) {
                        $this->filled->setOperatorId(null);
                        $this->filled->save();
                        $this->getUser()->setFlash('notice', 'The item was updated successfully.');
                    }
                }
                $this->redirect($request->getReferer());
            }
        } else {
            $this->redirect($request->getReferer());
        }
        
        $this->opList = sfGuardUserPeer::retrieveAllByPermission('form_respondent');
    }

    protected function getPager() {
        $pager = $this->configuration->getPager('FilledForm');
        $pager->setCriteria($this->buildCriteria());
        $pager->setPage($this->getPage());
        $pager->setPeerMethod($this->configuration->getPeerMethod());
        $pager->setPeerCountMethod($this->configuration->getPeerCountMethod());
        $pager->init();

        return $pager;
    }

    protected function buildCriteria() {
        $criteria = new Criteria();
        
        if (!$this->getUser()->getGuardUser()->getIsSuperAdmin()) {
            $cr1 = $criteria->getNewCriterion(FilledFormPeer::OPERATOR_ID, $this->getUser()->getGuardUser()->getId());
            $cr2 = $criteria->getNewCriterion(FilledFormPeer::OPERATOR_ID, null, Criteria::ISNULL);
            $cr1->addOr($cr2);
            $criteria->add($cr1);
        }

        $this->addSortCriteria($criteria);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
        $criteria = $event->getReturnValue();

        return $criteria;
    }

}

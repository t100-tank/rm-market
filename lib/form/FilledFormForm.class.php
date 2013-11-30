<?php

/**
 * FilledForm form.
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
class FilledFormForm extends BaseFilledFormForm
{
  public function configure()
  {
      $c = new Criteria();
      $c->addJoin(sfGuardUserPeer::ID, sfGuardUserPermissionPeer::USER_ID, Criteria::LEFT_JOIN);
      $c->addJoin(sfGuardUserPeer::ID, sfGuardUserGroupPeer::USER_ID, Criteria::LEFT_JOIN);
      $c->addJoin(sfGuardUserGroupPeer::GROUP_ID, sfGuardGroupPermissionPeer::GROUP_ID, Criteria::LEFT_JOIN);
      
      $c1 = $c->getNewCriterion(sfGuardUserPeer::IS_SUPER_ADMIN, true);
      $c2 = $c->getNewCriterion(sfGuardUserPermissionPeer::PERMISSION_ID, 4); // form_respondent
      $c3 = $c->getNewCriterion(sfGuardGroupPermissionPeer::PERMISSION_ID, 4); // form_respondent
      $c1->addOr($c2);
      $c1->addOr($c3);
      $c->add($c1);
      
      $this->widgetSchema['operator_id']->addOption('criteria', $c);
      
      $this->widgetSchema['created_at']->setOption('date', array('format' => '%day%.%month%.%year%'));
      $this->widgetSchema['updated_at']->setOption('date', array('format' => '%day%.%month%.%year%'));
  }
}

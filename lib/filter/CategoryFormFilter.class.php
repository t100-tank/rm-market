<?php

/**
 * Category filter form.
 *
 * @package    rm-market
 * @subpackage filter
 * @author     Arij
 */
class CategoryFormFilter extends BaseCategoryFormFilter
{
  public function configure()
  {
      $c = new Criteria();
      $c->add(CategoryPeer::PARENT_ID, null, Criteria::ISNULL);
      $this->widgetSchema['parent_id'] = new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true, 'criteria' => $c));
  }
}

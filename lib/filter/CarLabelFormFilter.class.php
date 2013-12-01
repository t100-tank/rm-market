<?php

/**
 * CarLabel filter form.
 *
 * @package    rm-market
 * @subpackage filter
 * @author     Arij
 */
class CarLabelFormFilter extends BaseCarLabelFormFilter
{
  public function configure()
  {
      $this->useFields(array(
          'parent_id',
          'slug',
          'name',
          'car_category_list'
      ));
      $this->widgetSchema['car_category_list'] = new sfWidgetFormChoice(array('choices' => CategoryPeer::getSelectTree(true), 'translate_choices' => false));
  }
}

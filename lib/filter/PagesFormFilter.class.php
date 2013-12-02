<?php

/**
 * Pages filter form.
 *
 * @package    rm-market
 * @subpackage filter
 * @author     Arij
 */
class PagesFormFilter extends BasePagesFormFilter
{
  public function configure()
  {
      $this->widgetSchema['type'] = new sfWidgetFormChoice(array('choices' => array_combine(PagesPeer::$types, PagesPeer::$types))); // check for blank
  }
}

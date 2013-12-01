<?php

/**
 * Pages form.
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
class PagesForm extends BasePagesForm
{
  public function configure()
  {
      $this->widgetSchema['body'] = new sfWidgetFormTextareaTinyMCE();
      $this->widgetSchema['type'] = new sfWidgetFormChoice(array('choices' => array_combine(PagesPeer::$types, PagesPeer::$types))); // check for blank
  }
}

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
  }
}

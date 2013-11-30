<?php

/**
 * ServiceForm form.
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
class ServiceFormForm extends BaseServiceFormForm {

    public function configure() {
        $this->widgetSchema['user_body'] = new sfWidgetFormTextareaTinyMCE();
        $this->widgetSchema['operator_body'] = new sfWidgetFormTextareaTinyMCE();
    }

}

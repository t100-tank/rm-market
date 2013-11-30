<?php

/**
 * Field filter form.
 *
 * @package    rm-market
 * @subpackage filter
 * @author     Arij
 */
class FieldFormFilter extends BaseFieldFormFilter {

    public function configure() {
        $this->disableLocalCSRFProtection();
        
        $this->widgetSchema['type'] = new sfWidgetFormChoice(array('choices' => FieldPeer::getFieldTypes()));
    }

}

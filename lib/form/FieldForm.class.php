<?php

/**
 * Field form.
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
class FieldForm extends BaseFieldForm {

    public function configure() {
        $this->useFields(array(
            'id',
            'form_id',
            'is_required',
            'sort',
            'type',
            'variants',
            'field_name',
            'title',
            'tip'
        ));

        $this->widgetSchema['type'] = new sfWidgetFormChoice(array('choices' => FieldPeer::getFieldTypes()));
    }

}

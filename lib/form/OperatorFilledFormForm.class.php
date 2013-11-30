<?php

/**
 * FilledForm form.
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
class OperatorFilledFormForm extends FilledFormForm {

    public function configure() {
        $this->useFields(array(
            'id',
            'is_closed',
            'notes'
        ));
        $this->widgetSchema['is_closed'] = new sfWidgetFormInputHidden();
    }

}

<?php

/**
 * FilledForm form base class.
 *
 * @method FilledForm getObject() Returns the current form's model object
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
abstract class BaseFilledFormForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'form_id'            => new sfWidgetFormPropelChoice(array('model' => 'ServiceForm', 'add_empty' => false)),
      'inner_id'           => new sfWidgetFormInputText(),
      'operator_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'operator_mail_sent' => new sfWidgetFormInputCheckbox(),
      'user_mail_sent'     => new sfWidgetFormInputCheckbox(),
      'name'               => new sfWidgetFormInputText(),
      'email'              => new sfWidgetFormInputText(),
      'phone'              => new sfWidgetFormInputText(),
      'referer'            => new sfWidgetFormInputText(),
      'data'               => new sfWidgetFormTextarea(),
      'is_closed'          => new sfWidgetFormInputCheckbox(),
      'notes'              => new sfWidgetFormTextarea(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'form_id'            => new sfValidatorPropelChoice(array('model' => 'ServiceForm', 'column' => 'id')),
      'inner_id'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'operator_id'        => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'operator_mail_sent' => new sfValidatorBoolean(),
      'user_mail_sent'     => new sfValidatorBoolean(),
      'name'               => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'email'              => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'phone'              => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'referer'            => new sfValidatorString(array('max_length' => 250)),
      'data'               => new sfValidatorString(),
      'is_closed'          => new sfValidatorBoolean(),
      'notes'              => new sfValidatorString(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(array('required' => false)),
      'updated_at'         => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('filled_form[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilledForm';
  }


}

<?php

/**
 * ServiceForm form base class.
 *
 * @method ServiceForm getObject() Returns the current form's model object
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
abstract class BaseServiceFormForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInputText(),
      'title'            => new sfWidgetFormInputText(),
      'auto_inc'         => new sfWidgetFormInputText(),
      'success_message'  => new sfWidgetFormInputText(),
      'user_subject'     => new sfWidgetFormInputText(),
      'user_body'        => new sfWidgetFormTextarea(),
      'operator_email'   => new sfWidgetFormInputText(),
      'operator_subject' => new sfWidgetFormInputText(),
      'operator_body'    => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 250)),
      'title'            => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'auto_inc'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'success_message'  => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'user_subject'     => new sfValidatorString(array('max_length' => 250)),
      'user_body'        => new sfValidatorString(array('required' => false)),
      'operator_email'   => new sfValidatorString(array('max_length' => 250)),
      'operator_subject' => new sfValidatorString(array('max_length' => 250)),
      'operator_body'    => new sfValidatorString(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'ServiceForm', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('service_form[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ServiceForm';
  }


}

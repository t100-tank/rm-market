<?php

/**
 * Field form base class.
 *
 * @method Field getObject() Returns the current form's model object
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
abstract class BaseFieldForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'form_id'      => new sfWidgetFormPropelChoice(array('model' => 'ServiceForm', 'add_empty' => false)),
      'is_required'  => new sfWidgetFormInputCheckbox(),
      'is_deletable' => new sfWidgetFormInputCheckbox(),
      'sort'         => new sfWidgetFormInputText(),
      'type'         => new sfWidgetFormInputText(),
      'field_name'   => new sfWidgetFormInputText(),
      'title'        => new sfWidgetFormInputText(),
      'tip'          => new sfWidgetFormInputText(),
      'variants'     => new sfWidgetFormTextarea(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'form_id'      => new sfValidatorPropelChoice(array('model' => 'ServiceForm', 'column' => 'id')),
      'is_required'  => new sfValidatorBoolean(),
      'is_deletable' => new sfValidatorBoolean(),
      'sort'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'type'         => new sfValidatorString(array('max_length' => 10)),
      'field_name'   => new sfValidatorString(array('max_length' => 30)),
      'title'        => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'tip'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'variants'     => new sfValidatorString(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Field', 'column' => array('form_id', 'field_name')))
    );

    $this->widgetSchema->setNameFormat('field[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Field';
  }


}

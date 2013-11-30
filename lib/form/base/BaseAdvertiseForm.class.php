<?php

/**
 * Advertise form base class.
 *
 * @method Advertise getObject() Returns the current form's model object
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
abstract class BaseAdvertiseForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'slug'         => new sfWidgetFormInputText(),
      'is_on_slider' => new sfWidgetFormInputCheckbox(),
      'is_active'    => new sfWidgetFormInputCheckbox(),
      'slider_image' => new sfWidgetFormInputText(),
      'slider_h1'    => new sfWidgetFormInputText(),
      'slider_text'  => new sfWidgetFormInputText(),
      'title'        => new sfWidgetFormInputText(),
      'h1'           => new sfWidgetFormInputText(),
      'short_text'   => new sfWidgetFormTextarea(),
      'description'  => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'slug'         => new sfValidatorString(array('max_length' => 250)),
      'is_on_slider' => new sfValidatorBoolean(),
      'is_active'    => new sfValidatorBoolean(),
      'slider_image' => new sfValidatorString(array('max_length' => 60)),
      'slider_h1'    => new sfValidatorString(array('max_length' => 150)),
      'slider_text'  => new sfValidatorString(array('max_length' => 250)),
      'title'        => new sfValidatorString(array('max_length' => 250)),
      'h1'           => new sfValidatorString(array('max_length' => 250)),
      'short_text'   => new sfValidatorString(),
      'description'  => new sfValidatorString(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Advertise', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('advertise[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Advertise';
  }


}

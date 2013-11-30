<?php

/**
 * CarProduct form base class.
 *
 * @method CarProduct getObject() Returns the current form's model object
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
abstract class BaseCarProductForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'car_id'     => new sfWidgetFormInputHidden(),
      'product_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'car_id'     => new sfValidatorPropelChoice(array('model' => 'CarLabel', 'column' => 'id', 'required' => false)),
      'product_id' => new sfValidatorPropelChoice(array('model' => 'Product', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('car_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CarProduct';
  }


}

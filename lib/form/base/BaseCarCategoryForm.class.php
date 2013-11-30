<?php

/**
 * CarCategory form base class.
 *
 * @method CarCategory getObject() Returns the current form's model object
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
abstract class BaseCarCategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'car_id'      => new sfWidgetFormInputHidden(),
      'category_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'car_id'      => new sfValidatorPropelChoice(array('model' => 'CarLabel', 'column' => 'id', 'required' => false)),
      'category_id' => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('car_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CarCategory';
  }


}

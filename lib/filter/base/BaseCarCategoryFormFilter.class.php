<?php

/**
 * CarCategory filter form base class.
 *
 * @package    rm-market
 * @subpackage filter
 * @author     Arij
 */
abstract class BaseCarCategoryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('car_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CarCategory';
  }

  public function getFields()
  {
    return array(
      'car_id'      => 'ForeignKey',
      'category_id' => 'ForeignKey',
    );
  }
}

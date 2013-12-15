<?php

/**
 * CarLabel filter form base class.
 *
 * @package    rm-market
 * @subpackage filter
 * @author     Arij
 */
abstract class BaseCarLabelFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'parent_id'         => new sfWidgetFormPropelChoice(array('model' => 'CarLabel', 'add_empty' => true)),
      'slug'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'car_category_list' => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
      'car_product_list'  => new sfWidgetFormPropelChoice(array('model' => 'Product', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'parent_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'CarLabel', 'column' => 'id')),
      'slug'              => new sfValidatorPass(array('required' => false)),
      'name'              => new sfValidatorPass(array('required' => false)),
      'car_category_list' => new sfValidatorPropelChoice(array('model' => 'Category', 'required' => false)),
      'car_product_list'  => new sfValidatorPropelChoice(array('model' => 'Product', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('car_label_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addCarCategoryListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(CarCategoryPeer::CAR_ID, CarLabelPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(CarCategoryPeer::CATEGORY_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(CarCategoryPeer::CATEGORY_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addCarProductListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(CarProductPeer::CAR_ID, CarLabelPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(CarProductPeer::PRODUCT_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(CarProductPeer::PRODUCT_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'CarLabel';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'parent_id'         => 'ForeignKey',
      'slug'              => 'Text',
      'name'              => 'Text',
      'car_category_list' => 'ManyKey',
      'car_product_list'  => 'ManyKey',
    );
  }
}

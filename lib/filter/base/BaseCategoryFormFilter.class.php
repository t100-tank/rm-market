<?php

/**
 * Category filter form base class.
 *
 * @package    rm-market
 * @subpackage filter
 * @author     Arij
 */
abstract class BaseCategoryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'parent_id'         => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
      'slug'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'car_category_list' => new sfWidgetFormPropelChoice(array('model' => 'CarLabel', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'parent_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Category', 'column' => 'id')),
      'slug'              => new sfValidatorPass(array('required' => false)),
      'name'              => new sfValidatorPass(array('required' => false)),
      'car_category_list' => new sfValidatorPropelChoice(array('model' => 'CarLabel', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('category_filters[%s]');

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

    $criteria->addJoin(CarCategoryPeer::CATEGORY_ID, CategoryPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(CarCategoryPeer::CAR_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(CarCategoryPeer::CAR_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Category';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'parent_id'         => 'ForeignKey',
      'slug'              => 'Text',
      'name'              => 'Text',
      'car_category_list' => 'ManyKey',
    );
  }
}

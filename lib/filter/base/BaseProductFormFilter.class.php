<?php

/**
 * Product filter form base class.
 *
 * @package    rm-market
 * @subpackage filter
 * @author     Arij
 */
abstract class BaseProductFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'category_id'      => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
      'amount'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'uid'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'analog_uid'       => new sfWidgetFormFilterInput(),
      'slug'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'distrib_price'    => new sfWidgetFormFilterInput(),
      'car_product_list' => new sfWidgetFormPropelChoice(array('model' => 'CarLabel', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'category_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Category', 'column' => 'id')),
      'amount'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'uid'              => new sfValidatorPass(array('required' => false)),
      'analog_uid'       => new sfValidatorPass(array('required' => false)),
      'slug'             => new sfValidatorPass(array('required' => false)),
      'name'             => new sfValidatorPass(array('required' => false)),
      'distrib_price'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'car_product_list' => new sfValidatorPropelChoice(array('model' => 'CarLabel', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('product_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
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

    $criteria->addJoin(CarProductPeer::PRODUCT_ID, ProductPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(CarProductPeer::CAR_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(CarProductPeer::CAR_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Product';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'category_id'      => 'ForeignKey',
      'amount'           => 'Number',
      'uid'              => 'Text',
      'analog_uid'       => 'Text',
      'slug'             => 'Text',
      'name'             => 'Text',
      'distrib_price'    => 'Number',
      'car_product_list' => 'ManyKey',
    );
  }
}

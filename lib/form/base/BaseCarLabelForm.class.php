<?php

/**
 * CarLabel form base class.
 *
 * @method CarLabel getObject() Returns the current form's model object
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
abstract class BaseCarLabelForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'parent_id'         => new sfWidgetFormPropelChoice(array('model' => 'CarLabel', 'add_empty' => true)),
      'slug'              => new sfWidgetFormInputText(),
      'name'              => new sfWidgetFormInputText(),
      'car_product_list'  => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Product')),
      'car_category_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Category')),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'parent_id'         => new sfValidatorPropelChoice(array('model' => 'CarLabel', 'column' => 'id', 'required' => false)),
      'slug'              => new sfValidatorString(array('max_length' => 250)),
      'name'              => new sfValidatorString(array('max_length' => 250)),
      'car_product_list'  => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Product', 'required' => false)),
      'car_category_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Category', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'CarLabel', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('car_label[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CarLabel';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['car_product_list']))
    {
      $values = array();
      foreach ($this->object->getCarProducts() as $obj)
      {
        $values[] = $obj->getProductId();
      }

      $this->setDefault('car_product_list', $values);
    }

    if (isset($this->widgetSchema['car_category_list']))
    {
      $values = array();
      foreach ($this->object->getCarCategorys() as $obj)
      {
        $values[] = $obj->getCategoryId();
      }

      $this->setDefault('car_category_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCarProductList($con);
    $this->saveCarCategoryList($con);
  }

  public function saveCarProductList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['car_product_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(CarProductPeer::CAR_ID, $this->object->getPrimaryKey());
    CarProductPeer::doDelete($c, $con);

    $values = $this->getValue('car_product_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CarProduct();
        $obj->setCarId($this->object->getPrimaryKey());
        $obj->setProductId($value);
        $obj->save();
      }
    }
  }

  public function saveCarCategoryList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['car_category_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(CarCategoryPeer::CAR_ID, $this->object->getPrimaryKey());
    CarCategoryPeer::doDelete($c, $con);

    $values = $this->getValue('car_category_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CarCategory();
        $obj->setCarId($this->object->getPrimaryKey());
        $obj->setCategoryId($value);
        $obj->save();
      }
    }
  }

}

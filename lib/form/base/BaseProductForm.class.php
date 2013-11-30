<?php

/**
 * Product form base class.
 *
 * @method Product getObject() Returns the current form's model object
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
abstract class BaseProductForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'category_id'      => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
      'amount'           => new sfWidgetFormInputText(),
      'uid'              => new sfWidgetFormInputText(),
      'analog_uid'       => new sfWidgetFormInputText(),
      'slug'             => new sfWidgetFormInputText(),
      'name'             => new sfWidgetFormInputText(),
      'distrib_price'    => new sfWidgetFormInputText(),
      'car_product_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'CarLabel')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'category_id'      => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id', 'required' => false)),
      'amount'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'uid'              => new sfValidatorString(array('max_length' => 100)),
      'analog_uid'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'slug'             => new sfValidatorString(array('max_length' => 250)),
      'name'             => new sfValidatorString(array('max_length' => 250)),
      'distrib_price'    => new sfValidatorNumber(array('required' => false)),
      'car_product_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'CarLabel', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Product', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['car_product_list']))
    {
      $values = array();
      foreach ($this->object->getCarProducts() as $obj)
      {
        $values[] = $obj->getCarId();
      }

      $this->setDefault('car_product_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCarProductList($con);
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
    $c->add(CarProductPeer::PRODUCT_ID, $this->object->getPrimaryKey());
    CarProductPeer::doDelete($c, $con);

    $values = $this->getValue('car_product_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CarProduct();
        $obj->setProductId($this->object->getPrimaryKey());
        $obj->setCarId($value);
        $obj->save();
      }
    }
  }

}

<?php

/**
 * Category form base class.
 *
 * @method Category getObject() Returns the current form's model object
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
abstract class BaseCategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'parent_id'         => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
      'slug'              => new sfWidgetFormInputText(),
      'name'              => new sfWidgetFormInputText(),
      'car_category_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'CarLabel')),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'parent_id'         => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id', 'required' => false)),
      'slug'              => new sfValidatorString(array('max_length' => 250)),
      'name'              => new sfValidatorString(array('max_length' => 250)),
      'car_category_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'CarLabel', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Category', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Category';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['car_category_list']))
    {
      $values = array();
      foreach ($this->object->getCarCategorys() as $obj)
      {
        $values[] = $obj->getCarId();
      }

      $this->setDefault('car_category_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCarCategoryList($con);
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
    $c->add(CarCategoryPeer::CATEGORY_ID, $this->object->getPrimaryKey());
    CarCategoryPeer::doDelete($c, $con);

    $values = $this->getValue('car_category_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CarCategory();
        $obj->setCategoryId($this->object->getPrimaryKey());
        $obj->setCarId($value);
        $obj->save();
      }
    }
  }

}

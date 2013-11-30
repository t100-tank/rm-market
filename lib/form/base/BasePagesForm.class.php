<?php

/**
 * Pages form base class.
 *
 * @method Pages getObject() Returns the current form's model object
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
abstract class BasePagesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'is_301redirect'   => new sfWidgetFormInputCheckbox(),
      'old_link'         => new sfWidgetFormInputText(),
      'slug'             => new sfWidgetFormInputText(),
      'title'            => new sfWidgetFormInputText(),
      'breadcrumb'       => new sfWidgetFormInputText(),
      'h1'               => new sfWidgetFormInputText(),
      'meta_keywords'    => new sfWidgetFormTextarea(),
      'meta_description' => new sfWidgetFormTextarea(),
      'body'             => new sfWidgetFormTextarea(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'is_301redirect'   => new sfValidatorBoolean(array('required' => false)),
      'old_link'         => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'slug'             => new sfValidatorString(array('max_length' => 250)),
      'title'            => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'breadcrumb'       => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'h1'               => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'meta_keywords'    => new sfValidatorString(array('required' => false)),
      'meta_description' => new sfValidatorString(array('required' => false)),
      'body'             => new sfValidatorString(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'Pages', 'column' => array('old_link'))),
        new sfValidatorPropelUnique(array('model' => 'Pages', 'column' => array('slug'))),
      ))
    );

    $this->widgetSchema->setNameFormat('pages[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pages';
  }


}

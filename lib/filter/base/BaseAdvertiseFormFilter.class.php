<?php

/**
 * Advertise filter form base class.
 *
 * @package    rm-market
 * @subpackage filter
 * @author     Arij
 */
abstract class BaseAdvertiseFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'slug'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_on_slider' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_active'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'slider_image' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slider_h1'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slider_text'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'h1'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'short_text'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'slug'         => new sfValidatorPass(array('required' => false)),
      'is_on_slider' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_active'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'slider_image' => new sfValidatorPass(array('required' => false)),
      'slider_h1'    => new sfValidatorPass(array('required' => false)),
      'slider_text'  => new sfValidatorPass(array('required' => false)),
      'title'        => new sfValidatorPass(array('required' => false)),
      'h1'           => new sfValidatorPass(array('required' => false)),
      'short_text'   => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('advertise_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Advertise';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'slug'         => 'Text',
      'is_on_slider' => 'Boolean',
      'is_active'    => 'Boolean',
      'slider_image' => 'Text',
      'slider_h1'    => 'Text',
      'slider_text'  => 'Text',
      'title'        => 'Text',
      'h1'           => 'Text',
      'short_text'   => 'Text',
      'description'  => 'Text',
    );
  }
}

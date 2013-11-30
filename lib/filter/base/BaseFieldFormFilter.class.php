<?php

/**
 * Field filter form base class.
 *
 * @package    rm-market
 * @subpackage filter
 * @author     Arij
 */
abstract class BaseFieldFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'form_id'      => new sfWidgetFormPropelChoice(array('model' => 'ServiceForm', 'add_empty' => true)),
      'is_required'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_deletable' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'sort'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'field_name'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'        => new sfWidgetFormFilterInput(),
      'tip'          => new sfWidgetFormFilterInput(),
      'variants'     => new sfWidgetFormFilterInput(),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'form_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ServiceForm', 'column' => 'id')),
      'is_required'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_deletable' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'sort'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type'         => new sfValidatorPass(array('required' => false)),
      'field_name'   => new sfValidatorPass(array('required' => false)),
      'title'        => new sfValidatorPass(array('required' => false)),
      'tip'          => new sfValidatorPass(array('required' => false)),
      'variants'     => new sfValidatorPass(array('required' => false)),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('field_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Field';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'form_id'      => 'ForeignKey',
      'is_required'  => 'Boolean',
      'is_deletable' => 'Boolean',
      'sort'         => 'Number',
      'type'         => 'Text',
      'field_name'   => 'Text',
      'title'        => 'Text',
      'tip'          => 'Text',
      'variants'     => 'Text',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}

<?php

/**
 * Pages filter form base class.
 *
 * @package    rm-market
 * @subpackage filter
 * @author     Arij
 */
abstract class BasePagesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'is_301redirect'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'old_link'         => new sfWidgetFormFilterInput(),
      'slug'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'            => new sfWidgetFormFilterInput(),
      'breadcrumb'       => new sfWidgetFormFilterInput(),
      'h1'               => new sfWidgetFormFilterInput(),
      'meta_keywords'    => new sfWidgetFormFilterInput(),
      'meta_description' => new sfWidgetFormFilterInput(),
      'body'             => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'is_301redirect'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'old_link'         => new sfValidatorPass(array('required' => false)),
      'slug'             => new sfValidatorPass(array('required' => false)),
      'title'            => new sfValidatorPass(array('required' => false)),
      'breadcrumb'       => new sfValidatorPass(array('required' => false)),
      'h1'               => new sfValidatorPass(array('required' => false)),
      'meta_keywords'    => new sfValidatorPass(array('required' => false)),
      'meta_description' => new sfValidatorPass(array('required' => false)),
      'body'             => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('pages_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pages';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'is_301redirect'   => 'Boolean',
      'old_link'         => 'Text',
      'slug'             => 'Text',
      'title'            => 'Text',
      'breadcrumb'       => 'Text',
      'h1'               => 'Text',
      'meta_keywords'    => 'Text',
      'meta_description' => 'Text',
      'body'             => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}

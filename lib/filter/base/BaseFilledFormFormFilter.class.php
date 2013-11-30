<?php

/**
 * FilledForm filter form base class.
 *
 * @package    rm-market
 * @subpackage filter
 * @author     Arij
 */
abstract class BaseFilledFormFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'form_id'            => new sfWidgetFormPropelChoice(array('model' => 'ServiceForm', 'add_empty' => true)),
      'inner_id'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'operator_id'        => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'operator_mail_sent' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'user_mail_sent'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'name'               => new sfWidgetFormFilterInput(),
      'email'              => new sfWidgetFormFilterInput(),
      'phone'              => new sfWidgetFormFilterInput(),
      'referer'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'data'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_closed'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'notes'              => new sfWidgetFormFilterInput(),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'form_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ServiceForm', 'column' => 'id')),
      'inner_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'operator_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'operator_mail_sent' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'user_mail_sent'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'name'               => new sfValidatorPass(array('required' => false)),
      'email'              => new sfValidatorPass(array('required' => false)),
      'phone'              => new sfValidatorPass(array('required' => false)),
      'referer'            => new sfValidatorPass(array('required' => false)),
      'data'               => new sfValidatorPass(array('required' => false)),
      'is_closed'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'notes'              => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('filled_form_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilledForm';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'form_id'            => 'ForeignKey',
      'inner_id'           => 'Number',
      'operator_id'        => 'ForeignKey',
      'operator_mail_sent' => 'Boolean',
      'user_mail_sent'     => 'Boolean',
      'name'               => 'Text',
      'email'              => 'Text',
      'phone'              => 'Text',
      'referer'            => 'Text',
      'data'               => 'Text',
      'is_closed'          => 'Boolean',
      'notes'              => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}

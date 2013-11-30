<?php

/**
 * ServiceForm filter form base class.
 *
 * @package    rm-market
 * @subpackage filter
 * @author     Arij
 */
abstract class BaseServiceFormFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'            => new sfWidgetFormFilterInput(),
      'auto_inc'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'success_message'  => new sfWidgetFormFilterInput(),
      'user_subject'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_body'        => new sfWidgetFormFilterInput(),
      'operator_email'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'operator_subject' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'operator_body'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'title'            => new sfValidatorPass(array('required' => false)),
      'auto_inc'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'success_message'  => new sfValidatorPass(array('required' => false)),
      'user_subject'     => new sfValidatorPass(array('required' => false)),
      'user_body'        => new sfValidatorPass(array('required' => false)),
      'operator_email'   => new sfValidatorPass(array('required' => false)),
      'operator_subject' => new sfValidatorPass(array('required' => false)),
      'operator_body'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('service_form_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ServiceForm';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'name'             => 'Text',
      'title'            => 'Text',
      'auto_inc'         => 'Number',
      'success_message'  => 'Text',
      'user_subject'     => 'Text',
      'user_body'        => 'Text',
      'operator_email'   => 'Text',
      'operator_subject' => 'Text',
      'operator_body'    => 'Text',
    );
  }
}

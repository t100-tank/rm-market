<?php


/**
 * This class defines the structure of the 'service_form' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class ServiceFormTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ServiceFormTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('service_form');
		$this->setPhpName('ServiceForm');
		$this->setClassname('ServiceForm');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 250, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 250, null);
		$this->addColumn('AUTO_INC', 'AutoInc', 'INTEGER', true, 11, 1);
		$this->addColumn('SUCCESS_MESSAGE', 'SuccessMessage', 'VARCHAR', false, 250, null);
		$this->addColumn('USER_SUBJECT', 'UserSubject', 'VARCHAR', true, 250, null);
		$this->addColumn('USER_BODY', 'UserBody', 'LONGVARCHAR', false, null, null);
		$this->addColumn('OPERATOR_EMAIL', 'OperatorEmail', 'VARCHAR', true, 250, null);
		$this->addColumn('OPERATOR_SUBJECT', 'OperatorSubject', 'VARCHAR', true, 250, null);
		$this->addColumn('OPERATOR_BODY', 'OperatorBody', 'LONGVARCHAR', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Field', 'Field', RelationMap::ONE_TO_MANY, array('id' => 'form_id', ), 'CASCADE', null);
    $this->addRelation('FilledForm', 'FilledForm', RelationMap::ONE_TO_MANY, array('id' => 'form_id', ), 'CASCADE', null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // ServiceFormTableMap

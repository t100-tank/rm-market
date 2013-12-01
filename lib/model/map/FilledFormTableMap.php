<?php


/**
 * This class defines the structure of the 'filled_form' table.
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
class FilledFormTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.FilledFormTableMap';

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
		$this->setName('filled_form');
		$this->setPhpName('FilledForm');
		$this->setClassname('FilledForm');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('FORM_ID', 'FormId', 'INTEGER', 'service_form', 'ID', true, null, null);
		$this->addColumn('INNER_ID', 'InnerId', 'INTEGER', true, null, null);
		$this->addForeignKey('OPERATOR_ID', 'OperatorId', 'INTEGER', 'sf_guard_user', 'ID', false, null, null);
		$this->addColumn('OPERATOR_MAIL_SENT', 'OperatorMailSent', 'BOOLEAN', true, null, false);
		$this->addColumn('USER_MAIL_SENT', 'UserMailSent', 'BOOLEAN', true, null, false);
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 250, null);
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', false, 250, null);
		$this->addColumn('PHONE', 'Phone', 'VARCHAR', false, 250, null);
		$this->addColumn('REFERER', 'Referer', 'VARCHAR', true, 250, null);
		$this->addColumn('DATA', 'Data', 'LONGVARCHAR', true, null, null);
		$this->addColumn('IS_CLOSED', 'IsClosed', 'BOOLEAN', true, null, false);
		$this->addColumn('NOTES', 'Notes', 'LONGVARCHAR', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ServiceForm', 'ServiceForm', RelationMap::MANY_TO_ONE, array('form_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('sfGuardUser', 'sfGuardUser', RelationMap::MANY_TO_ONE, array('operator_id' => 'id', ), 'SET NULL', null);
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
			'symfony_timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
		);
	} // getBehaviors()

} // FilledFormTableMap

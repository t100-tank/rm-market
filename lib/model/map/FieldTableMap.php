<?php


/**
 * This class defines the structure of the 'field' table.
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
class FieldTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.FieldTableMap';

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
		$this->setName('field');
		$this->setPhpName('Field');
		$this->setClassname('Field');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('FORM_ID', 'FormId', 'INTEGER', 'service_form', 'ID', true, null, null);
		$this->addColumn('IS_REQUIRED', 'IsRequired', 'BOOLEAN', true, null, false);
		$this->addColumn('IS_DELETABLE', 'IsDeletable', 'BOOLEAN', true, null, true);
		$this->addColumn('SORT', 'Sort', 'INTEGER', true, 2, 0);
		$this->addColumn('TYPE', 'Type', 'VARCHAR', true, 10, null);
		$this->addColumn('FIELD_NAME', 'FieldName', 'VARCHAR', true, 30, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 60, null);
		$this->addColumn('TIP', 'Tip', 'VARCHAR', false, 255, null);
		$this->addColumn('VARIANTS', 'Variants', 'LONGVARCHAR', false, null, null);
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

} // FieldTableMap

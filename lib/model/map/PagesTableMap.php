<?php


/**
 * This class defines the structure of the 'pages' table.
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
class PagesTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PagesTableMap';

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
		$this->setName('pages');
		$this->setPhpName('Pages');
		$this->setClassname('Pages');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('IS_301REDIRECT', 'Is301redirect', 'BOOLEAN', false, null, false);
		$this->addColumn('OLD_LINK', 'OldLink', 'VARCHAR', false, 250, null);
		$this->addColumn('SLUG', 'Slug', 'VARCHAR', true, 250, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 250, null);
		$this->addColumn('BREADCRUMB', 'Breadcrumb', 'VARCHAR', false, 250, null);
		$this->addColumn('H1', 'H1', 'VARCHAR', false, 250, null);
		$this->addColumn('META_KEYWORDS', 'MetaKeywords', 'LONGVARCHAR', false, null, null);
		$this->addColumn('META_DESCRIPTION', 'MetaDescription', 'LONGVARCHAR', false, null, null);
		$this->addColumn('BODY', 'Body', 'LONGVARCHAR', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
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

} // PagesTableMap

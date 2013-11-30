<?php


/**
 * This class defines the structure of the 'category' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Fri Nov 22 04:32:46 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class CategoryTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.CategoryTableMap';

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
		$this->setName('category');
		$this->setPhpName('Category');
		$this->setClassname('Category');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('PARENT_ID', 'ParentId', 'INTEGER', 'category', 'ID', false, null, null);
		$this->addColumn('SLUG', 'Slug', 'VARCHAR', true, 250, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 250, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('CategoryRelatedByParentId', 'Category', RelationMap::MANY_TO_ONE, array('parent_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('CategoryRelatedByParentId', 'Category', RelationMap::ONE_TO_MANY, array('id' => 'parent_id', ), 'CASCADE', null);
    $this->addRelation('CarCategory', 'CarCategory', RelationMap::ONE_TO_MANY, array('id' => 'category_id', ), 'CASCADE', null);
    $this->addRelation('Product', 'Product', RelationMap::ONE_TO_MANY, array('id' => 'category_id', ), 'CASCADE', null);
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

} // CategoryTableMap

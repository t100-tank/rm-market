<?php


/**
 * This class defines the structure of the 'product' table.
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
class ProductTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ProductTableMap';

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
		$this->setName('product');
		$this->setPhpName('Product');
		$this->setClassname('Product');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('CATEGORY_ID', 'CategoryId', 'INTEGER', 'category', 'ID', false, null, null);
		$this->addColumn('AMOUNT', 'Amount', 'INTEGER', true, null, null);
		$this->addColumn('UID', 'Uid', 'VARCHAR', true, 100, null);
		$this->addColumn('ANALOG_UID', 'AnalogUid', 'VARCHAR', false, 100, null);
		$this->addColumn('SLUG', 'Slug', 'VARCHAR', true, 250, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 250, null);
		$this->addColumn('DISTRIB_PRICE', 'DistribPrice', 'DECIMAL', false, 15, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Category', 'Category', RelationMap::MANY_TO_ONE, array('category_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('CarProduct', 'CarProduct', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), 'CASCADE', null);
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

} // ProductTableMap

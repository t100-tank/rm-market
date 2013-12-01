<?php


/**
 * This class defines the structure of the 'advertise' table.
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
class AdvertiseTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AdvertiseTableMap';

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
		$this->setName('advertise');
		$this->setPhpName('Advertise');
		$this->setClassname('Advertise');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('SLUG', 'Slug', 'VARCHAR', true, 250, null);
		$this->addColumn('IS_ON_SLIDER', 'IsOnSlider', 'BOOLEAN', true, null, true);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', true, null, true);
		$this->addColumn('SLIDER_IMAGE', 'SliderImage', 'VARCHAR', true, 60, null);
		$this->addColumn('SLIDER_H1', 'SliderH1', 'VARCHAR', true, 150, null);
		$this->addColumn('SLIDER_TEXT', 'SliderText', 'VARCHAR', true, 250, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', true, 250, null);
		$this->addColumn('H1', 'H1', 'VARCHAR', true, 250, null);
		$this->addColumn('SHORT_TEXT', 'ShortText', 'LONGVARCHAR', true, null, null);
		$this->addColumn('DESCRIPTION', 'Description', 'LONGVARCHAR', false, null, null);
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
		);
	} // getBehaviors()

} // AdvertiseTableMap

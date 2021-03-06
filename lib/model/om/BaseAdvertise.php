<?php

/**
 * Base class that represents a row from the 'advertise' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseAdvertise extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        AdvertisePeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the slug field.
	 * @var        string
	 */
	protected $slug;

	/**
	 * The value for the is_on_slider field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $is_on_slider;

	/**
	 * The value for the is_active field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $is_active;

	/**
	 * The value for the slider_image field.
	 * @var        string
	 */
	protected $slider_image;

	/**
	 * The value for the slider_h1 field.
	 * @var        string
	 */
	protected $slider_h1;

	/**
	 * The value for the slider_text field.
	 * @var        string
	 */
	protected $slider_text;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the h1 field.
	 * @var        string
	 */
	protected $h1;

	/**
	 * The value for the short_text field.
	 * @var        string
	 */
	protected $short_text;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	// symfony behavior
	
	const PEER = 'AdvertisePeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_on_slider = true;
		$this->is_active = true;
	}

	/**
	 * Initializes internal state of BaseAdvertise object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [slug] column value.
	 * 
	 * @return     string
	 */
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	 * Get the [is_on_slider] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsOnSlider()
	{
		return $this->is_on_slider;
	}

	/**
	 * Get the [is_active] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsActive()
	{
		return $this->is_active;
	}

	/**
	 * Get the [slider_image] column value.
	 * 
	 * @return     string
	 */
	public function getSliderImage()
	{
		return $this->slider_image;
	}

	/**
	 * Get the [slider_h1] column value.
	 * 
	 * @return     string
	 */
	public function getSliderH1()
	{
		return $this->slider_h1;
	}

	/**
	 * Get the [slider_text] column value.
	 * 
	 * @return     string
	 */
	public function getSliderText()
	{
		return $this->slider_text;
	}

	/**
	 * Get the [title] column value.
	 * 
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the [h1] column value.
	 * 
	 * @return     string
	 */
	public function getH1()
	{
		return $this->h1;
	}

	/**
	 * Get the [short_text] column value.
	 * 
	 * @return     string
	 */
	public function getShortText()
	{
		return $this->short_text;
	}

	/**
	 * Get the [description] column value.
	 * 
	 * @return     string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Advertise The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = AdvertisePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [slug] column.
	 * 
	 * @param      string $v new value
	 * @return     Advertise The current object (for fluent API support)
	 */
	public function setSlug($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->slug !== $v) {
			$this->slug = $v;
			$this->modifiedColumns[] = AdvertisePeer::SLUG;
		}

		return $this;
	} // setSlug()

	/**
	 * Set the value of [is_on_slider] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Advertise The current object (for fluent API support)
	 */
	public function setIsOnSlider($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_on_slider !== $v || $this->isNew()) {
			$this->is_on_slider = $v;
			$this->modifiedColumns[] = AdvertisePeer::IS_ON_SLIDER;
		}

		return $this;
	} // setIsOnSlider()

	/**
	 * Set the value of [is_active] column.
	 * 
	 * @param      boolean $v new value
	 * @return     Advertise The current object (for fluent API support)
	 */
	public function setIsActive($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->is_active !== $v || $this->isNew()) {
			$this->is_active = $v;
			$this->modifiedColumns[] = AdvertisePeer::IS_ACTIVE;
		}

		return $this;
	} // setIsActive()

	/**
	 * Set the value of [slider_image] column.
	 * 
	 * @param      string $v new value
	 * @return     Advertise The current object (for fluent API support)
	 */
	public function setSliderImage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->slider_image !== $v) {
			$this->slider_image = $v;
			$this->modifiedColumns[] = AdvertisePeer::SLIDER_IMAGE;
		}

		return $this;
	} // setSliderImage()

	/**
	 * Set the value of [slider_h1] column.
	 * 
	 * @param      string $v new value
	 * @return     Advertise The current object (for fluent API support)
	 */
	public function setSliderH1($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->slider_h1 !== $v) {
			$this->slider_h1 = $v;
			$this->modifiedColumns[] = AdvertisePeer::SLIDER_H1;
		}

		return $this;
	} // setSliderH1()

	/**
	 * Set the value of [slider_text] column.
	 * 
	 * @param      string $v new value
	 * @return     Advertise The current object (for fluent API support)
	 */
	public function setSliderText($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->slider_text !== $v) {
			$this->slider_text = $v;
			$this->modifiedColumns[] = AdvertisePeer::SLIDER_TEXT;
		}

		return $this;
	} // setSliderText()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     Advertise The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = AdvertisePeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [h1] column.
	 * 
	 * @param      string $v new value
	 * @return     Advertise The current object (for fluent API support)
	 */
	public function setH1($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->h1 !== $v) {
			$this->h1 = $v;
			$this->modifiedColumns[] = AdvertisePeer::H1;
		}

		return $this;
	} // setH1()

	/**
	 * Set the value of [short_text] column.
	 * 
	 * @param      string $v new value
	 * @return     Advertise The current object (for fluent API support)
	 */
	public function setShortText($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->short_text !== $v) {
			$this->short_text = $v;
			$this->modifiedColumns[] = AdvertisePeer::SHORT_TEXT;
		}

		return $this;
	} // setShortText()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     Advertise The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = AdvertisePeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->is_on_slider !== true) {
				return false;
			}

			if ($this->is_active !== true) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->slug = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->is_on_slider = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->is_active = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->slider_image = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->slider_h1 = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->slider_text = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->title = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->h1 = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->short_text = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->description = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 11; // 11 = AdvertisePeer::NUM_COLUMNS - AdvertisePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Advertise object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AdvertisePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = AdvertisePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AdvertisePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseAdvertise:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				AdvertisePeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseAdvertise:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AdvertisePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseAdvertise:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			    $con->commit();
			
			    return $affectedRows;
			  }
			}

			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseAdvertise:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				AdvertisePeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() ) {
				$this->modifiedColumns[] = AdvertisePeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AdvertisePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += AdvertisePeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = AdvertisePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AdvertisePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getSlug();
				break;
			case 2:
				return $this->getIsOnSlider();
				break;
			case 3:
				return $this->getIsActive();
				break;
			case 4:
				return $this->getSliderImage();
				break;
			case 5:
				return $this->getSliderH1();
				break;
			case 6:
				return $this->getSliderText();
				break;
			case 7:
				return $this->getTitle();
				break;
			case 8:
				return $this->getH1();
				break;
			case 9:
				return $this->getShortText();
				break;
			case 10:
				return $this->getDescription();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AdvertisePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSlug(),
			$keys[2] => $this->getIsOnSlider(),
			$keys[3] => $this->getIsActive(),
			$keys[4] => $this->getSliderImage(),
			$keys[5] => $this->getSliderH1(),
			$keys[6] => $this->getSliderText(),
			$keys[7] => $this->getTitle(),
			$keys[8] => $this->getH1(),
			$keys[9] => $this->getShortText(),
			$keys[10] => $this->getDescription(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AdvertisePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setSlug($value);
				break;
			case 2:
				$this->setIsOnSlider($value);
				break;
			case 3:
				$this->setIsActive($value);
				break;
			case 4:
				$this->setSliderImage($value);
				break;
			case 5:
				$this->setSliderH1($value);
				break;
			case 6:
				$this->setSliderText($value);
				break;
			case 7:
				$this->setTitle($value);
				break;
			case 8:
				$this->setH1($value);
				break;
			case 9:
				$this->setShortText($value);
				break;
			case 10:
				$this->setDescription($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AdvertisePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSlug($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsOnSlider($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsActive($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSliderImage($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSliderH1($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSliderText($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTitle($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setH1($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setShortText($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDescription($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(AdvertisePeer::DATABASE_NAME);

		if ($this->isColumnModified(AdvertisePeer::ID)) $criteria->add(AdvertisePeer::ID, $this->id);
		if ($this->isColumnModified(AdvertisePeer::SLUG)) $criteria->add(AdvertisePeer::SLUG, $this->slug);
		if ($this->isColumnModified(AdvertisePeer::IS_ON_SLIDER)) $criteria->add(AdvertisePeer::IS_ON_SLIDER, $this->is_on_slider);
		if ($this->isColumnModified(AdvertisePeer::IS_ACTIVE)) $criteria->add(AdvertisePeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(AdvertisePeer::SLIDER_IMAGE)) $criteria->add(AdvertisePeer::SLIDER_IMAGE, $this->slider_image);
		if ($this->isColumnModified(AdvertisePeer::SLIDER_H1)) $criteria->add(AdvertisePeer::SLIDER_H1, $this->slider_h1);
		if ($this->isColumnModified(AdvertisePeer::SLIDER_TEXT)) $criteria->add(AdvertisePeer::SLIDER_TEXT, $this->slider_text);
		if ($this->isColumnModified(AdvertisePeer::TITLE)) $criteria->add(AdvertisePeer::TITLE, $this->title);
		if ($this->isColumnModified(AdvertisePeer::H1)) $criteria->add(AdvertisePeer::H1, $this->h1);
		if ($this->isColumnModified(AdvertisePeer::SHORT_TEXT)) $criteria->add(AdvertisePeer::SHORT_TEXT, $this->short_text);
		if ($this->isColumnModified(AdvertisePeer::DESCRIPTION)) $criteria->add(AdvertisePeer::DESCRIPTION, $this->description);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AdvertisePeer::DATABASE_NAME);

		$criteria->add(AdvertisePeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Advertise (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setSlug($this->slug);

		$copyObj->setIsOnSlider($this->is_on_slider);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setSliderImage($this->slider_image);

		$copyObj->setSliderH1($this->slider_h1);

		$copyObj->setSliderText($this->slider_text);

		$copyObj->setTitle($this->title);

		$copyObj->setH1($this->h1);

		$copyObj->setShortText($this->short_text);

		$copyObj->setDescription($this->description);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Advertise Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     AdvertisePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new AdvertisePeer();
		}
		return self::$peer;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseAdvertise:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseAdvertise::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseAdvertise

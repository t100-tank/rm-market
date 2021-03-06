<?php

/**
 * Base class that represents a row from the 'car_label' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseCarLabel extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CarLabelPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the parent_id field.
	 * @var        int
	 */
	protected $parent_id;

	/**
	 * The value for the slug field.
	 * @var        string
	 */
	protected $slug;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * @var        CarLabel
	 */
	protected $aCarLabelRelatedByParentId;

	/**
	 * @var        array CarLabel[] Collection to store aggregation of CarLabel objects.
	 */
	protected $collCarLabelsRelatedByParentId;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCarLabelsRelatedByParentId.
	 */
	private $lastCarLabelRelatedByParentIdCriteria = null;

	/**
	 * @var        array CarCategory[] Collection to store aggregation of CarCategory objects.
	 */
	protected $collCarCategorys;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCarCategorys.
	 */
	private $lastCarCategoryCriteria = null;

	/**
	 * @var        array CarProduct[] Collection to store aggregation of CarProduct objects.
	 */
	protected $collCarProducts;

	/**
	 * @var        Criteria The criteria used to select the current contents of collCarProducts.
	 */
	private $lastCarProductCriteria = null;

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
	
	const PEER = 'CarLabelPeer';

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
	 * Get the [parent_id] column value.
	 * 
	 * @return     int
	 */
	public function getParentId()
	{
		return $this->parent_id;
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
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     CarLabel The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = CarLabelPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [parent_id] column.
	 * 
	 * @param      int $v new value
	 * @return     CarLabel The current object (for fluent API support)
	 */
	public function setParentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->parent_id !== $v) {
			$this->parent_id = $v;
			$this->modifiedColumns[] = CarLabelPeer::PARENT_ID;
		}

		if ($this->aCarLabelRelatedByParentId !== null && $this->aCarLabelRelatedByParentId->getId() !== $v) {
			$this->aCarLabelRelatedByParentId = null;
		}

		return $this;
	} // setParentId()

	/**
	 * Set the value of [slug] column.
	 * 
	 * @param      string $v new value
	 * @return     CarLabel The current object (for fluent API support)
	 */
	public function setSlug($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->slug !== $v) {
			$this->slug = $v;
			$this->modifiedColumns[] = CarLabelPeer::SLUG;
		}

		return $this;
	} // setSlug()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     CarLabel The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = CarLabelPeer::NAME;
		}

		return $this;
	} // setName()

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
			$this->parent_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->slug = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 4; // 4 = CarLabelPeer::NUM_COLUMNS - CarLabelPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating CarLabel object", $e);
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

		if ($this->aCarLabelRelatedByParentId !== null && $this->parent_id !== $this->aCarLabelRelatedByParentId->getId()) {
			$this->aCarLabelRelatedByParentId = null;
		}
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
			$con = Propel::getConnection(CarLabelPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CarLabelPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCarLabelRelatedByParentId = null;
			$this->collCarLabelsRelatedByParentId = null;
			$this->lastCarLabelRelatedByParentIdCriteria = null;

			$this->collCarCategorys = null;
			$this->lastCarCategoryCriteria = null;

			$this->collCarProducts = null;
			$this->lastCarProductCriteria = null;

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
			$con = Propel::getConnection(CarLabelPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseCarLabel:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				CarLabelPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseCarLabel:delete:post') as $callable)
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
			$con = Propel::getConnection(CarLabelPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseCarLabel:save:pre') as $callable)
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
				foreach (sfMixer::getCallables('BaseCarLabel:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				CarLabelPeer::addInstanceToPool($this);
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

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aCarLabelRelatedByParentId !== null) {
				if ($this->aCarLabelRelatedByParentId->isModified() || $this->aCarLabelRelatedByParentId->isNew()) {
					$affectedRows += $this->aCarLabelRelatedByParentId->save($con);
				}
				$this->setCarLabelRelatedByParentId($this->aCarLabelRelatedByParentId);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = CarLabelPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CarLabelPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += CarLabelPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collCarLabelsRelatedByParentId !== null) {
				foreach ($this->collCarLabelsRelatedByParentId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCarCategorys !== null) {
				foreach ($this->collCarCategorys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCarProducts !== null) {
				foreach ($this->collCarProducts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aCarLabelRelatedByParentId !== null) {
				if (!$this->aCarLabelRelatedByParentId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCarLabelRelatedByParentId->getValidationFailures());
				}
			}


			if (($retval = CarLabelPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCarLabelsRelatedByParentId !== null) {
					foreach ($this->collCarLabelsRelatedByParentId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCarCategorys !== null) {
					foreach ($this->collCarCategorys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCarProducts !== null) {
					foreach ($this->collCarProducts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = CarLabelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getParentId();
				break;
			case 2:
				return $this->getSlug();
				break;
			case 3:
				return $this->getName();
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
		$keys = CarLabelPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getParentId(),
			$keys[2] => $this->getSlug(),
			$keys[3] => $this->getName(),
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
		$pos = CarLabelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setParentId($value);
				break;
			case 2:
				$this->setSlug($value);
				break;
			case 3:
				$this->setName($value);
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
		$keys = CarLabelPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setParentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSlug($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CarLabelPeer::DATABASE_NAME);

		if ($this->isColumnModified(CarLabelPeer::ID)) $criteria->add(CarLabelPeer::ID, $this->id);
		if ($this->isColumnModified(CarLabelPeer::PARENT_ID)) $criteria->add(CarLabelPeer::PARENT_ID, $this->parent_id);
		if ($this->isColumnModified(CarLabelPeer::SLUG)) $criteria->add(CarLabelPeer::SLUG, $this->slug);
		if ($this->isColumnModified(CarLabelPeer::NAME)) $criteria->add(CarLabelPeer::NAME, $this->name);

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
		$criteria = new Criteria(CarLabelPeer::DATABASE_NAME);

		$criteria->add(CarLabelPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of CarLabel (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setParentId($this->parent_id);

		$copyObj->setSlug($this->slug);

		$copyObj->setName($this->name);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getCarLabelsRelatedByParentId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCarLabelRelatedByParentId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCarCategorys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCarCategory($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCarProducts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addCarProduct($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


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
	 * @return     CarLabel Clone of current object.
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
	 * @return     CarLabelPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CarLabelPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a CarLabel object.
	 *
	 * @param      CarLabel $v
	 * @return     CarLabel The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setCarLabelRelatedByParentId(CarLabel $v = null)
	{
		if ($v === null) {
			$this->setParentId(NULL);
		} else {
			$this->setParentId($v->getId());
		}

		$this->aCarLabelRelatedByParentId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the CarLabel object, it will not be re-added.
		if ($v !== null) {
			$v->addCarLabelRelatedByParentId($this);
		}

		return $this;
	}


	/**
	 * Get the associated CarLabel object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     CarLabel The associated CarLabel object.
	 * @throws     PropelException
	 */
	public function getCarLabelRelatedByParentId(PropelPDO $con = null)
	{
		if ($this->aCarLabelRelatedByParentId === null && ($this->parent_id !== null)) {
			$this->aCarLabelRelatedByParentId = CarLabelPeer::retrieveByPk($this->parent_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aCarLabelRelatedByParentId->addCarLabelsRelatedByParentId($this);
			 */
		}
		return $this->aCarLabelRelatedByParentId;
	}

	/**
	 * Clears out the collCarLabelsRelatedByParentId collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCarLabelsRelatedByParentId()
	 */
	public function clearCarLabelsRelatedByParentId()
	{
		$this->collCarLabelsRelatedByParentId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCarLabelsRelatedByParentId collection (array).
	 *
	 * By default this just sets the collCarLabelsRelatedByParentId collection to an empty array (like clearcollCarLabelsRelatedByParentId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCarLabelsRelatedByParentId()
	{
		$this->collCarLabelsRelatedByParentId = array();
	}

	/**
	 * Gets an array of CarLabel objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this CarLabel has previously been saved, it will retrieve
	 * related CarLabelsRelatedByParentId from storage. If this CarLabel is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array CarLabel[]
	 * @throws     PropelException
	 */
	public function getCarLabelsRelatedByParentId($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CarLabelPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCarLabelsRelatedByParentId === null) {
			if ($this->isNew()) {
			   $this->collCarLabelsRelatedByParentId = array();
			} else {

				$criteria->add(CarLabelPeer::PARENT_ID, $this->id);

				CarLabelPeer::addSelectColumns($criteria);
				$this->collCarLabelsRelatedByParentId = CarLabelPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CarLabelPeer::PARENT_ID, $this->id);

				CarLabelPeer::addSelectColumns($criteria);
				if (!isset($this->lastCarLabelRelatedByParentIdCriteria) || !$this->lastCarLabelRelatedByParentIdCriteria->equals($criteria)) {
					$this->collCarLabelsRelatedByParentId = CarLabelPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCarLabelRelatedByParentIdCriteria = $criteria;
		return $this->collCarLabelsRelatedByParentId;
	}

	/**
	 * Returns the number of related CarLabel objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related CarLabel objects.
	 * @throws     PropelException
	 */
	public function countCarLabelsRelatedByParentId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CarLabelPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCarLabelsRelatedByParentId === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CarLabelPeer::PARENT_ID, $this->id);

				$count = CarLabelPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CarLabelPeer::PARENT_ID, $this->id);

				if (!isset($this->lastCarLabelRelatedByParentIdCriteria) || !$this->lastCarLabelRelatedByParentIdCriteria->equals($criteria)) {
					$count = CarLabelPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collCarLabelsRelatedByParentId);
				}
			} else {
				$count = count($this->collCarLabelsRelatedByParentId);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a CarLabel object to this object
	 * through the CarLabel foreign key attribute.
	 *
	 * @param      CarLabel $l CarLabel
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCarLabelRelatedByParentId(CarLabel $l)
	{
		if ($this->collCarLabelsRelatedByParentId === null) {
			$this->initCarLabelsRelatedByParentId();
		}
		if (!in_array($l, $this->collCarLabelsRelatedByParentId, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCarLabelsRelatedByParentId, $l);
			$l->setCarLabelRelatedByParentId($this);
		}
	}

	/**
	 * Clears out the collCarCategorys collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCarCategorys()
	 */
	public function clearCarCategorys()
	{
		$this->collCarCategorys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCarCategorys collection (array).
	 *
	 * By default this just sets the collCarCategorys collection to an empty array (like clearcollCarCategorys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCarCategorys()
	{
		$this->collCarCategorys = array();
	}

	/**
	 * Gets an array of CarCategory objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this CarLabel has previously been saved, it will retrieve
	 * related CarCategorys from storage. If this CarLabel is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array CarCategory[]
	 * @throws     PropelException
	 */
	public function getCarCategorys($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CarLabelPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCarCategorys === null) {
			if ($this->isNew()) {
			   $this->collCarCategorys = array();
			} else {

				$criteria->add(CarCategoryPeer::CAR_ID, $this->id);

				CarCategoryPeer::addSelectColumns($criteria);
				$this->collCarCategorys = CarCategoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CarCategoryPeer::CAR_ID, $this->id);

				CarCategoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastCarCategoryCriteria) || !$this->lastCarCategoryCriteria->equals($criteria)) {
					$this->collCarCategorys = CarCategoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCarCategoryCriteria = $criteria;
		return $this->collCarCategorys;
	}

	/**
	 * Returns the number of related CarCategory objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related CarCategory objects.
	 * @throws     PropelException
	 */
	public function countCarCategorys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CarLabelPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCarCategorys === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CarCategoryPeer::CAR_ID, $this->id);

				$count = CarCategoryPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CarCategoryPeer::CAR_ID, $this->id);

				if (!isset($this->lastCarCategoryCriteria) || !$this->lastCarCategoryCriteria->equals($criteria)) {
					$count = CarCategoryPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collCarCategorys);
				}
			} else {
				$count = count($this->collCarCategorys);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a CarCategory object to this object
	 * through the CarCategory foreign key attribute.
	 *
	 * @param      CarCategory $l CarCategory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCarCategory(CarCategory $l)
	{
		if ($this->collCarCategorys === null) {
			$this->initCarCategorys();
		}
		if (!in_array($l, $this->collCarCategorys, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCarCategorys, $l);
			$l->setCarLabel($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this CarLabel is new, it will return
	 * an empty collection; or if this CarLabel has previously
	 * been saved, it will retrieve related CarCategorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in CarLabel.
	 */
	public function getCarCategorysJoinCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CarLabelPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCarCategorys === null) {
			if ($this->isNew()) {
				$this->collCarCategorys = array();
			} else {

				$criteria->add(CarCategoryPeer::CAR_ID, $this->id);

				$this->collCarCategorys = CarCategoryPeer::doSelectJoinCategory($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CarCategoryPeer::CAR_ID, $this->id);

			if (!isset($this->lastCarCategoryCriteria) || !$this->lastCarCategoryCriteria->equals($criteria)) {
				$this->collCarCategorys = CarCategoryPeer::doSelectJoinCategory($criteria, $con, $join_behavior);
			}
		}
		$this->lastCarCategoryCriteria = $criteria;

		return $this->collCarCategorys;
	}

	/**
	 * Clears out the collCarProducts collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addCarProducts()
	 */
	public function clearCarProducts()
	{
		$this->collCarProducts = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collCarProducts collection (array).
	 *
	 * By default this just sets the collCarProducts collection to an empty array (like clearcollCarProducts());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initCarProducts()
	{
		$this->collCarProducts = array();
	}

	/**
	 * Gets an array of CarProduct objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this CarLabel has previously been saved, it will retrieve
	 * related CarProducts from storage. If this CarLabel is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array CarProduct[]
	 * @throws     PropelException
	 */
	public function getCarProducts($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CarLabelPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCarProducts === null) {
			if ($this->isNew()) {
			   $this->collCarProducts = array();
			} else {

				$criteria->add(CarProductPeer::CAR_ID, $this->id);

				CarProductPeer::addSelectColumns($criteria);
				$this->collCarProducts = CarProductPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CarProductPeer::CAR_ID, $this->id);

				CarProductPeer::addSelectColumns($criteria);
				if (!isset($this->lastCarProductCriteria) || !$this->lastCarProductCriteria->equals($criteria)) {
					$this->collCarProducts = CarProductPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCarProductCriteria = $criteria;
		return $this->collCarProducts;
	}

	/**
	 * Returns the number of related CarProduct objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related CarProduct objects.
	 * @throws     PropelException
	 */
	public function countCarProducts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CarLabelPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCarProducts === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CarProductPeer::CAR_ID, $this->id);

				$count = CarProductPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CarProductPeer::CAR_ID, $this->id);

				if (!isset($this->lastCarProductCriteria) || !$this->lastCarProductCriteria->equals($criteria)) {
					$count = CarProductPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collCarProducts);
				}
			} else {
				$count = count($this->collCarProducts);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a CarProduct object to this object
	 * through the CarProduct foreign key attribute.
	 *
	 * @param      CarProduct $l CarProduct
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCarProduct(CarProduct $l)
	{
		if ($this->collCarProducts === null) {
			$this->initCarProducts();
		}
		if (!in_array($l, $this->collCarProducts, true)) { // only add it if the **same** object is not already associated
			array_push($this->collCarProducts, $l);
			$l->setCarLabel($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this CarLabel is new, it will return
	 * an empty collection; or if this CarLabel has previously
	 * been saved, it will retrieve related CarProducts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in CarLabel.
	 */
	public function getCarProductsJoinProduct($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CarLabelPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCarProducts === null) {
			if ($this->isNew()) {
				$this->collCarProducts = array();
			} else {

				$criteria->add(CarProductPeer::CAR_ID, $this->id);

				$this->collCarProducts = CarProductPeer::doSelectJoinProduct($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CarProductPeer::CAR_ID, $this->id);

			if (!isset($this->lastCarProductCriteria) || !$this->lastCarProductCriteria->equals($criteria)) {
				$this->collCarProducts = CarProductPeer::doSelectJoinProduct($criteria, $con, $join_behavior);
			}
		}
		$this->lastCarProductCriteria = $criteria;

		return $this->collCarProducts;
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
			if ($this->collCarLabelsRelatedByParentId) {
				foreach ((array) $this->collCarLabelsRelatedByParentId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCarCategorys) {
				foreach ((array) $this->collCarCategorys as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCarProducts) {
				foreach ((array) $this->collCarProducts as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collCarLabelsRelatedByParentId = null;
		$this->collCarCategorys = null;
		$this->collCarProducts = null;
			$this->aCarLabelRelatedByParentId = null;
	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseCarLabel:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseCarLabel::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseCarLabel

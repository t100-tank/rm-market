<?php

/**
 * Base class that represents a row from the 'product' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseProduct extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ProductPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the category_id field.
	 * @var        int
	 */
	protected $category_id;

	/**
	 * The value for the amount field.
	 * @var        int
	 */
	protected $amount;

	/**
	 * The value for the uid field.
	 * @var        string
	 */
	protected $uid;

	/**
	 * The value for the analog_uid field.
	 * @var        string
	 */
	protected $analog_uid;

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
	 * The value for the distrib_price field.
	 * @var        string
	 */
	protected $distrib_price;

	/**
	 * @var        Category
	 */
	protected $aCategory;

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
	
	const PEER = 'ProductPeer';

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
	 * Get the [category_id] column value.
	 * 
	 * @return     int
	 */
	public function getCategoryId()
	{
		return $this->category_id;
	}

	/**
	 * Get the [amount] column value.
	 * 
	 * @return     int
	 */
	public function getAmount()
	{
		return $this->amount;
	}

	/**
	 * Get the [uid] column value.
	 * 
	 * @return     string
	 */
	public function getUid()
	{
		return $this->uid;
	}

	/**
	 * Get the [analog_uid] column value.
	 * 
	 * @return     string
	 */
	public function getAnalogUid()
	{
		return $this->analog_uid;
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
	 * Get the [distrib_price] column value.
	 * 
	 * @return     string
	 */
	public function getDistribPrice()
	{
		return $this->distrib_price;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Product The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ProductPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [category_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Product The current object (for fluent API support)
	 */
	public function setCategoryId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->category_id !== $v) {
			$this->category_id = $v;
			$this->modifiedColumns[] = ProductPeer::CATEGORY_ID;
		}

		if ($this->aCategory !== null && $this->aCategory->getId() !== $v) {
			$this->aCategory = null;
		}

		return $this;
	} // setCategoryId()

	/**
	 * Set the value of [amount] column.
	 * 
	 * @param      int $v new value
	 * @return     Product The current object (for fluent API support)
	 */
	public function setAmount($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->amount !== $v) {
			$this->amount = $v;
			$this->modifiedColumns[] = ProductPeer::AMOUNT;
		}

		return $this;
	} // setAmount()

	/**
	 * Set the value of [uid] column.
	 * 
	 * @param      string $v new value
	 * @return     Product The current object (for fluent API support)
	 */
	public function setUid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->uid !== $v) {
			$this->uid = $v;
			$this->modifiedColumns[] = ProductPeer::UID;
		}

		return $this;
	} // setUid()

	/**
	 * Set the value of [analog_uid] column.
	 * 
	 * @param      string $v new value
	 * @return     Product The current object (for fluent API support)
	 */
	public function setAnalogUid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->analog_uid !== $v) {
			$this->analog_uid = $v;
			$this->modifiedColumns[] = ProductPeer::ANALOG_UID;
		}

		return $this;
	} // setAnalogUid()

	/**
	 * Set the value of [slug] column.
	 * 
	 * @param      string $v new value
	 * @return     Product The current object (for fluent API support)
	 */
	public function setSlug($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->slug !== $v) {
			$this->slug = $v;
			$this->modifiedColumns[] = ProductPeer::SLUG;
		}

		return $this;
	} // setSlug()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Product The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ProductPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [distrib_price] column.
	 * 
	 * @param      string $v new value
	 * @return     Product The current object (for fluent API support)
	 */
	public function setDistribPrice($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->distrib_price !== $v) {
			$this->distrib_price = $v;
			$this->modifiedColumns[] = ProductPeer::DISTRIB_PRICE;
		}

		return $this;
	} // setDistribPrice()

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
			$this->category_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->amount = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->uid = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->analog_uid = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->slug = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->name = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->distrib_price = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = ProductPeer::NUM_COLUMNS - ProductPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Product object", $e);
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

		if ($this->aCategory !== null && $this->category_id !== $this->aCategory->getId()) {
			$this->aCategory = null;
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
			$con = Propel::getConnection(ProductPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ProductPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCategory = null;
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
			$con = Propel::getConnection(ProductPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseProduct:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				ProductPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseProduct:delete:post') as $callable)
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
			$con = Propel::getConnection(ProductPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseProduct:save:pre') as $callable)
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
				foreach (sfMixer::getCallables('BaseProduct:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				ProductPeer::addInstanceToPool($this);
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

			if ($this->aCategory !== null) {
				if ($this->aCategory->isModified() || $this->aCategory->isNew()) {
					$affectedRows += $this->aCategory->save($con);
				}
				$this->setCategory($this->aCategory);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ProductPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ProductPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ProductPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
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

			if ($this->aCategory !== null) {
				if (!$this->aCategory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCategory->getValidationFailures());
				}
			}


			if (($retval = ProductPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = ProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCategoryId();
				break;
			case 2:
				return $this->getAmount();
				break;
			case 3:
				return $this->getUid();
				break;
			case 4:
				return $this->getAnalogUid();
				break;
			case 5:
				return $this->getSlug();
				break;
			case 6:
				return $this->getName();
				break;
			case 7:
				return $this->getDistribPrice();
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
		$keys = ProductPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCategoryId(),
			$keys[2] => $this->getAmount(),
			$keys[3] => $this->getUid(),
			$keys[4] => $this->getAnalogUid(),
			$keys[5] => $this->getSlug(),
			$keys[6] => $this->getName(),
			$keys[7] => $this->getDistribPrice(),
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
		$pos = ProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCategoryId($value);
				break;
			case 2:
				$this->setAmount($value);
				break;
			case 3:
				$this->setUid($value);
				break;
			case 4:
				$this->setAnalogUid($value);
				break;
			case 5:
				$this->setSlug($value);
				break;
			case 6:
				$this->setName($value);
				break;
			case 7:
				$this->setDistribPrice($value);
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
		$keys = ProductPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCategoryId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAmount($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUid($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAnalogUid($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSlug($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDistribPrice($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ProductPeer::DATABASE_NAME);

		if ($this->isColumnModified(ProductPeer::ID)) $criteria->add(ProductPeer::ID, $this->id);
		if ($this->isColumnModified(ProductPeer::CATEGORY_ID)) $criteria->add(ProductPeer::CATEGORY_ID, $this->category_id);
		if ($this->isColumnModified(ProductPeer::AMOUNT)) $criteria->add(ProductPeer::AMOUNT, $this->amount);
		if ($this->isColumnModified(ProductPeer::UID)) $criteria->add(ProductPeer::UID, $this->uid);
		if ($this->isColumnModified(ProductPeer::ANALOG_UID)) $criteria->add(ProductPeer::ANALOG_UID, $this->analog_uid);
		if ($this->isColumnModified(ProductPeer::SLUG)) $criteria->add(ProductPeer::SLUG, $this->slug);
		if ($this->isColumnModified(ProductPeer::NAME)) $criteria->add(ProductPeer::NAME, $this->name);
		if ($this->isColumnModified(ProductPeer::DISTRIB_PRICE)) $criteria->add(ProductPeer::DISTRIB_PRICE, $this->distrib_price);

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
		$criteria = new Criteria(ProductPeer::DATABASE_NAME);

		$criteria->add(ProductPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Product (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCategoryId($this->category_id);

		$copyObj->setAmount($this->amount);

		$copyObj->setUid($this->uid);

		$copyObj->setAnalogUid($this->analog_uid);

		$copyObj->setSlug($this->slug);

		$copyObj->setName($this->name);

		$copyObj->setDistribPrice($this->distrib_price);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

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
	 * @return     Product Clone of current object.
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
	 * @return     ProductPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ProductPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Category object.
	 *
	 * @param      Category $v
	 * @return     Product The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setCategory(Category $v = null)
	{
		if ($v === null) {
			$this->setCategoryId(NULL);
		} else {
			$this->setCategoryId($v->getId());
		}

		$this->aCategory = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Category object, it will not be re-added.
		if ($v !== null) {
			$v->addProduct($this);
		}

		return $this;
	}


	/**
	 * Get the associated Category object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Category The associated Category object.
	 * @throws     PropelException
	 */
	public function getCategory(PropelPDO $con = null)
	{
		if ($this->aCategory === null && ($this->category_id !== null)) {
			$this->aCategory = CategoryPeer::retrieveByPk($this->category_id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aCategory->addProducts($this);
			 */
		}
		return $this->aCategory;
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
	 * Otherwise if this Product has previously been saved, it will retrieve
	 * related CarProducts from storage. If this Product is new, it will return
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
			$criteria = new Criteria(ProductPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCarProducts === null) {
			if ($this->isNew()) {
			   $this->collCarProducts = array();
			} else {

				$criteria->add(CarProductPeer::PRODUCT_ID, $this->id);

				CarProductPeer::addSelectColumns($criteria);
				$this->collCarProducts = CarProductPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CarProductPeer::PRODUCT_ID, $this->id);

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
			$criteria = new Criteria(ProductPeer::DATABASE_NAME);
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

				$criteria->add(CarProductPeer::PRODUCT_ID, $this->id);

				$count = CarProductPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(CarProductPeer::PRODUCT_ID, $this->id);

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
			$l->setProduct($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Product is new, it will return
	 * an empty collection; or if this Product has previously
	 * been saved, it will retrieve related CarProducts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Product.
	 */
	public function getCarProductsJoinCarLabel($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ProductPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCarProducts === null) {
			if ($this->isNew()) {
				$this->collCarProducts = array();
			} else {

				$criteria->add(CarProductPeer::PRODUCT_ID, $this->id);

				$this->collCarProducts = CarProductPeer::doSelectJoinCarLabel($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CarProductPeer::PRODUCT_ID, $this->id);

			if (!isset($this->lastCarProductCriteria) || !$this->lastCarProductCriteria->equals($criteria)) {
				$this->collCarProducts = CarProductPeer::doSelectJoinCarLabel($criteria, $con, $join_behavior);
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
			if ($this->collCarProducts) {
				foreach ((array) $this->collCarProducts as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collCarProducts = null;
			$this->aCategory = null;
	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseProduct:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseProduct::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseProduct

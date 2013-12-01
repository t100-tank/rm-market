<?php

/**
 * Base class that represents a row from the 'service_form' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseServiceForm extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ServiceFormPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the auto_inc field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $auto_inc;

	/**
	 * The value for the success_message field.
	 * @var        string
	 */
	protected $success_message;

	/**
	 * The value for the user_subject field.
	 * @var        string
	 */
	protected $user_subject;

	/**
	 * The value for the user_body field.
	 * @var        string
	 */
	protected $user_body;

	/**
	 * The value for the operator_email field.
	 * @var        string
	 */
	protected $operator_email;

	/**
	 * The value for the operator_subject field.
	 * @var        string
	 */
	protected $operator_subject;

	/**
	 * The value for the operator_body field.
	 * @var        string
	 */
	protected $operator_body;

	/**
	 * @var        array Field[] Collection to store aggregation of Field objects.
	 */
	protected $collFields;

	/**
	 * @var        Criteria The criteria used to select the current contents of collFields.
	 */
	private $lastFieldCriteria = null;

	/**
	 * @var        array FilledForm[] Collection to store aggregation of FilledForm objects.
	 */
	protected $collFilledForms;

	/**
	 * @var        Criteria The criteria used to select the current contents of collFilledForms.
	 */
	private $lastFilledFormCriteria = null;

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
	
	const PEER = 'ServiceFormPeer';

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->auto_inc = 1;
	}

	/**
	 * Initializes internal state of BaseServiceForm object.
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
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
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
	 * Get the [auto_inc] column value.
	 * 
	 * @return     int
	 */
	public function getAutoInc()
	{
		return $this->auto_inc;
	}

	/**
	 * Get the [success_message] column value.
	 * 
	 * @return     string
	 */
	public function getSuccessMessage()
	{
		return $this->success_message;
	}

	/**
	 * Get the [user_subject] column value.
	 * 
	 * @return     string
	 */
	public function getUserSubject()
	{
		return $this->user_subject;
	}

	/**
	 * Get the [user_body] column value.
	 * 
	 * @return     string
	 */
	public function getUserBody()
	{
		return $this->user_body;
	}

	/**
	 * Get the [operator_email] column value.
	 * 
	 * @return     string
	 */
	public function getOperatorEmail()
	{
		return $this->operator_email;
	}

	/**
	 * Get the [operator_subject] column value.
	 * 
	 * @return     string
	 */
	public function getOperatorSubject()
	{
		return $this->operator_subject;
	}

	/**
	 * Get the [operator_body] column value.
	 * 
	 * @return     string
	 */
	public function getOperatorBody()
	{
		return $this->operator_body;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     ServiceForm The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ServiceFormPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     ServiceForm The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ServiceFormPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     ServiceForm The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = ServiceFormPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [auto_inc] column.
	 * 
	 * @param      int $v new value
	 * @return     ServiceForm The current object (for fluent API support)
	 */
	public function setAutoInc($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->auto_inc !== $v || $this->isNew()) {
			$this->auto_inc = $v;
			$this->modifiedColumns[] = ServiceFormPeer::AUTO_INC;
		}

		return $this;
	} // setAutoInc()

	/**
	 * Set the value of [success_message] column.
	 * 
	 * @param      string $v new value
	 * @return     ServiceForm The current object (for fluent API support)
	 */
	public function setSuccessMessage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->success_message !== $v) {
			$this->success_message = $v;
			$this->modifiedColumns[] = ServiceFormPeer::SUCCESS_MESSAGE;
		}

		return $this;
	} // setSuccessMessage()

	/**
	 * Set the value of [user_subject] column.
	 * 
	 * @param      string $v new value
	 * @return     ServiceForm The current object (for fluent API support)
	 */
	public function setUserSubject($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->user_subject !== $v) {
			$this->user_subject = $v;
			$this->modifiedColumns[] = ServiceFormPeer::USER_SUBJECT;
		}

		return $this;
	} // setUserSubject()

	/**
	 * Set the value of [user_body] column.
	 * 
	 * @param      string $v new value
	 * @return     ServiceForm The current object (for fluent API support)
	 */
	public function setUserBody($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->user_body !== $v) {
			$this->user_body = $v;
			$this->modifiedColumns[] = ServiceFormPeer::USER_BODY;
		}

		return $this;
	} // setUserBody()

	/**
	 * Set the value of [operator_email] column.
	 * 
	 * @param      string $v new value
	 * @return     ServiceForm The current object (for fluent API support)
	 */
	public function setOperatorEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->operator_email !== $v) {
			$this->operator_email = $v;
			$this->modifiedColumns[] = ServiceFormPeer::OPERATOR_EMAIL;
		}

		return $this;
	} // setOperatorEmail()

	/**
	 * Set the value of [operator_subject] column.
	 * 
	 * @param      string $v new value
	 * @return     ServiceForm The current object (for fluent API support)
	 */
	public function setOperatorSubject($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->operator_subject !== $v) {
			$this->operator_subject = $v;
			$this->modifiedColumns[] = ServiceFormPeer::OPERATOR_SUBJECT;
		}

		return $this;
	} // setOperatorSubject()

	/**
	 * Set the value of [operator_body] column.
	 * 
	 * @param      string $v new value
	 * @return     ServiceForm The current object (for fluent API support)
	 */
	public function setOperatorBody($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->operator_body !== $v) {
			$this->operator_body = $v;
			$this->modifiedColumns[] = ServiceFormPeer::OPERATOR_BODY;
		}

		return $this;
	} // setOperatorBody()

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
			if ($this->auto_inc !== 1) {
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
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->title = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->auto_inc = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->success_message = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->user_subject = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->user_body = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->operator_email = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->operator_subject = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->operator_body = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = ServiceFormPeer::NUM_COLUMNS - ServiceFormPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating ServiceForm object", $e);
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
			$con = Propel::getConnection(ServiceFormPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ServiceFormPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collFields = null;
			$this->lastFieldCriteria = null;

			$this->collFilledForms = null;
			$this->lastFilledFormCriteria = null;

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
			$con = Propel::getConnection(ServiceFormPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseServiceForm:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				ServiceFormPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseServiceForm:delete:post') as $callable)
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
			$con = Propel::getConnection(ServiceFormPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseServiceForm:save:pre') as $callable)
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
				foreach (sfMixer::getCallables('BaseServiceForm:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				ServiceFormPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = ServiceFormPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ServiceFormPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ServiceFormPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collFields !== null) {
				foreach ($this->collFields as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFilledForms !== null) {
				foreach ($this->collFilledForms as $referrerFK) {
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


			if (($retval = ServiceFormPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFields !== null) {
					foreach ($this->collFields as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFilledForms !== null) {
					foreach ($this->collFilledForms as $referrerFK) {
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
		$pos = ServiceFormPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 2:
				return $this->getTitle();
				break;
			case 3:
				return $this->getAutoInc();
				break;
			case 4:
				return $this->getSuccessMessage();
				break;
			case 5:
				return $this->getUserSubject();
				break;
			case 6:
				return $this->getUserBody();
				break;
			case 7:
				return $this->getOperatorEmail();
				break;
			case 8:
				return $this->getOperatorSubject();
				break;
			case 9:
				return $this->getOperatorBody();
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
		$keys = ServiceFormPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getTitle(),
			$keys[3] => $this->getAutoInc(),
			$keys[4] => $this->getSuccessMessage(),
			$keys[5] => $this->getUserSubject(),
			$keys[6] => $this->getUserBody(),
			$keys[7] => $this->getOperatorEmail(),
			$keys[8] => $this->getOperatorSubject(),
			$keys[9] => $this->getOperatorBody(),
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
		$pos = ServiceFormPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 2:
				$this->setTitle($value);
				break;
			case 3:
				$this->setAutoInc($value);
				break;
			case 4:
				$this->setSuccessMessage($value);
				break;
			case 5:
				$this->setUserSubject($value);
				break;
			case 6:
				$this->setUserBody($value);
				break;
			case 7:
				$this->setOperatorEmail($value);
				break;
			case 8:
				$this->setOperatorSubject($value);
				break;
			case 9:
				$this->setOperatorBody($value);
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
		$keys = ServiceFormPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAutoInc($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSuccessMessage($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUserSubject($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUserBody($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setOperatorEmail($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setOperatorSubject($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setOperatorBody($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ServiceFormPeer::DATABASE_NAME);

		if ($this->isColumnModified(ServiceFormPeer::ID)) $criteria->add(ServiceFormPeer::ID, $this->id);
		if ($this->isColumnModified(ServiceFormPeer::NAME)) $criteria->add(ServiceFormPeer::NAME, $this->name);
		if ($this->isColumnModified(ServiceFormPeer::TITLE)) $criteria->add(ServiceFormPeer::TITLE, $this->title);
		if ($this->isColumnModified(ServiceFormPeer::AUTO_INC)) $criteria->add(ServiceFormPeer::AUTO_INC, $this->auto_inc);
		if ($this->isColumnModified(ServiceFormPeer::SUCCESS_MESSAGE)) $criteria->add(ServiceFormPeer::SUCCESS_MESSAGE, $this->success_message);
		if ($this->isColumnModified(ServiceFormPeer::USER_SUBJECT)) $criteria->add(ServiceFormPeer::USER_SUBJECT, $this->user_subject);
		if ($this->isColumnModified(ServiceFormPeer::USER_BODY)) $criteria->add(ServiceFormPeer::USER_BODY, $this->user_body);
		if ($this->isColumnModified(ServiceFormPeer::OPERATOR_EMAIL)) $criteria->add(ServiceFormPeer::OPERATOR_EMAIL, $this->operator_email);
		if ($this->isColumnModified(ServiceFormPeer::OPERATOR_SUBJECT)) $criteria->add(ServiceFormPeer::OPERATOR_SUBJECT, $this->operator_subject);
		if ($this->isColumnModified(ServiceFormPeer::OPERATOR_BODY)) $criteria->add(ServiceFormPeer::OPERATOR_BODY, $this->operator_body);

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
		$criteria = new Criteria(ServiceFormPeer::DATABASE_NAME);

		$criteria->add(ServiceFormPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of ServiceForm (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setTitle($this->title);

		$copyObj->setAutoInc($this->auto_inc);

		$copyObj->setSuccessMessage($this->success_message);

		$copyObj->setUserSubject($this->user_subject);

		$copyObj->setUserBody($this->user_body);

		$copyObj->setOperatorEmail($this->operator_email);

		$copyObj->setOperatorSubject($this->operator_subject);

		$copyObj->setOperatorBody($this->operator_body);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getFields() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addField($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFilledForms() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFilledForm($relObj->copy($deepCopy));
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
	 * @return     ServiceForm Clone of current object.
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
	 * @return     ServiceFormPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ServiceFormPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collFields collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFields()
	 */
	public function clearFields()
	{
		$this->collFields = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFields collection (array).
	 *
	 * By default this just sets the collFields collection to an empty array (like clearcollFields());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initFields()
	{
		$this->collFields = array();
	}

	/**
	 * Gets an array of Field objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this ServiceForm has previously been saved, it will retrieve
	 * related Fields from storage. If this ServiceForm is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array Field[]
	 * @throws     PropelException
	 */
	public function getFields($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ServiceFormPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFields === null) {
			if ($this->isNew()) {
			   $this->collFields = array();
			} else {

				$criteria->add(FieldPeer::FORM_ID, $this->id);

				FieldPeer::addSelectColumns($criteria);
				$this->collFields = FieldPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FieldPeer::FORM_ID, $this->id);

				FieldPeer::addSelectColumns($criteria);
				if (!isset($this->lastFieldCriteria) || !$this->lastFieldCriteria->equals($criteria)) {
					$this->collFields = FieldPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFieldCriteria = $criteria;
		return $this->collFields;
	}

	/**
	 * Returns the number of related Field objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Field objects.
	 * @throws     PropelException
	 */
	public function countFields(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ServiceFormPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collFields === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(FieldPeer::FORM_ID, $this->id);

				$count = FieldPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(FieldPeer::FORM_ID, $this->id);

				if (!isset($this->lastFieldCriteria) || !$this->lastFieldCriteria->equals($criteria)) {
					$count = FieldPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collFields);
				}
			} else {
				$count = count($this->collFields);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a Field object to this object
	 * through the Field foreign key attribute.
	 *
	 * @param      Field $l Field
	 * @return     void
	 * @throws     PropelException
	 */
	public function addField(Field $l)
	{
		if ($this->collFields === null) {
			$this->initFields();
		}
		if (!in_array($l, $this->collFields, true)) { // only add it if the **same** object is not already associated
			array_push($this->collFields, $l);
			$l->setServiceForm($this);
		}
	}

	/**
	 * Clears out the collFilledForms collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFilledForms()
	 */
	public function clearFilledForms()
	{
		$this->collFilledForms = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFilledForms collection (array).
	 *
	 * By default this just sets the collFilledForms collection to an empty array (like clearcollFilledForms());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initFilledForms()
	{
		$this->collFilledForms = array();
	}

	/**
	 * Gets an array of FilledForm objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this ServiceForm has previously been saved, it will retrieve
	 * related FilledForms from storage. If this ServiceForm is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array FilledForm[]
	 * @throws     PropelException
	 */
	public function getFilledForms($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ServiceFormPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFilledForms === null) {
			if ($this->isNew()) {
			   $this->collFilledForms = array();
			} else {

				$criteria->add(FilledFormPeer::FORM_ID, $this->id);

				FilledFormPeer::addSelectColumns($criteria);
				$this->collFilledForms = FilledFormPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FilledFormPeer::FORM_ID, $this->id);

				FilledFormPeer::addSelectColumns($criteria);
				if (!isset($this->lastFilledFormCriteria) || !$this->lastFilledFormCriteria->equals($criteria)) {
					$this->collFilledForms = FilledFormPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFilledFormCriteria = $criteria;
		return $this->collFilledForms;
	}

	/**
	 * Returns the number of related FilledForm objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related FilledForm objects.
	 * @throws     PropelException
	 */
	public function countFilledForms(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ServiceFormPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collFilledForms === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(FilledFormPeer::FORM_ID, $this->id);

				$count = FilledFormPeer::doCount($criteria, false, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(FilledFormPeer::FORM_ID, $this->id);

				if (!isset($this->lastFilledFormCriteria) || !$this->lastFilledFormCriteria->equals($criteria)) {
					$count = FilledFormPeer::doCount($criteria, false, $con);
				} else {
					$count = count($this->collFilledForms);
				}
			} else {
				$count = count($this->collFilledForms);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a FilledForm object to this object
	 * through the FilledForm foreign key attribute.
	 *
	 * @param      FilledForm $l FilledForm
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFilledForm(FilledForm $l)
	{
		if ($this->collFilledForms === null) {
			$this->initFilledForms();
		}
		if (!in_array($l, $this->collFilledForms, true)) { // only add it if the **same** object is not already associated
			array_push($this->collFilledForms, $l);
			$l->setServiceForm($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ServiceForm is new, it will return
	 * an empty collection; or if this ServiceForm has previously
	 * been saved, it will retrieve related FilledForms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ServiceForm.
	 */
	public function getFilledFormsJoinsfGuardUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ServiceFormPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFilledForms === null) {
			if ($this->isNew()) {
				$this->collFilledForms = array();
			} else {

				$criteria->add(FilledFormPeer::FORM_ID, $this->id);

				$this->collFilledForms = FilledFormPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilledFormPeer::FORM_ID, $this->id);

			if (!isset($this->lastFilledFormCriteria) || !$this->lastFilledFormCriteria->equals($criteria)) {
				$this->collFilledForms = FilledFormPeer::doSelectJoinsfGuardUser($criteria, $con, $join_behavior);
			}
		}
		$this->lastFilledFormCriteria = $criteria;

		return $this->collFilledForms;
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
			if ($this->collFields) {
				foreach ((array) $this->collFields as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFilledForms) {
				foreach ((array) $this->collFilledForms as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collFields = null;
		$this->collFilledForms = null;
	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseServiceForm:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseServiceForm::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseServiceForm

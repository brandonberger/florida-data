<?php

namespace Models\Models\Base;

use \Exception;
use \PDO;
use Models\Models\Cities as ChildCities;
use Models\Models\CitiesQuery as ChildCitiesQuery;
use Models\Models\CityPlaces as ChildCityPlaces;
use Models\Models\CityPlacesQuery as ChildCityPlacesQuery;
use Models\Models\PlaceSubTypes as ChildPlaceSubTypes;
use Models\Models\PlaceSubTypesQuery as ChildPlaceSubTypesQuery;
use Models\Models\PlaceTypes as ChildPlaceTypes;
use Models\Models\PlaceTypesQuery as ChildPlaceTypesQuery;
use Models\Models\Places as ChildPlaces;
use Models\Models\PlacesQuery as ChildPlacesQuery;
use Models\Models\Map\CityPlacesTableMap;
use Models\Models\Map\PlacesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'places' table.
 *
 *
 *
 * @package    propel.generator.Models.Models.Base
 */
abstract class Places implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Models\\Models\\Map\\PlacesTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the place field.
     *
     * @var        string
     */
    protected $place;

    /**
     * The value for the place_type field.
     *
     * @var        int
     */
    protected $place_type;

    /**
     * The value for the place_sub_type field.
     *
     * @var        int
     */
    protected $place_sub_type;

    /**
     * @var        ChildPlaceTypes
     */
    protected $aPlaceTypes;

    /**
     * @var        ChildPlaceSubTypes
     */
    protected $aPlaceSubTypes;

    /**
     * @var        ObjectCollection|ChildCityPlaces[] Collection to store aggregation of ChildCityPlaces objects.
     */
    protected $collCityPlacess;
    protected $collCityPlacessPartial;

    /**
     * @var        ObjectCollection|ChildCities[] Cross Collection to store aggregation of ChildCities objects.
     */
    protected $collCitiess;

    /**
     * @var bool
     */
    protected $collCitiessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCities[]
     */
    protected $citiessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCityPlaces[]
     */
    protected $cityPlacessScheduledForDeletion = null;

    /**
     * Initializes internal state of Models\Models\Base\Places object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Places</code> instance.  If
     * <code>obj</code> is an instance of <code>Places</code>, delegates to
     * <code>equals(Places)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Places The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [place] column value.
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Get the [place_type] column value.
     *
     * @return int
     */
    public function getPlaceType()
    {
        return $this->place_type;
    }

    /**
     * Get the [place_sub_type] column value.
     *
     * @return int
     */
    public function getPlaceSubType()
    {
        return $this->place_sub_type;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Models\Models\Places The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[PlacesTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [place] column.
     *
     * @param string $v new value
     * @return $this|\Models\Models\Places The current object (for fluent API support)
     */
    public function setPlace($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->place !== $v) {
            $this->place = $v;
            $this->modifiedColumns[PlacesTableMap::COL_PLACE] = true;
        }

        return $this;
    } // setPlace()

    /**
     * Set the value of [place_type] column.
     *
     * @param int $v new value
     * @return $this|\Models\Models\Places The current object (for fluent API support)
     */
    public function setPlaceType($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->place_type !== $v) {
            $this->place_type = $v;
            $this->modifiedColumns[PlacesTableMap::COL_PLACE_TYPE] = true;
        }

        if ($this->aPlaceTypes !== null && $this->aPlaceTypes->getId() !== $v) {
            $this->aPlaceTypes = null;
        }

        return $this;
    } // setPlaceType()

    /**
     * Set the value of [place_sub_type] column.
     *
     * @param int $v new value
     * @return $this|\Models\Models\Places The current object (for fluent API support)
     */
    public function setPlaceSubType($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->place_sub_type !== $v) {
            $this->place_sub_type = $v;
            $this->modifiedColumns[PlacesTableMap::COL_PLACE_SUB_TYPE] = true;
        }

        if ($this->aPlaceSubTypes !== null && $this->aPlaceSubTypes->getId() !== $v) {
            $this->aPlaceSubTypes = null;
        }

        return $this;
    } // setPlaceSubType()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
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
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PlacesTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PlacesTableMap::translateFieldName('Place', TableMap::TYPE_PHPNAME, $indexType)];
            $this->place = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PlacesTableMap::translateFieldName('PlaceType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->place_type = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PlacesTableMap::translateFieldName('PlaceSubType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->place_sub_type = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = PlacesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Models\\Models\\Places'), 0, $e);
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
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aPlaceTypes !== null && $this->place_type !== $this->aPlaceTypes->getId()) {
            $this->aPlaceTypes = null;
        }
        if ($this->aPlaceSubTypes !== null && $this->place_sub_type !== $this->aPlaceSubTypes->getId()) {
            $this->aPlaceSubTypes = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PlacesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPlacesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPlaceTypes = null;
            $this->aPlaceSubTypes = null;
            $this->collCityPlacess = null;

            $this->collCitiess = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Places::setDeleted()
     * @see Places::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PlacesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPlacesQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PlacesTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
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
                PlacesTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aPlaceTypes !== null) {
                if ($this->aPlaceTypes->isModified() || $this->aPlaceTypes->isNew()) {
                    $affectedRows += $this->aPlaceTypes->save($con);
                }
                $this->setPlaceTypes($this->aPlaceTypes);
            }

            if ($this->aPlaceSubTypes !== null) {
                if ($this->aPlaceSubTypes->isModified() || $this->aPlaceSubTypes->isNew()) {
                    $affectedRows += $this->aPlaceSubTypes->save($con);
                }
                $this->setPlaceSubTypes($this->aPlaceSubTypes);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->citiessScheduledForDeletion !== null) {
                if (!$this->citiessScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->citiessScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getId();
                        $entryPk[0] = $entry->getId();
                        $pks[] = $entryPk;
                    }

                    \Models\Models\CityPlacesQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->citiessScheduledForDeletion = null;
                }

            }

            if ($this->collCitiess) {
                foreach ($this->collCitiess as $cities) {
                    if (!$cities->isDeleted() && ($cities->isNew() || $cities->isModified())) {
                        $cities->save($con);
                    }
                }
            }


            if ($this->cityPlacessScheduledForDeletion !== null) {
                if (!$this->cityPlacessScheduledForDeletion->isEmpty()) {
                    \Models\Models\CityPlacesQuery::create()
                        ->filterByPrimaryKeys($this->cityPlacessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->cityPlacessScheduledForDeletion = null;
                }
            }

            if ($this->collCityPlacess !== null) {
                foreach ($this->collCityPlacess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[PlacesTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PlacesTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PlacesTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(PlacesTableMap::COL_PLACE)) {
            $modifiedColumns[':p' . $index++]  = 'place';
        }
        if ($this->isColumnModified(PlacesTableMap::COL_PLACE_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'place_type';
        }
        if ($this->isColumnModified(PlacesTableMap::COL_PLACE_SUB_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'place_sub_type';
        }

        $sql = sprintf(
            'INSERT INTO places (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'place':
                        $stmt->bindValue($identifier, $this->place, PDO::PARAM_STR);
                        break;
                    case 'place_type':
                        $stmt->bindValue($identifier, $this->place_type, PDO::PARAM_INT);
                        break;
                    case 'place_sub_type':
                        $stmt->bindValue($identifier, $this->place_sub_type, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PlacesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getPlace();
                break;
            case 2:
                return $this->getPlaceType();
                break;
            case 3:
                return $this->getPlaceSubType();
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
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Places'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Places'][$this->hashCode()] = true;
        $keys = PlacesTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPlace(),
            $keys[2] => $this->getPlaceType(),
            $keys[3] => $this->getPlaceSubType(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aPlaceTypes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'placeTypes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'place_types';
                        break;
                    default:
                        $key = 'PlaceTypes';
                }

                $result[$key] = $this->aPlaceTypes->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPlaceSubTypes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'placeSubTypes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'place_sub_types';
                        break;
                    default:
                        $key = 'PlaceSubTypes';
                }

                $result[$key] = $this->aPlaceSubTypes->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collCityPlacess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'cityPlacess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'city_placess';
                        break;
                    default:
                        $key = 'CityPlacess';
                }

                $result[$key] = $this->collCityPlacess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Models\Models\Places
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PlacesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Models\Models\Places
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setPlace($value);
                break;
            case 2:
                $this->setPlaceType($value);
                break;
            case 3:
                $this->setPlaceSubType($value);
                break;
        } // switch()

        return $this;
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
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = PlacesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPlace($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPlaceType($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPlaceSubType($arr[$keys[3]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Models\Models\Places The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PlacesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PlacesTableMap::COL_ID)) {
            $criteria->add(PlacesTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(PlacesTableMap::COL_PLACE)) {
            $criteria->add(PlacesTableMap::COL_PLACE, $this->place);
        }
        if ($this->isColumnModified(PlacesTableMap::COL_PLACE_TYPE)) {
            $criteria->add(PlacesTableMap::COL_PLACE_TYPE, $this->place_type);
        }
        if ($this->isColumnModified(PlacesTableMap::COL_PLACE_SUB_TYPE)) {
            $criteria->add(PlacesTableMap::COL_PLACE_SUB_TYPE, $this->place_sub_type);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildPlacesQuery::create();
        $criteria->add(PlacesTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Models\Models\Places (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPlace($this->getPlace());
        $copyObj->setPlaceType($this->getPlaceType());
        $copyObj->setPlaceSubType($this->getPlaceSubType());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCityPlacess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCityPlaces($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Models\Models\Places Clone of current object.
     * @throws PropelException
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
     * Declares an association between this object and a ChildPlaceTypes object.
     *
     * @param  ChildPlaceTypes $v
     * @return $this|\Models\Models\Places The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPlaceTypes(ChildPlaceTypes $v = null)
    {
        if ($v === null) {
            $this->setPlaceType(NULL);
        } else {
            $this->setPlaceType($v->getId());
        }

        $this->aPlaceTypes = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPlaceTypes object, it will not be re-added.
        if ($v !== null) {
            $v->addPlaces($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPlaceTypes object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPlaceTypes The associated ChildPlaceTypes object.
     * @throws PropelException
     */
    public function getPlaceTypes(ConnectionInterface $con = null)
    {
        if ($this->aPlaceTypes === null && ($this->place_type != 0)) {
            $this->aPlaceTypes = ChildPlaceTypesQuery::create()->findPk($this->place_type, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPlaceTypes->addPlacess($this);
             */
        }

        return $this->aPlaceTypes;
    }

    /**
     * Declares an association between this object and a ChildPlaceSubTypes object.
     *
     * @param  ChildPlaceSubTypes $v
     * @return $this|\Models\Models\Places The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPlaceSubTypes(ChildPlaceSubTypes $v = null)
    {
        if ($v === null) {
            $this->setPlaceSubType(NULL);
        } else {
            $this->setPlaceSubType($v->getId());
        }

        $this->aPlaceSubTypes = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPlaceSubTypes object, it will not be re-added.
        if ($v !== null) {
            $v->addPlaces($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPlaceSubTypes object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPlaceSubTypes The associated ChildPlaceSubTypes object.
     * @throws PropelException
     */
    public function getPlaceSubTypes(ConnectionInterface $con = null)
    {
        if ($this->aPlaceSubTypes === null && ($this->place_sub_type != 0)) {
            $this->aPlaceSubTypes = ChildPlaceSubTypesQuery::create()->findPk($this->place_sub_type, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPlaceSubTypes->addPlacess($this);
             */
        }

        return $this->aPlaceSubTypes;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('CityPlaces' == $relationName) {
            $this->initCityPlacess();
            return;
        }
    }

    /**
     * Clears out the collCityPlacess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCityPlacess()
     */
    public function clearCityPlacess()
    {
        $this->collCityPlacess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCityPlacess collection loaded partially.
     */
    public function resetPartialCityPlacess($v = true)
    {
        $this->collCityPlacessPartial = $v;
    }

    /**
     * Initializes the collCityPlacess collection.
     *
     * By default this just sets the collCityPlacess collection to an empty array (like clearcollCityPlacess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCityPlacess($overrideExisting = true)
    {
        if (null !== $this->collCityPlacess && !$overrideExisting) {
            return;
        }

        $collectionClassName = CityPlacesTableMap::getTableMap()->getCollectionClassName();

        $this->collCityPlacess = new $collectionClassName;
        $this->collCityPlacess->setModel('\Models\Models\CityPlaces');
    }

    /**
     * Gets an array of ChildCityPlaces objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPlaces is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCityPlaces[] List of ChildCityPlaces objects
     * @throws PropelException
     */
    public function getCityPlacess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCityPlacessPartial && !$this->isNew();
        if (null === $this->collCityPlacess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCityPlacess) {
                // return empty collection
                $this->initCityPlacess();
            } else {
                $collCityPlacess = ChildCityPlacesQuery::create(null, $criteria)
                    ->filterByPlaces($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCityPlacessPartial && count($collCityPlacess)) {
                        $this->initCityPlacess(false);

                        foreach ($collCityPlacess as $obj) {
                            if (false == $this->collCityPlacess->contains($obj)) {
                                $this->collCityPlacess->append($obj);
                            }
                        }

                        $this->collCityPlacessPartial = true;
                    }

                    return $collCityPlacess;
                }

                if ($partial && $this->collCityPlacess) {
                    foreach ($this->collCityPlacess as $obj) {
                        if ($obj->isNew()) {
                            $collCityPlacess[] = $obj;
                        }
                    }
                }

                $this->collCityPlacess = $collCityPlacess;
                $this->collCityPlacessPartial = false;
            }
        }

        return $this->collCityPlacess;
    }

    /**
     * Sets a collection of ChildCityPlaces objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $cityPlacess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPlaces The current object (for fluent API support)
     */
    public function setCityPlacess(Collection $cityPlacess, ConnectionInterface $con = null)
    {
        /** @var ChildCityPlaces[] $cityPlacessToDelete */
        $cityPlacessToDelete = $this->getCityPlacess(new Criteria(), $con)->diff($cityPlacess);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->cityPlacessScheduledForDeletion = clone $cityPlacessToDelete;

        foreach ($cityPlacessToDelete as $cityPlacesRemoved) {
            $cityPlacesRemoved->setPlaces(null);
        }

        $this->collCityPlacess = null;
        foreach ($cityPlacess as $cityPlaces) {
            $this->addCityPlaces($cityPlaces);
        }

        $this->collCityPlacess = $cityPlacess;
        $this->collCityPlacessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CityPlaces objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CityPlaces objects.
     * @throws PropelException
     */
    public function countCityPlacess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCityPlacessPartial && !$this->isNew();
        if (null === $this->collCityPlacess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCityPlacess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCityPlacess());
            }

            $query = ChildCityPlacesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPlaces($this)
                ->count($con);
        }

        return count($this->collCityPlacess);
    }

    /**
     * Method called to associate a ChildCityPlaces object to this object
     * through the ChildCityPlaces foreign key attribute.
     *
     * @param  ChildCityPlaces $l ChildCityPlaces
     * @return $this|\Models\Models\Places The current object (for fluent API support)
     */
    public function addCityPlaces(ChildCityPlaces $l)
    {
        if ($this->collCityPlacess === null) {
            $this->initCityPlacess();
            $this->collCityPlacessPartial = true;
        }

        if (!$this->collCityPlacess->contains($l)) {
            $this->doAddCityPlaces($l);

            if ($this->cityPlacessScheduledForDeletion and $this->cityPlacessScheduledForDeletion->contains($l)) {
                $this->cityPlacessScheduledForDeletion->remove($this->cityPlacessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildCityPlaces $cityPlaces The ChildCityPlaces object to add.
     */
    protected function doAddCityPlaces(ChildCityPlaces $cityPlaces)
    {
        $this->collCityPlacess[]= $cityPlaces;
        $cityPlaces->setPlaces($this);
    }

    /**
     * @param  ChildCityPlaces $cityPlaces The ChildCityPlaces object to remove.
     * @return $this|ChildPlaces The current object (for fluent API support)
     */
    public function removeCityPlaces(ChildCityPlaces $cityPlaces)
    {
        if ($this->getCityPlacess()->contains($cityPlaces)) {
            $pos = $this->collCityPlacess->search($cityPlaces);
            $this->collCityPlacess->remove($pos);
            if (null === $this->cityPlacessScheduledForDeletion) {
                $this->cityPlacessScheduledForDeletion = clone $this->collCityPlacess;
                $this->cityPlacessScheduledForDeletion->clear();
            }
            $this->cityPlacessScheduledForDeletion[]= clone $cityPlaces;
            $cityPlaces->setPlaces(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Places is new, it will return
     * an empty collection; or if this Places has previously
     * been saved, it will retrieve related CityPlacess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Places.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCityPlaces[] List of ChildCityPlaces objects
     */
    public function getCityPlacessJoinCities(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCityPlacesQuery::create(null, $criteria);
        $query->joinWith('Cities', $joinBehavior);

        return $this->getCityPlacess($query, $con);
    }

    /**
     * Clears out the collCitiess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCitiess()
     */
    public function clearCitiess()
    {
        $this->collCitiess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collCitiess crossRef collection.
     *
     * By default this just sets the collCitiess collection to an empty collection (like clearCitiess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initCitiess()
    {
        $collectionClassName = CityPlacesTableMap::getTableMap()->getCollectionClassName();

        $this->collCitiess = new $collectionClassName;
        $this->collCitiessPartial = true;
        $this->collCitiess->setModel('\Models\Models\Cities');
    }

    /**
     * Checks if the collCitiess collection is loaded.
     *
     * @return bool
     */
    public function isCitiessLoaded()
    {
        return null !== $this->collCitiess;
    }

    /**
     * Gets a collection of ChildCities objects related by a many-to-many relationship
     * to the current object by way of the city_places cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPlaces is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildCities[] List of ChildCities objects
     */
    public function getCitiess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCitiessPartial && !$this->isNew();
        if (null === $this->collCitiess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collCitiess) {
                    $this->initCitiess();
                }
            } else {

                $query = ChildCitiesQuery::create(null, $criteria)
                    ->filterByPlaces($this);
                $collCitiess = $query->find($con);
                if (null !== $criteria) {
                    return $collCitiess;
                }

                if ($partial && $this->collCitiess) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collCitiess as $obj) {
                        if (!$collCitiess->contains($obj)) {
                            $collCitiess[] = $obj;
                        }
                    }
                }

                $this->collCitiess = $collCitiess;
                $this->collCitiessPartial = false;
            }
        }

        return $this->collCitiess;
    }

    /**
     * Sets a collection of Cities objects related by a many-to-many relationship
     * to the current object by way of the city_places cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $citiess A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildPlaces The current object (for fluent API support)
     */
    public function setCitiess(Collection $citiess, ConnectionInterface $con = null)
    {
        $this->clearCitiess();
        $currentCitiess = $this->getCitiess();

        $citiessScheduledForDeletion = $currentCitiess->diff($citiess);

        foreach ($citiessScheduledForDeletion as $toDelete) {
            $this->removeCities($toDelete);
        }

        foreach ($citiess as $cities) {
            if (!$currentCitiess->contains($cities)) {
                $this->doAddCities($cities);
            }
        }

        $this->collCitiessPartial = false;
        $this->collCitiess = $citiess;

        return $this;
    }

    /**
     * Gets the number of Cities objects related by a many-to-many relationship
     * to the current object by way of the city_places cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related Cities objects
     */
    public function countCitiess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCitiessPartial && !$this->isNew();
        if (null === $this->collCitiess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCitiess) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getCitiess());
                }

                $query = ChildCitiesQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByPlaces($this)
                    ->count($con);
            }
        } else {
            return count($this->collCitiess);
        }
    }

    /**
     * Associate a ChildCities to this object
     * through the city_places cross reference table.
     *
     * @param ChildCities $cities
     * @return ChildPlaces The current object (for fluent API support)
     */
    public function addCities(ChildCities $cities)
    {
        if ($this->collCitiess === null) {
            $this->initCitiess();
        }

        if (!$this->getCitiess()->contains($cities)) {
            // only add it if the **same** object is not already associated
            $this->collCitiess->push($cities);
            $this->doAddCities($cities);
        }

        return $this;
    }

    /**
     *
     * @param ChildCities $cities
     */
    protected function doAddCities(ChildCities $cities)
    {
        $cityPlaces = new ChildCityPlaces();

        $cityPlaces->setCities($cities);

        $cityPlaces->setPlaces($this);

        $this->addCityPlaces($cityPlaces);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$cities->isPlacessLoaded()) {
            $cities->initPlacess();
            $cities->getPlacess()->push($this);
        } elseif (!$cities->getPlacess()->contains($this)) {
            $cities->getPlacess()->push($this);
        }

    }

    /**
     * Remove cities of this object
     * through the city_places cross reference table.
     *
     * @param ChildCities $cities
     * @return ChildPlaces The current object (for fluent API support)
     */
    public function removeCities(ChildCities $cities)
    {
        if ($this->getCitiess()->contains($cities)) {
            $cityPlaces = new ChildCityPlaces();
            $cityPlaces->setCities($cities);
            if ($cities->isPlacessLoaded()) {
                //remove the back reference if available
                $cities->getPlacess()->removeObject($this);
            }

            $cityPlaces->setPlaces($this);
            $this->removeCityPlaces(clone $cityPlaces);
            $cityPlaces->clear();

            $this->collCitiess->remove($this->collCitiess->search($cities));

            if (null === $this->citiessScheduledForDeletion) {
                $this->citiessScheduledForDeletion = clone $this->collCitiess;
                $this->citiessScheduledForDeletion->clear();
            }

            $this->citiessScheduledForDeletion->push($cities);
        }


        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aPlaceTypes) {
            $this->aPlaceTypes->removePlaces($this);
        }
        if (null !== $this->aPlaceSubTypes) {
            $this->aPlaceSubTypes->removePlaces($this);
        }
        $this->id = null;
        $this->place = null;
        $this->place_type = null;
        $this->place_sub_type = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collCityPlacess) {
                foreach ($this->collCityPlacess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCitiess) {
                foreach ($this->collCitiess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCityPlacess = null;
        $this->collCitiess = null;
        $this->aPlaceTypes = null;
        $this->aPlaceSubTypes = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PlacesTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}

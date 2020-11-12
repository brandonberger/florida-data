<?php

namespace Models\Models\Base;

use \Exception;
use \PDO;
use Models\Models\States as ChildStates;
use Models\Models\StatesQuery as ChildStatesQuery;
use Models\Models\Map\StatesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'states' table.
 *
 *
 *
 * @method     ChildStatesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildStatesQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method     ChildStatesQuery orderByAbbrevation($order = Criteria::ASC) Order by the abbrevation column
 *
 * @method     ChildStatesQuery groupById() Group by the id column
 * @method     ChildStatesQuery groupByState() Group by the state column
 * @method     ChildStatesQuery groupByAbbrevation() Group by the abbrevation column
 *
 * @method     ChildStatesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildStatesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildStatesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildStatesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildStatesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildStatesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildStatesQuery leftJoinCounties($relationAlias = null) Adds a LEFT JOIN clause to the query using the Counties relation
 * @method     ChildStatesQuery rightJoinCounties($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Counties relation
 * @method     ChildStatesQuery innerJoinCounties($relationAlias = null) Adds a INNER JOIN clause to the query using the Counties relation
 *
 * @method     ChildStatesQuery joinWithCounties($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Counties relation
 *
 * @method     ChildStatesQuery leftJoinWithCounties() Adds a LEFT JOIN clause and with to the query using the Counties relation
 * @method     ChildStatesQuery rightJoinWithCounties() Adds a RIGHT JOIN clause and with to the query using the Counties relation
 * @method     ChildStatesQuery innerJoinWithCounties() Adds a INNER JOIN clause and with to the query using the Counties relation
 *
 * @method     \Models\Models\CountiesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildStates findOne(ConnectionInterface $con = null) Return the first ChildStates matching the query
 * @method     ChildStates findOneOrCreate(ConnectionInterface $con = null) Return the first ChildStates matching the query, or a new ChildStates object populated from the query conditions when no match is found
 *
 * @method     ChildStates findOneById(int $id) Return the first ChildStates filtered by the id column
 * @method     ChildStates findOneByState(string $state) Return the first ChildStates filtered by the state column
 * @method     ChildStates findOneByAbbrevation(string $abbrevation) Return the first ChildStates filtered by the abbrevation column *

 * @method     ChildStates requirePk($key, ConnectionInterface $con = null) Return the ChildStates by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStates requireOne(ConnectionInterface $con = null) Return the first ChildStates matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStates requireOneById(int $id) Return the first ChildStates filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStates requireOneByState(string $state) Return the first ChildStates filtered by the state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildStates requireOneByAbbrevation(string $abbrevation) Return the first ChildStates filtered by the abbrevation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildStates[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildStates objects based on current ModelCriteria
 * @method     ChildStates[]|ObjectCollection findById(int $id) Return ChildStates objects filtered by the id column
 * @method     ChildStates[]|ObjectCollection findByState(string $state) Return ChildStates objects filtered by the state column
 * @method     ChildStates[]|ObjectCollection findByAbbrevation(string $abbrevation) Return ChildStates objects filtered by the abbrevation column
 * @method     ChildStates[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class StatesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Models\Models\Base\StatesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Models\\Models\\States', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildStatesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildStatesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildStatesQuery) {
            return $criteria;
        }
        $query = new ChildStatesQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildStates|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(StatesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = StatesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildStates A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, state, abbrevation FROM states WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildStates $obj */
            $obj = new ChildStates();
            $obj->hydrate($row);
            StatesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildStates|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildStatesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(StatesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildStatesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(StatesTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStatesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(StatesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(StatesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the state column
     *
     * Example usage:
     * <code>
     * $query->filterByState('fooValue');   // WHERE state = 'fooValue'
     * $query->filterByState('%fooValue%', Criteria::LIKE); // WHERE state LIKE '%fooValue%'
     * </code>
     *
     * @param     string $state The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStatesQuery The current query, for fluid interface
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($state)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatesTableMap::COL_STATE, $state, $comparison);
    }

    /**
     * Filter the query on the abbrevation column
     *
     * Example usage:
     * <code>
     * $query->filterByAbbrevation('fooValue');   // WHERE abbrevation = 'fooValue'
     * $query->filterByAbbrevation('%fooValue%', Criteria::LIKE); // WHERE abbrevation LIKE '%fooValue%'
     * </code>
     *
     * @param     string $abbrevation The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildStatesQuery The current query, for fluid interface
     */
    public function filterByAbbrevation($abbrevation = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($abbrevation)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(StatesTableMap::COL_ABBREVATION, $abbrevation, $comparison);
    }

    /**
     * Filter the query by a related \Models\Models\Counties object
     *
     * @param \Models\Models\Counties|ObjectCollection $counties the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildStatesQuery The current query, for fluid interface
     */
    public function filterByCounties($counties, $comparison = null)
    {
        if ($counties instanceof \Models\Models\Counties) {
            return $this
                ->addUsingAlias(StatesTableMap::COL_ID, $counties->getStateId(), $comparison);
        } elseif ($counties instanceof ObjectCollection) {
            return $this
                ->useCountiesQuery()
                ->filterByPrimaryKeys($counties->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCounties() only accepts arguments of type \Models\Models\Counties or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Counties relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildStatesQuery The current query, for fluid interface
     */
    public function joinCounties($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Counties');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Counties');
        }

        return $this;
    }

    /**
     * Use the Counties relation Counties object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Models\Models\CountiesQuery A secondary query class using the current class as primary query
     */
    public function useCountiesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCounties($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Counties', '\Models\Models\CountiesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildStates $states Object to remove from the list of results
     *
     * @return $this|ChildStatesQuery The current query, for fluid interface
     */
    public function prune($states = null)
    {
        if ($states) {
            $this->addUsingAlias(StatesTableMap::COL_ID, $states->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the states table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StatesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            StatesTableMap::clearInstancePool();
            StatesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(StatesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(StatesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            StatesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            StatesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // StatesQuery

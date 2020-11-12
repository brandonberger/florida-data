<?php

namespace Models\Models\Base;

use \Exception;
use \PDO;
use Models\Models\CityRoadAliases as ChildCityRoadAliases;
use Models\Models\CityRoadAliasesQuery as ChildCityRoadAliasesQuery;
use Models\Models\Map\CityRoadAliasesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'city_road_aliases' table.
 *
 *
 *
 * @method     ChildCityRoadAliasesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCityRoadAliasesQuery orderByCityRoadId($order = Criteria::ASC) Order by the city_road_id column
 * @method     ChildCityRoadAliasesQuery orderByAlias($order = Criteria::ASC) Order by the alias column
 *
 * @method     ChildCityRoadAliasesQuery groupById() Group by the id column
 * @method     ChildCityRoadAliasesQuery groupByCityRoadId() Group by the city_road_id column
 * @method     ChildCityRoadAliasesQuery groupByAlias() Group by the alias column
 *
 * @method     ChildCityRoadAliasesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCityRoadAliasesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCityRoadAliasesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCityRoadAliasesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCityRoadAliasesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCityRoadAliasesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCityRoadAliasesQuery leftJoinCityRoads($relationAlias = null) Adds a LEFT JOIN clause to the query using the CityRoads relation
 * @method     ChildCityRoadAliasesQuery rightJoinCityRoads($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CityRoads relation
 * @method     ChildCityRoadAliasesQuery innerJoinCityRoads($relationAlias = null) Adds a INNER JOIN clause to the query using the CityRoads relation
 *
 * @method     ChildCityRoadAliasesQuery joinWithCityRoads($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CityRoads relation
 *
 * @method     ChildCityRoadAliasesQuery leftJoinWithCityRoads() Adds a LEFT JOIN clause and with to the query using the CityRoads relation
 * @method     ChildCityRoadAliasesQuery rightJoinWithCityRoads() Adds a RIGHT JOIN clause and with to the query using the CityRoads relation
 * @method     ChildCityRoadAliasesQuery innerJoinWithCityRoads() Adds a INNER JOIN clause and with to the query using the CityRoads relation
 *
 * @method     \Models\Models\CityRoadsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCityRoadAliases findOne(ConnectionInterface $con = null) Return the first ChildCityRoadAliases matching the query
 * @method     ChildCityRoadAliases findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCityRoadAliases matching the query, or a new ChildCityRoadAliases object populated from the query conditions when no match is found
 *
 * @method     ChildCityRoadAliases findOneById(int $id) Return the first ChildCityRoadAliases filtered by the id column
 * @method     ChildCityRoadAliases findOneByCityRoadId(int $city_road_id) Return the first ChildCityRoadAliases filtered by the city_road_id column
 * @method     ChildCityRoadAliases findOneByAlias(string $alias) Return the first ChildCityRoadAliases filtered by the alias column *

 * @method     ChildCityRoadAliases requirePk($key, ConnectionInterface $con = null) Return the ChildCityRoadAliases by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCityRoadAliases requireOne(ConnectionInterface $con = null) Return the first ChildCityRoadAliases matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCityRoadAliases requireOneById(int $id) Return the first ChildCityRoadAliases filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCityRoadAliases requireOneByCityRoadId(int $city_road_id) Return the first ChildCityRoadAliases filtered by the city_road_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCityRoadAliases requireOneByAlias(string $alias) Return the first ChildCityRoadAliases filtered by the alias column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCityRoadAliases[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCityRoadAliases objects based on current ModelCriteria
 * @method     ChildCityRoadAliases[]|ObjectCollection findById(int $id) Return ChildCityRoadAliases objects filtered by the id column
 * @method     ChildCityRoadAliases[]|ObjectCollection findByCityRoadId(int $city_road_id) Return ChildCityRoadAliases objects filtered by the city_road_id column
 * @method     ChildCityRoadAliases[]|ObjectCollection findByAlias(string $alias) Return ChildCityRoadAliases objects filtered by the alias column
 * @method     ChildCityRoadAliases[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CityRoadAliasesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Models\Models\Base\CityRoadAliasesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Models\\Models\\CityRoadAliases', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCityRoadAliasesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCityRoadAliasesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCityRoadAliasesQuery) {
            return $criteria;
        }
        $query = new ChildCityRoadAliasesQuery();
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
     * @return ChildCityRoadAliases|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CityRoadAliasesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CityRoadAliasesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCityRoadAliases A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, city_road_id, alias FROM city_road_aliases WHERE id = :p0';
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
            /** @var ChildCityRoadAliases $obj */
            $obj = new ChildCityRoadAliases();
            $obj->hydrate($row);
            CityRoadAliasesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCityRoadAliases|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCityRoadAliasesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CityRoadAliasesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCityRoadAliasesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CityRoadAliasesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCityRoadAliasesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CityRoadAliasesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CityRoadAliasesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CityRoadAliasesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the city_road_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCityRoadId(1234); // WHERE city_road_id = 1234
     * $query->filterByCityRoadId(array(12, 34)); // WHERE city_road_id IN (12, 34)
     * $query->filterByCityRoadId(array('min' => 12)); // WHERE city_road_id > 12
     * </code>
     *
     * @see       filterByCityRoads()
     *
     * @param     mixed $cityRoadId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCityRoadAliasesQuery The current query, for fluid interface
     */
    public function filterByCityRoadId($cityRoadId = null, $comparison = null)
    {
        if (is_array($cityRoadId)) {
            $useMinMax = false;
            if (isset($cityRoadId['min'])) {
                $this->addUsingAlias(CityRoadAliasesTableMap::COL_CITY_ROAD_ID, $cityRoadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cityRoadId['max'])) {
                $this->addUsingAlias(CityRoadAliasesTableMap::COL_CITY_ROAD_ID, $cityRoadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CityRoadAliasesTableMap::COL_CITY_ROAD_ID, $cityRoadId, $comparison);
    }

    /**
     * Filter the query on the alias column
     *
     * Example usage:
     * <code>
     * $query->filterByAlias('fooValue');   // WHERE alias = 'fooValue'
     * $query->filterByAlias('%fooValue%', Criteria::LIKE); // WHERE alias LIKE '%fooValue%'
     * </code>
     *
     * @param     string $alias The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCityRoadAliasesQuery The current query, for fluid interface
     */
    public function filterByAlias($alias = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($alias)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CityRoadAliasesTableMap::COL_ALIAS, $alias, $comparison);
    }

    /**
     * Filter the query by a related \Models\Models\CityRoads object
     *
     * @param \Models\Models\CityRoads|ObjectCollection $cityRoads The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCityRoadAliasesQuery The current query, for fluid interface
     */
    public function filterByCityRoads($cityRoads, $comparison = null)
    {
        if ($cityRoads instanceof \Models\Models\CityRoads) {
            return $this
                ->addUsingAlias(CityRoadAliasesTableMap::COL_CITY_ROAD_ID, $cityRoads->getId(), $comparison);
        } elseif ($cityRoads instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CityRoadAliasesTableMap::COL_CITY_ROAD_ID, $cityRoads->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCityRoads() only accepts arguments of type \Models\Models\CityRoads or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CityRoads relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCityRoadAliasesQuery The current query, for fluid interface
     */
    public function joinCityRoads($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CityRoads');

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
            $this->addJoinObject($join, 'CityRoads');
        }

        return $this;
    }

    /**
     * Use the CityRoads relation CityRoads object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Models\Models\CityRoadsQuery A secondary query class using the current class as primary query
     */
    public function useCityRoadsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCityRoads($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CityRoads', '\Models\Models\CityRoadsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCityRoadAliases $cityRoadAliases Object to remove from the list of results
     *
     * @return $this|ChildCityRoadAliasesQuery The current query, for fluid interface
     */
    public function prune($cityRoadAliases = null)
    {
        if ($cityRoadAliases) {
            $this->addUsingAlias(CityRoadAliasesTableMap::COL_ID, $cityRoadAliases->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the city_road_aliases table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CityRoadAliasesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CityRoadAliasesTableMap::clearInstancePool();
            CityRoadAliasesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CityRoadAliasesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CityRoadAliasesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CityRoadAliasesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CityRoadAliasesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CityRoadAliasesQuery

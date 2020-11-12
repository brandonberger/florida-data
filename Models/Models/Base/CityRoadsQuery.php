<?php

namespace Models\Models\Base;

use \Exception;
use \PDO;
use Models\Models\CityRoads as ChildCityRoads;
use Models\Models\CityRoadsQuery as ChildCityRoadsQuery;
use Models\Models\Map\CityRoadsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'city_roads' table.
 *
 *
 *
 * @method     ChildCityRoadsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCityRoadsQuery orderByRoadId($order = Criteria::ASC) Order by the road_id column
 * @method     ChildCityRoadsQuery orderByCityId($order = Criteria::ASC) Order by the city_id column
 *
 * @method     ChildCityRoadsQuery groupById() Group by the id column
 * @method     ChildCityRoadsQuery groupByRoadId() Group by the road_id column
 * @method     ChildCityRoadsQuery groupByCityId() Group by the city_id column
 *
 * @method     ChildCityRoadsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCityRoadsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCityRoadsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCityRoadsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCityRoadsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCityRoadsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCityRoadsQuery leftJoinRoads($relationAlias = null) Adds a LEFT JOIN clause to the query using the Roads relation
 * @method     ChildCityRoadsQuery rightJoinRoads($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Roads relation
 * @method     ChildCityRoadsQuery innerJoinRoads($relationAlias = null) Adds a INNER JOIN clause to the query using the Roads relation
 *
 * @method     ChildCityRoadsQuery joinWithRoads($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Roads relation
 *
 * @method     ChildCityRoadsQuery leftJoinWithRoads() Adds a LEFT JOIN clause and with to the query using the Roads relation
 * @method     ChildCityRoadsQuery rightJoinWithRoads() Adds a RIGHT JOIN clause and with to the query using the Roads relation
 * @method     ChildCityRoadsQuery innerJoinWithRoads() Adds a INNER JOIN clause and with to the query using the Roads relation
 *
 * @method     ChildCityRoadsQuery leftJoinCities($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cities relation
 * @method     ChildCityRoadsQuery rightJoinCities($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cities relation
 * @method     ChildCityRoadsQuery innerJoinCities($relationAlias = null) Adds a INNER JOIN clause to the query using the Cities relation
 *
 * @method     ChildCityRoadsQuery joinWithCities($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Cities relation
 *
 * @method     ChildCityRoadsQuery leftJoinWithCities() Adds a LEFT JOIN clause and with to the query using the Cities relation
 * @method     ChildCityRoadsQuery rightJoinWithCities() Adds a RIGHT JOIN clause and with to the query using the Cities relation
 * @method     ChildCityRoadsQuery innerJoinWithCities() Adds a INNER JOIN clause and with to the query using the Cities relation
 *
 * @method     ChildCityRoadsQuery leftJoinCityRoadAliases($relationAlias = null) Adds a LEFT JOIN clause to the query using the CityRoadAliases relation
 * @method     ChildCityRoadsQuery rightJoinCityRoadAliases($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CityRoadAliases relation
 * @method     ChildCityRoadsQuery innerJoinCityRoadAliases($relationAlias = null) Adds a INNER JOIN clause to the query using the CityRoadAliases relation
 *
 * @method     ChildCityRoadsQuery joinWithCityRoadAliases($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CityRoadAliases relation
 *
 * @method     ChildCityRoadsQuery leftJoinWithCityRoadAliases() Adds a LEFT JOIN clause and with to the query using the CityRoadAliases relation
 * @method     ChildCityRoadsQuery rightJoinWithCityRoadAliases() Adds a RIGHT JOIN clause and with to the query using the CityRoadAliases relation
 * @method     ChildCityRoadsQuery innerJoinWithCityRoadAliases() Adds a INNER JOIN clause and with to the query using the CityRoadAliases relation
 *
 * @method     \Models\Models\RoadsQuery|\Models\Models\CitiesQuery|\Models\Models\CityRoadAliasesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCityRoads findOne(ConnectionInterface $con = null) Return the first ChildCityRoads matching the query
 * @method     ChildCityRoads findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCityRoads matching the query, or a new ChildCityRoads object populated from the query conditions when no match is found
 *
 * @method     ChildCityRoads findOneById(int $id) Return the first ChildCityRoads filtered by the id column
 * @method     ChildCityRoads findOneByRoadId(int $road_id) Return the first ChildCityRoads filtered by the road_id column
 * @method     ChildCityRoads findOneByCityId(int $city_id) Return the first ChildCityRoads filtered by the city_id column *

 * @method     ChildCityRoads requirePk($key, ConnectionInterface $con = null) Return the ChildCityRoads by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCityRoads requireOne(ConnectionInterface $con = null) Return the first ChildCityRoads matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCityRoads requireOneById(int $id) Return the first ChildCityRoads filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCityRoads requireOneByRoadId(int $road_id) Return the first ChildCityRoads filtered by the road_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCityRoads requireOneByCityId(int $city_id) Return the first ChildCityRoads filtered by the city_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCityRoads[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCityRoads objects based on current ModelCriteria
 * @method     ChildCityRoads[]|ObjectCollection findById(int $id) Return ChildCityRoads objects filtered by the id column
 * @method     ChildCityRoads[]|ObjectCollection findByRoadId(int $road_id) Return ChildCityRoads objects filtered by the road_id column
 * @method     ChildCityRoads[]|ObjectCollection findByCityId(int $city_id) Return ChildCityRoads objects filtered by the city_id column
 * @method     ChildCityRoads[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CityRoadsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Models\Models\Base\CityRoadsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Models\\Models\\CityRoads', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCityRoadsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCityRoadsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCityRoadsQuery) {
            return $criteria;
        }
        $query = new ChildCityRoadsQuery();
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
     * @return ChildCityRoads|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CityRoadsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CityRoadsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCityRoads A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, road_id, city_id FROM city_roads WHERE id = :p0';
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
            /** @var ChildCityRoads $obj */
            $obj = new ChildCityRoads();
            $obj->hydrate($row);
            CityRoadsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCityRoads|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCityRoadsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CityRoadsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCityRoadsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CityRoadsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCityRoadsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CityRoadsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CityRoadsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CityRoadsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the road_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRoadId(1234); // WHERE road_id = 1234
     * $query->filterByRoadId(array(12, 34)); // WHERE road_id IN (12, 34)
     * $query->filterByRoadId(array('min' => 12)); // WHERE road_id > 12
     * </code>
     *
     * @see       filterByRoads()
     *
     * @param     mixed $roadId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCityRoadsQuery The current query, for fluid interface
     */
    public function filterByRoadId($roadId = null, $comparison = null)
    {
        if (is_array($roadId)) {
            $useMinMax = false;
            if (isset($roadId['min'])) {
                $this->addUsingAlias(CityRoadsTableMap::COL_ROAD_ID, $roadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roadId['max'])) {
                $this->addUsingAlias(CityRoadsTableMap::COL_ROAD_ID, $roadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CityRoadsTableMap::COL_ROAD_ID, $roadId, $comparison);
    }

    /**
     * Filter the query on the city_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCityId(1234); // WHERE city_id = 1234
     * $query->filterByCityId(array(12, 34)); // WHERE city_id IN (12, 34)
     * $query->filterByCityId(array('min' => 12)); // WHERE city_id > 12
     * </code>
     *
     * @see       filterByCities()
     *
     * @param     mixed $cityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCityRoadsQuery The current query, for fluid interface
     */
    public function filterByCityId($cityId = null, $comparison = null)
    {
        if (is_array($cityId)) {
            $useMinMax = false;
            if (isset($cityId['min'])) {
                $this->addUsingAlias(CityRoadsTableMap::COL_CITY_ID, $cityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cityId['max'])) {
                $this->addUsingAlias(CityRoadsTableMap::COL_CITY_ID, $cityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CityRoadsTableMap::COL_CITY_ID, $cityId, $comparison);
    }

    /**
     * Filter the query by a related \Models\Models\Roads object
     *
     * @param \Models\Models\Roads|ObjectCollection $roads The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCityRoadsQuery The current query, for fluid interface
     */
    public function filterByRoads($roads, $comparison = null)
    {
        if ($roads instanceof \Models\Models\Roads) {
            return $this
                ->addUsingAlias(CityRoadsTableMap::COL_ROAD_ID, $roads->getId(), $comparison);
        } elseif ($roads instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CityRoadsTableMap::COL_ROAD_ID, $roads->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRoads() only accepts arguments of type \Models\Models\Roads or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Roads relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCityRoadsQuery The current query, for fluid interface
     */
    public function joinRoads($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Roads');

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
            $this->addJoinObject($join, 'Roads');
        }

        return $this;
    }

    /**
     * Use the Roads relation Roads object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Models\Models\RoadsQuery A secondary query class using the current class as primary query
     */
    public function useRoadsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRoads($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Roads', '\Models\Models\RoadsQuery');
    }

    /**
     * Filter the query by a related \Models\Models\Cities object
     *
     * @param \Models\Models\Cities|ObjectCollection $cities The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCityRoadsQuery The current query, for fluid interface
     */
    public function filterByCities($cities, $comparison = null)
    {
        if ($cities instanceof \Models\Models\Cities) {
            return $this
                ->addUsingAlias(CityRoadsTableMap::COL_CITY_ID, $cities->getId(), $comparison);
        } elseif ($cities instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CityRoadsTableMap::COL_CITY_ID, $cities->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCities() only accepts arguments of type \Models\Models\Cities or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Cities relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCityRoadsQuery The current query, for fluid interface
     */
    public function joinCities($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Cities');

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
            $this->addJoinObject($join, 'Cities');
        }

        return $this;
    }

    /**
     * Use the Cities relation Cities object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Models\Models\CitiesQuery A secondary query class using the current class as primary query
     */
    public function useCitiesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCities($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Cities', '\Models\Models\CitiesQuery');
    }

    /**
     * Filter the query by a related \Models\Models\CityRoadAliases object
     *
     * @param \Models\Models\CityRoadAliases|ObjectCollection $cityRoadAliases the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCityRoadsQuery The current query, for fluid interface
     */
    public function filterByCityRoadAliases($cityRoadAliases, $comparison = null)
    {
        if ($cityRoadAliases instanceof \Models\Models\CityRoadAliases) {
            return $this
                ->addUsingAlias(CityRoadsTableMap::COL_ID, $cityRoadAliases->getCityRoadId(), $comparison);
        } elseif ($cityRoadAliases instanceof ObjectCollection) {
            return $this
                ->useCityRoadAliasesQuery()
                ->filterByPrimaryKeys($cityRoadAliases->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCityRoadAliases() only accepts arguments of type \Models\Models\CityRoadAliases or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CityRoadAliases relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCityRoadsQuery The current query, for fluid interface
     */
    public function joinCityRoadAliases($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CityRoadAliases');

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
            $this->addJoinObject($join, 'CityRoadAliases');
        }

        return $this;
    }

    /**
     * Use the CityRoadAliases relation CityRoadAliases object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Models\Models\CityRoadAliasesQuery A secondary query class using the current class as primary query
     */
    public function useCityRoadAliasesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCityRoadAliases($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CityRoadAliases', '\Models\Models\CityRoadAliasesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCityRoads $cityRoads Object to remove from the list of results
     *
     * @return $this|ChildCityRoadsQuery The current query, for fluid interface
     */
    public function prune($cityRoads = null)
    {
        if ($cityRoads) {
            $this->addUsingAlias(CityRoadsTableMap::COL_ID, $cityRoads->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the city_roads table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CityRoadsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CityRoadsTableMap::clearInstancePool();
            CityRoadsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CityRoadsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CityRoadsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CityRoadsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CityRoadsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CityRoadsQuery

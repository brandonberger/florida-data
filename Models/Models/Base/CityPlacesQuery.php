<?php

namespace Models\Models\Base;

use \Exception;
use \PDO;
use Models\Models\CityPlaces as ChildCityPlaces;
use Models\Models\CityPlacesQuery as ChildCityPlacesQuery;
use Models\Models\Map\CityPlacesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'city_places' table.
 *
 *
 *
 * @method     ChildCityPlacesQuery orderByCityId($order = Criteria::ASC) Order by the city_id column
 * @method     ChildCityPlacesQuery orderByPlaceId($order = Criteria::ASC) Order by the place_id column
 *
 * @method     ChildCityPlacesQuery groupByCityId() Group by the city_id column
 * @method     ChildCityPlacesQuery groupByPlaceId() Group by the place_id column
 *
 * @method     ChildCityPlacesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCityPlacesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCityPlacesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCityPlacesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCityPlacesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCityPlacesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCityPlacesQuery leftJoinCities($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cities relation
 * @method     ChildCityPlacesQuery rightJoinCities($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cities relation
 * @method     ChildCityPlacesQuery innerJoinCities($relationAlias = null) Adds a INNER JOIN clause to the query using the Cities relation
 *
 * @method     ChildCityPlacesQuery joinWithCities($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Cities relation
 *
 * @method     ChildCityPlacesQuery leftJoinWithCities() Adds a LEFT JOIN clause and with to the query using the Cities relation
 * @method     ChildCityPlacesQuery rightJoinWithCities() Adds a RIGHT JOIN clause and with to the query using the Cities relation
 * @method     ChildCityPlacesQuery innerJoinWithCities() Adds a INNER JOIN clause and with to the query using the Cities relation
 *
 * @method     ChildCityPlacesQuery leftJoinPlaces($relationAlias = null) Adds a LEFT JOIN clause to the query using the Places relation
 * @method     ChildCityPlacesQuery rightJoinPlaces($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Places relation
 * @method     ChildCityPlacesQuery innerJoinPlaces($relationAlias = null) Adds a INNER JOIN clause to the query using the Places relation
 *
 * @method     ChildCityPlacesQuery joinWithPlaces($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Places relation
 *
 * @method     ChildCityPlacesQuery leftJoinWithPlaces() Adds a LEFT JOIN clause and with to the query using the Places relation
 * @method     ChildCityPlacesQuery rightJoinWithPlaces() Adds a RIGHT JOIN clause and with to the query using the Places relation
 * @method     ChildCityPlacesQuery innerJoinWithPlaces() Adds a INNER JOIN clause and with to the query using the Places relation
 *
 * @method     \Models\Models\CitiesQuery|\Models\Models\PlacesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCityPlaces findOne(ConnectionInterface $con = null) Return the first ChildCityPlaces matching the query
 * @method     ChildCityPlaces findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCityPlaces matching the query, or a new ChildCityPlaces object populated from the query conditions when no match is found
 *
 * @method     ChildCityPlaces findOneByCityId(int $city_id) Return the first ChildCityPlaces filtered by the city_id column
 * @method     ChildCityPlaces findOneByPlaceId(int $place_id) Return the first ChildCityPlaces filtered by the place_id column *

 * @method     ChildCityPlaces requirePk($key, ConnectionInterface $con = null) Return the ChildCityPlaces by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCityPlaces requireOne(ConnectionInterface $con = null) Return the first ChildCityPlaces matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCityPlaces requireOneByCityId(int $city_id) Return the first ChildCityPlaces filtered by the city_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCityPlaces requireOneByPlaceId(int $place_id) Return the first ChildCityPlaces filtered by the place_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCityPlaces[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCityPlaces objects based on current ModelCriteria
 * @method     ChildCityPlaces[]|ObjectCollection findByCityId(int $city_id) Return ChildCityPlaces objects filtered by the city_id column
 * @method     ChildCityPlaces[]|ObjectCollection findByPlaceId(int $place_id) Return ChildCityPlaces objects filtered by the place_id column
 * @method     ChildCityPlaces[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CityPlacesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Models\Models\Base\CityPlacesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Models\\Models\\CityPlaces', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCityPlacesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCityPlacesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCityPlacesQuery) {
            return $criteria;
        }
        $query = new ChildCityPlacesQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$city_id, $place_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCityPlaces|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CityPlacesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CityPlacesTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildCityPlaces A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT city_id, place_id FROM city_places WHERE city_id = :p0 AND place_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCityPlaces $obj */
            $obj = new ChildCityPlaces();
            $obj->hydrate($row);
            CityPlacesTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildCityPlaces|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildCityPlacesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(CityPlacesTableMap::COL_CITY_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(CityPlacesTableMap::COL_PLACE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCityPlacesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(CityPlacesTableMap::COL_CITY_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(CityPlacesTableMap::COL_PLACE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildCityPlacesQuery The current query, for fluid interface
     */
    public function filterByCityId($cityId = null, $comparison = null)
    {
        if (is_array($cityId)) {
            $useMinMax = false;
            if (isset($cityId['min'])) {
                $this->addUsingAlias(CityPlacesTableMap::COL_CITY_ID, $cityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cityId['max'])) {
                $this->addUsingAlias(CityPlacesTableMap::COL_CITY_ID, $cityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CityPlacesTableMap::COL_CITY_ID, $cityId, $comparison);
    }

    /**
     * Filter the query on the place_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaceId(1234); // WHERE place_id = 1234
     * $query->filterByPlaceId(array(12, 34)); // WHERE place_id IN (12, 34)
     * $query->filterByPlaceId(array('min' => 12)); // WHERE place_id > 12
     * </code>
     *
     * @see       filterByPlaces()
     *
     * @param     mixed $placeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCityPlacesQuery The current query, for fluid interface
     */
    public function filterByPlaceId($placeId = null, $comparison = null)
    {
        if (is_array($placeId)) {
            $useMinMax = false;
            if (isset($placeId['min'])) {
                $this->addUsingAlias(CityPlacesTableMap::COL_PLACE_ID, $placeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($placeId['max'])) {
                $this->addUsingAlias(CityPlacesTableMap::COL_PLACE_ID, $placeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CityPlacesTableMap::COL_PLACE_ID, $placeId, $comparison);
    }

    /**
     * Filter the query by a related \Models\Models\Cities object
     *
     * @param \Models\Models\Cities|ObjectCollection $cities The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCityPlacesQuery The current query, for fluid interface
     */
    public function filterByCities($cities, $comparison = null)
    {
        if ($cities instanceof \Models\Models\Cities) {
            return $this
                ->addUsingAlias(CityPlacesTableMap::COL_CITY_ID, $cities->getId(), $comparison);
        } elseif ($cities instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CityPlacesTableMap::COL_CITY_ID, $cities->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildCityPlacesQuery The current query, for fluid interface
     */
    public function joinCities($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useCitiesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCities($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Cities', '\Models\Models\CitiesQuery');
    }

    /**
     * Filter the query by a related \Models\Models\Places object
     *
     * @param \Models\Models\Places|ObjectCollection $places The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCityPlacesQuery The current query, for fluid interface
     */
    public function filterByPlaces($places, $comparison = null)
    {
        if ($places instanceof \Models\Models\Places) {
            return $this
                ->addUsingAlias(CityPlacesTableMap::COL_PLACE_ID, $places->getId(), $comparison);
        } elseif ($places instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CityPlacesTableMap::COL_PLACE_ID, $places->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPlaces() only accepts arguments of type \Models\Models\Places or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Places relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCityPlacesQuery The current query, for fluid interface
     */
    public function joinPlaces($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Places');

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
            $this->addJoinObject($join, 'Places');
        }

        return $this;
    }

    /**
     * Use the Places relation Places object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Models\Models\PlacesQuery A secondary query class using the current class as primary query
     */
    public function usePlacesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPlaces($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Places', '\Models\Models\PlacesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCityPlaces $cityPlaces Object to remove from the list of results
     *
     * @return $this|ChildCityPlacesQuery The current query, for fluid interface
     */
    public function prune($cityPlaces = null)
    {
        if ($cityPlaces) {
            $this->addCond('pruneCond0', $this->getAliasedColName(CityPlacesTableMap::COL_CITY_ID), $cityPlaces->getCityId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(CityPlacesTableMap::COL_PLACE_ID), $cityPlaces->getPlaceId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the city_places table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CityPlacesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CityPlacesTableMap::clearInstancePool();
            CityPlacesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CityPlacesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CityPlacesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CityPlacesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CityPlacesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CityPlacesQuery

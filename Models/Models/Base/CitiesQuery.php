<?php

namespace Models\Models\Base;

use \Exception;
use \PDO;
use Models\Models\Cities as ChildCities;
use Models\Models\CitiesQuery as ChildCitiesQuery;
use Models\Models\Map\CitiesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'cities' table.
 *
 *
 *
 * @method     ChildCitiesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCitiesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCitiesQuery orderByCountyId($order = Criteria::ASC) Order by the county_id column
 *
 * @method     ChildCitiesQuery groupById() Group by the id column
 * @method     ChildCitiesQuery groupByName() Group by the name column
 * @method     ChildCitiesQuery groupByCountyId() Group by the county_id column
 *
 * @method     ChildCitiesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCitiesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCitiesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCitiesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCitiesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCitiesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCitiesQuery leftJoinCounties($relationAlias = null) Adds a LEFT JOIN clause to the query using the Counties relation
 * @method     ChildCitiesQuery rightJoinCounties($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Counties relation
 * @method     ChildCitiesQuery innerJoinCounties($relationAlias = null) Adds a INNER JOIN clause to the query using the Counties relation
 *
 * @method     ChildCitiesQuery joinWithCounties($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Counties relation
 *
 * @method     ChildCitiesQuery leftJoinWithCounties() Adds a LEFT JOIN clause and with to the query using the Counties relation
 * @method     ChildCitiesQuery rightJoinWithCounties() Adds a RIGHT JOIN clause and with to the query using the Counties relation
 * @method     ChildCitiesQuery innerJoinWithCounties() Adds a INNER JOIN clause and with to the query using the Counties relation
 *
 * @method     ChildCitiesQuery leftJoinCityPlaces($relationAlias = null) Adds a LEFT JOIN clause to the query using the CityPlaces relation
 * @method     ChildCitiesQuery rightJoinCityPlaces($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CityPlaces relation
 * @method     ChildCitiesQuery innerJoinCityPlaces($relationAlias = null) Adds a INNER JOIN clause to the query using the CityPlaces relation
 *
 * @method     ChildCitiesQuery joinWithCityPlaces($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CityPlaces relation
 *
 * @method     ChildCitiesQuery leftJoinWithCityPlaces() Adds a LEFT JOIN clause and with to the query using the CityPlaces relation
 * @method     ChildCitiesQuery rightJoinWithCityPlaces() Adds a RIGHT JOIN clause and with to the query using the CityPlaces relation
 * @method     ChildCitiesQuery innerJoinWithCityPlaces() Adds a INNER JOIN clause and with to the query using the CityPlaces relation
 *
 * @method     ChildCitiesQuery leftJoinCityRailroads($relationAlias = null) Adds a LEFT JOIN clause to the query using the CityRailroads relation
 * @method     ChildCitiesQuery rightJoinCityRailroads($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CityRailroads relation
 * @method     ChildCitiesQuery innerJoinCityRailroads($relationAlias = null) Adds a INNER JOIN clause to the query using the CityRailroads relation
 *
 * @method     ChildCitiesQuery joinWithCityRailroads($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CityRailroads relation
 *
 * @method     ChildCitiesQuery leftJoinWithCityRailroads() Adds a LEFT JOIN clause and with to the query using the CityRailroads relation
 * @method     ChildCitiesQuery rightJoinWithCityRailroads() Adds a RIGHT JOIN clause and with to the query using the CityRailroads relation
 * @method     ChildCitiesQuery innerJoinWithCityRailroads() Adds a INNER JOIN clause and with to the query using the CityRailroads relation
 *
 * @method     ChildCitiesQuery leftJoinCityRoads($relationAlias = null) Adds a LEFT JOIN clause to the query using the CityRoads relation
 * @method     ChildCitiesQuery rightJoinCityRoads($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CityRoads relation
 * @method     ChildCitiesQuery innerJoinCityRoads($relationAlias = null) Adds a INNER JOIN clause to the query using the CityRoads relation
 *
 * @method     ChildCitiesQuery joinWithCityRoads($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CityRoads relation
 *
 * @method     ChildCitiesQuery leftJoinWithCityRoads() Adds a LEFT JOIN clause and with to the query using the CityRoads relation
 * @method     ChildCitiesQuery rightJoinWithCityRoads() Adds a RIGHT JOIN clause and with to the query using the CityRoads relation
 * @method     ChildCitiesQuery innerJoinWithCityRoads() Adds a INNER JOIN clause and with to the query using the CityRoads relation
 *
 * @method     \Models\Models\CountiesQuery|\Models\Models\CityPlacesQuery|\Models\Models\CityRailroadsQuery|\Models\Models\CityRoadsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCities findOne(ConnectionInterface $con = null) Return the first ChildCities matching the query
 * @method     ChildCities findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCities matching the query, or a new ChildCities object populated from the query conditions when no match is found
 *
 * @method     ChildCities findOneById(int $id) Return the first ChildCities filtered by the id column
 * @method     ChildCities findOneByName(string $name) Return the first ChildCities filtered by the name column
 * @method     ChildCities findOneByCountyId(int $county_id) Return the first ChildCities filtered by the county_id column *

 * @method     ChildCities requirePk($key, ConnectionInterface $con = null) Return the ChildCities by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCities requireOne(ConnectionInterface $con = null) Return the first ChildCities matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCities requireOneById(int $id) Return the first ChildCities filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCities requireOneByName(string $name) Return the first ChildCities filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCities requireOneByCountyId(int $county_id) Return the first ChildCities filtered by the county_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCities[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCities objects based on current ModelCriteria
 * @method     ChildCities[]|ObjectCollection findById(int $id) Return ChildCities objects filtered by the id column
 * @method     ChildCities[]|ObjectCollection findByName(string $name) Return ChildCities objects filtered by the name column
 * @method     ChildCities[]|ObjectCollection findByCountyId(int $county_id) Return ChildCities objects filtered by the county_id column
 * @method     ChildCities[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CitiesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Models\Models\Base\CitiesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Models\\Models\\Cities', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCitiesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCitiesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCitiesQuery) {
            return $criteria;
        }
        $query = new ChildCitiesQuery();
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
     * @return ChildCities|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CitiesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CitiesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCities A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, county_id FROM cities WHERE id = :p0';
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
            /** @var ChildCities $obj */
            $obj = new ChildCities();
            $obj->hydrate($row);
            CitiesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCities|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCitiesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CitiesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCitiesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CitiesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCitiesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CitiesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CitiesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CitiesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCitiesQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CitiesTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the county_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCountyId(1234); // WHERE county_id = 1234
     * $query->filterByCountyId(array(12, 34)); // WHERE county_id IN (12, 34)
     * $query->filterByCountyId(array('min' => 12)); // WHERE county_id > 12
     * </code>
     *
     * @see       filterByCounties()
     *
     * @param     mixed $countyId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCitiesQuery The current query, for fluid interface
     */
    public function filterByCountyId($countyId = null, $comparison = null)
    {
        if (is_array($countyId)) {
            $useMinMax = false;
            if (isset($countyId['min'])) {
                $this->addUsingAlias(CitiesTableMap::COL_COUNTY_ID, $countyId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($countyId['max'])) {
                $this->addUsingAlias(CitiesTableMap::COL_COUNTY_ID, $countyId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CitiesTableMap::COL_COUNTY_ID, $countyId, $comparison);
    }

    /**
     * Filter the query by a related \Models\Models\Counties object
     *
     * @param \Models\Models\Counties|ObjectCollection $counties The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCitiesQuery The current query, for fluid interface
     */
    public function filterByCounties($counties, $comparison = null)
    {
        if ($counties instanceof \Models\Models\Counties) {
            return $this
                ->addUsingAlias(CitiesTableMap::COL_COUNTY_ID, $counties->getId(), $comparison);
        } elseif ($counties instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CitiesTableMap::COL_COUNTY_ID, $counties->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildCitiesQuery The current query, for fluid interface
     */
    public function joinCounties($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useCountiesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCounties($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Counties', '\Models\Models\CountiesQuery');
    }

    /**
     * Filter the query by a related \Models\Models\CityPlaces object
     *
     * @param \Models\Models\CityPlaces|ObjectCollection $cityPlaces the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCitiesQuery The current query, for fluid interface
     */
    public function filterByCityPlaces($cityPlaces, $comparison = null)
    {
        if ($cityPlaces instanceof \Models\Models\CityPlaces) {
            return $this
                ->addUsingAlias(CitiesTableMap::COL_ID, $cityPlaces->getCityId(), $comparison);
        } elseif ($cityPlaces instanceof ObjectCollection) {
            return $this
                ->useCityPlacesQuery()
                ->filterByPrimaryKeys($cityPlaces->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCityPlaces() only accepts arguments of type \Models\Models\CityPlaces or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CityPlaces relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCitiesQuery The current query, for fluid interface
     */
    public function joinCityPlaces($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CityPlaces');

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
            $this->addJoinObject($join, 'CityPlaces');
        }

        return $this;
    }

    /**
     * Use the CityPlaces relation CityPlaces object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Models\Models\CityPlacesQuery A secondary query class using the current class as primary query
     */
    public function useCityPlacesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCityPlaces($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CityPlaces', '\Models\Models\CityPlacesQuery');
    }

    /**
     * Filter the query by a related \Models\Models\CityRailroads object
     *
     * @param \Models\Models\CityRailroads|ObjectCollection $cityRailroads the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCitiesQuery The current query, for fluid interface
     */
    public function filterByCityRailroads($cityRailroads, $comparison = null)
    {
        if ($cityRailroads instanceof \Models\Models\CityRailroads) {
            return $this
                ->addUsingAlias(CitiesTableMap::COL_ID, $cityRailroads->getCityId(), $comparison);
        } elseif ($cityRailroads instanceof ObjectCollection) {
            return $this
                ->useCityRailroadsQuery()
                ->filterByPrimaryKeys($cityRailroads->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCityRailroads() only accepts arguments of type \Models\Models\CityRailroads or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CityRailroads relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCitiesQuery The current query, for fluid interface
     */
    public function joinCityRailroads($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CityRailroads');

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
            $this->addJoinObject($join, 'CityRailroads');
        }

        return $this;
    }

    /**
     * Use the CityRailroads relation CityRailroads object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Models\Models\CityRailroadsQuery A secondary query class using the current class as primary query
     */
    public function useCityRailroadsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCityRailroads($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CityRailroads', '\Models\Models\CityRailroadsQuery');
    }

    /**
     * Filter the query by a related \Models\Models\CityRoads object
     *
     * @param \Models\Models\CityRoads|ObjectCollection $cityRoads the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCitiesQuery The current query, for fluid interface
     */
    public function filterByCityRoads($cityRoads, $comparison = null)
    {
        if ($cityRoads instanceof \Models\Models\CityRoads) {
            return $this
                ->addUsingAlias(CitiesTableMap::COL_ID, $cityRoads->getCityId(), $comparison);
        } elseif ($cityRoads instanceof ObjectCollection) {
            return $this
                ->useCityRoadsQuery()
                ->filterByPrimaryKeys($cityRoads->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildCitiesQuery The current query, for fluid interface
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
     * Filter the query by a related Places object
     * using the city_places table as cross reference
     *
     * @param Places $places the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCitiesQuery The current query, for fluid interface
     */
    public function filterByPlaces($places, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useCityPlacesQuery()
            ->filterByPlaces($places, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCities $cities Object to remove from the list of results
     *
     * @return $this|ChildCitiesQuery The current query, for fluid interface
     */
    public function prune($cities = null)
    {
        if ($cities) {
            $this->addUsingAlias(CitiesTableMap::COL_ID, $cities->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the cities table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CitiesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CitiesTableMap::clearInstancePool();
            CitiesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CitiesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CitiesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CitiesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CitiesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CitiesQuery

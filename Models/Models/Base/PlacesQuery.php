<?php

namespace Models\Models\Base;

use \Exception;
use \PDO;
use Models\Models\Places as ChildPlaces;
use Models\Models\PlacesQuery as ChildPlacesQuery;
use Models\Models\Map\PlacesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'places' table.
 *
 *
 *
 * @method     ChildPlacesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPlacesQuery orderByPlace($order = Criteria::ASC) Order by the place column
 * @method     ChildPlacesQuery orderByPlaceType($order = Criteria::ASC) Order by the place_type column
 * @method     ChildPlacesQuery orderByPlaceSubType($order = Criteria::ASC) Order by the place_sub_type column
 *
 * @method     ChildPlacesQuery groupById() Group by the id column
 * @method     ChildPlacesQuery groupByPlace() Group by the place column
 * @method     ChildPlacesQuery groupByPlaceType() Group by the place_type column
 * @method     ChildPlacesQuery groupByPlaceSubType() Group by the place_sub_type column
 *
 * @method     ChildPlacesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPlacesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPlacesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPlacesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPlacesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPlacesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPlacesQuery leftJoinPlaceTypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the PlaceTypes relation
 * @method     ChildPlacesQuery rightJoinPlaceTypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PlaceTypes relation
 * @method     ChildPlacesQuery innerJoinPlaceTypes($relationAlias = null) Adds a INNER JOIN clause to the query using the PlaceTypes relation
 *
 * @method     ChildPlacesQuery joinWithPlaceTypes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PlaceTypes relation
 *
 * @method     ChildPlacesQuery leftJoinWithPlaceTypes() Adds a LEFT JOIN clause and with to the query using the PlaceTypes relation
 * @method     ChildPlacesQuery rightJoinWithPlaceTypes() Adds a RIGHT JOIN clause and with to the query using the PlaceTypes relation
 * @method     ChildPlacesQuery innerJoinWithPlaceTypes() Adds a INNER JOIN clause and with to the query using the PlaceTypes relation
 *
 * @method     ChildPlacesQuery leftJoinPlaceSubTypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the PlaceSubTypes relation
 * @method     ChildPlacesQuery rightJoinPlaceSubTypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PlaceSubTypes relation
 * @method     ChildPlacesQuery innerJoinPlaceSubTypes($relationAlias = null) Adds a INNER JOIN clause to the query using the PlaceSubTypes relation
 *
 * @method     ChildPlacesQuery joinWithPlaceSubTypes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PlaceSubTypes relation
 *
 * @method     ChildPlacesQuery leftJoinWithPlaceSubTypes() Adds a LEFT JOIN clause and with to the query using the PlaceSubTypes relation
 * @method     ChildPlacesQuery rightJoinWithPlaceSubTypes() Adds a RIGHT JOIN clause and with to the query using the PlaceSubTypes relation
 * @method     ChildPlacesQuery innerJoinWithPlaceSubTypes() Adds a INNER JOIN clause and with to the query using the PlaceSubTypes relation
 *
 * @method     ChildPlacesQuery leftJoinCityPlaces($relationAlias = null) Adds a LEFT JOIN clause to the query using the CityPlaces relation
 * @method     ChildPlacesQuery rightJoinCityPlaces($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CityPlaces relation
 * @method     ChildPlacesQuery innerJoinCityPlaces($relationAlias = null) Adds a INNER JOIN clause to the query using the CityPlaces relation
 *
 * @method     ChildPlacesQuery joinWithCityPlaces($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CityPlaces relation
 *
 * @method     ChildPlacesQuery leftJoinWithCityPlaces() Adds a LEFT JOIN clause and with to the query using the CityPlaces relation
 * @method     ChildPlacesQuery rightJoinWithCityPlaces() Adds a RIGHT JOIN clause and with to the query using the CityPlaces relation
 * @method     ChildPlacesQuery innerJoinWithCityPlaces() Adds a INNER JOIN clause and with to the query using the CityPlaces relation
 *
 * @method     \Models\Models\PlaceTypesQuery|\Models\Models\PlaceSubTypesQuery|\Models\Models\CityPlacesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPlaces findOne(ConnectionInterface $con = null) Return the first ChildPlaces matching the query
 * @method     ChildPlaces findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPlaces matching the query, or a new ChildPlaces object populated from the query conditions when no match is found
 *
 * @method     ChildPlaces findOneById(int $id) Return the first ChildPlaces filtered by the id column
 * @method     ChildPlaces findOneByPlace(string $place) Return the first ChildPlaces filtered by the place column
 * @method     ChildPlaces findOneByPlaceType(int $place_type) Return the first ChildPlaces filtered by the place_type column
 * @method     ChildPlaces findOneByPlaceSubType(int $place_sub_type) Return the first ChildPlaces filtered by the place_sub_type column *

 * @method     ChildPlaces requirePk($key, ConnectionInterface $con = null) Return the ChildPlaces by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlaces requireOne(ConnectionInterface $con = null) Return the first ChildPlaces matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPlaces requireOneById(int $id) Return the first ChildPlaces filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlaces requireOneByPlace(string $place) Return the first ChildPlaces filtered by the place column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlaces requireOneByPlaceType(int $place_type) Return the first ChildPlaces filtered by the place_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlaces requireOneByPlaceSubType(int $place_sub_type) Return the first ChildPlaces filtered by the place_sub_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPlaces[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPlaces objects based on current ModelCriteria
 * @method     ChildPlaces[]|ObjectCollection findById(int $id) Return ChildPlaces objects filtered by the id column
 * @method     ChildPlaces[]|ObjectCollection findByPlace(string $place) Return ChildPlaces objects filtered by the place column
 * @method     ChildPlaces[]|ObjectCollection findByPlaceType(int $place_type) Return ChildPlaces objects filtered by the place_type column
 * @method     ChildPlaces[]|ObjectCollection findByPlaceSubType(int $place_sub_type) Return ChildPlaces objects filtered by the place_sub_type column
 * @method     ChildPlaces[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PlacesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Models\Models\Base\PlacesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Models\\Models\\Places', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPlacesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPlacesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPlacesQuery) {
            return $criteria;
        }
        $query = new ChildPlacesQuery();
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
     * @return ChildPlaces|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PlacesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PlacesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPlaces A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, place, place_type, place_sub_type FROM places WHERE id = :p0';
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
            /** @var ChildPlaces $obj */
            $obj = new ChildPlaces();
            $obj->hydrate($row);
            PlacesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPlaces|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPlacesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PlacesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPlacesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PlacesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPlacesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PlacesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PlacesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlacesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the place column
     *
     * Example usage:
     * <code>
     * $query->filterByPlace('fooValue');   // WHERE place = 'fooValue'
     * $query->filterByPlace('%fooValue%', Criteria::LIKE); // WHERE place LIKE '%fooValue%'
     * </code>
     *
     * @param     string $place The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlacesQuery The current query, for fluid interface
     */
    public function filterByPlace($place = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($place)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlacesTableMap::COL_PLACE, $place, $comparison);
    }

    /**
     * Filter the query on the place_type column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaceType(1234); // WHERE place_type = 1234
     * $query->filterByPlaceType(array(12, 34)); // WHERE place_type IN (12, 34)
     * $query->filterByPlaceType(array('min' => 12)); // WHERE place_type > 12
     * </code>
     *
     * @see       filterByPlaceTypes()
     *
     * @param     mixed $placeType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlacesQuery The current query, for fluid interface
     */
    public function filterByPlaceType($placeType = null, $comparison = null)
    {
        if (is_array($placeType)) {
            $useMinMax = false;
            if (isset($placeType['min'])) {
                $this->addUsingAlias(PlacesTableMap::COL_PLACE_TYPE, $placeType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($placeType['max'])) {
                $this->addUsingAlias(PlacesTableMap::COL_PLACE_TYPE, $placeType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlacesTableMap::COL_PLACE_TYPE, $placeType, $comparison);
    }

    /**
     * Filter the query on the place_sub_type column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaceSubType(1234); // WHERE place_sub_type = 1234
     * $query->filterByPlaceSubType(array(12, 34)); // WHERE place_sub_type IN (12, 34)
     * $query->filterByPlaceSubType(array('min' => 12)); // WHERE place_sub_type > 12
     * </code>
     *
     * @see       filterByPlaceSubTypes()
     *
     * @param     mixed $placeSubType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlacesQuery The current query, for fluid interface
     */
    public function filterByPlaceSubType($placeSubType = null, $comparison = null)
    {
        if (is_array($placeSubType)) {
            $useMinMax = false;
            if (isset($placeSubType['min'])) {
                $this->addUsingAlias(PlacesTableMap::COL_PLACE_SUB_TYPE, $placeSubType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($placeSubType['max'])) {
                $this->addUsingAlias(PlacesTableMap::COL_PLACE_SUB_TYPE, $placeSubType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlacesTableMap::COL_PLACE_SUB_TYPE, $placeSubType, $comparison);
    }

    /**
     * Filter the query by a related \Models\Models\PlaceTypes object
     *
     * @param \Models\Models\PlaceTypes|ObjectCollection $placeTypes The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPlacesQuery The current query, for fluid interface
     */
    public function filterByPlaceTypes($placeTypes, $comparison = null)
    {
        if ($placeTypes instanceof \Models\Models\PlaceTypes) {
            return $this
                ->addUsingAlias(PlacesTableMap::COL_PLACE_TYPE, $placeTypes->getId(), $comparison);
        } elseif ($placeTypes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlacesTableMap::COL_PLACE_TYPE, $placeTypes->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPlaceTypes() only accepts arguments of type \Models\Models\PlaceTypes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PlaceTypes relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlacesQuery The current query, for fluid interface
     */
    public function joinPlaceTypes($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PlaceTypes');

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
            $this->addJoinObject($join, 'PlaceTypes');
        }

        return $this;
    }

    /**
     * Use the PlaceTypes relation PlaceTypes object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Models\Models\PlaceTypesQuery A secondary query class using the current class as primary query
     */
    public function usePlaceTypesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPlaceTypes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PlaceTypes', '\Models\Models\PlaceTypesQuery');
    }

    /**
     * Filter the query by a related \Models\Models\PlaceSubTypes object
     *
     * @param \Models\Models\PlaceSubTypes|ObjectCollection $placeSubTypes The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPlacesQuery The current query, for fluid interface
     */
    public function filterByPlaceSubTypes($placeSubTypes, $comparison = null)
    {
        if ($placeSubTypes instanceof \Models\Models\PlaceSubTypes) {
            return $this
                ->addUsingAlias(PlacesTableMap::COL_PLACE_SUB_TYPE, $placeSubTypes->getId(), $comparison);
        } elseif ($placeSubTypes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlacesTableMap::COL_PLACE_SUB_TYPE, $placeSubTypes->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPlaceSubTypes() only accepts arguments of type \Models\Models\PlaceSubTypes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PlaceSubTypes relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPlacesQuery The current query, for fluid interface
     */
    public function joinPlaceSubTypes($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PlaceSubTypes');

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
            $this->addJoinObject($join, 'PlaceSubTypes');
        }

        return $this;
    }

    /**
     * Use the PlaceSubTypes relation PlaceSubTypes object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Models\Models\PlaceSubTypesQuery A secondary query class using the current class as primary query
     */
    public function usePlaceSubTypesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPlaceSubTypes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PlaceSubTypes', '\Models\Models\PlaceSubTypesQuery');
    }

    /**
     * Filter the query by a related \Models\Models\CityPlaces object
     *
     * @param \Models\Models\CityPlaces|ObjectCollection $cityPlaces the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlacesQuery The current query, for fluid interface
     */
    public function filterByCityPlaces($cityPlaces, $comparison = null)
    {
        if ($cityPlaces instanceof \Models\Models\CityPlaces) {
            return $this
                ->addUsingAlias(PlacesTableMap::COL_ID, $cityPlaces->getPlaceId(), $comparison);
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
     * @return $this|ChildPlacesQuery The current query, for fluid interface
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
     * Filter the query by a related Cities object
     * using the city_places table as cross reference
     *
     * @param Cities $cities the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPlacesQuery The current query, for fluid interface
     */
    public function filterByCities($cities, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useCityPlacesQuery()
            ->filterByCities($cities, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPlaces $places Object to remove from the list of results
     *
     * @return $this|ChildPlacesQuery The current query, for fluid interface
     */
    public function prune($places = null)
    {
        if ($places) {
            $this->addUsingAlias(PlacesTableMap::COL_ID, $places->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the places table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PlacesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PlacesTableMap::clearInstancePool();
            PlacesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PlacesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PlacesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PlacesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PlacesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PlacesQuery

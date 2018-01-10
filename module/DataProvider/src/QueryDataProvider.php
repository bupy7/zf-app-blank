<?php

namespace DataProvider;

use Doctrine\ORM\QueryBuilder;
use Zend\Paginator\Paginator;
use ExPaginator\Adapter\DoctrineAdapter;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Common\Collections\Collection;

class QueryDataProvider implements DataProviderInterface
{
    public const MAIN_ENTITY_ALIAS = 't';

    private const FIRST_RESULT_DEFAULT = 0;
    private const LIMIT_DEFAULT = 40;
    private const PAGE_DEFAULT = 1;
    private const PAGE_RANGE_DEFAULT = 10;

    /**
     * @var EntityManager
     */
    protected $entityManager;
    /**
     * @var QueryBuilder
     */
    protected $queryBuilder;
    /**
     * @var QueryBuilder
     */
    protected $countBuilder;
    /**
     * @var int
     */
    protected $page = self::PAGE_DEFAULT;
    /**
     * @var array|Collection
     */
    protected $collection;
    /**
     * @var int
     */
    protected $count;
    /**
     * @var int
     */
    protected $limit = self::LIMIT_DEFAULT;
    /**
     * @var Paginator
     */
    protected $paginator;
    /**
     * @var int
     */
    protected $hydrationMode = AbstractQuery::HYDRATE_OBJECT;
    /**
     * @var array
     */
    protected $queryParams = [];
    /**
     * @var int
     */
    protected $pageRange = self::PAGE_RANGE_DEFAULT;

    public function setPageRange(int $pageRange): DataProviderInterface
    {
        if ($pageRange <= 0) {
            $pageRange = self::PAGE_RANGE_DEFAULT;
        }
        $this->pageRange = $pageRange;
        return $this;
    }

    public function setPage(int $page): DataProviderInterface
    {
        if ($page <= 0) {
            $page = self::PAGE_DEFAULT;
        }
        $this->page = $page;
        return $this;
    }

    public function setLimit(int $limit): DataProviderInterface
    {
        $this->limit = $limit;
        return $this;
    }

    public function getPaginator(): Paginator
    {
        if ($this->paginator === null) {
            $this->paginator = new Paginator(new DoctrineAdapter($this->getCollection(), $this->getCount()));
            $this->paginator->setItemCountPerPage($this->limit)
                ->setCurrentPageNumber($this->getValidPage())
                ->setPageRange($this->pageRange);
        }
        return $this->paginator;
    }

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getQueryBuilder(): QueryBuilder
    {
        if ($this->queryBuilder === null) {
            $this->queryBuilder = $this->entityManager->createQueryBuilder();
        }
        return $this->queryBuilder;
    }

    public function getCountBuilder(): QueryBuilder
    {
        if ($this->countBuilder === null) {
            $this->countBuilder = clone $this->getQueryBuilder();
            $this->countBuilder->select(sprintf('COUNT(%s)', self::MAIN_ENTITY_ALIAS));
        }
        return $this->countBuilder;
    }

    public function asObject(): QueryDataProvider
    {
        $this->hydrationMode = AbstractQuery::HYDRATE_OBJECT;
        return $this;
    }

    public function asArray(): QueryDataProvider
    {
        $this->hydrationMode = AbstractQuery::HYDRATE_ARRAY;
        return $this;
    }

    public function setQueryParams(array $queryParams): QueryDataProvider
    {
        $this->queryParams = $queryParams;
        return $this;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    /**
     * @return array|Collection
     */
    protected function getCollection()
    {
        if ($this->collection === null) {
            $qb = clone $this->getQueryBuilder();
            $qb->setFirstResult($this->getFirstResult())
                ->setMaxResults($this->limit);
            $this->collection = $qb->getQuery()->getResult($this->hydrationMode);
        }
        return $this->collection;
    }

    protected function getCount(): int
    {
        if ($this->count === null) {
            $this->count = (int)$this->getCountBuilder()->getQuery()->getSingleScalarResult();
        }
        return $this->count;
    }

    protected function getFirstResult(): int
    {
        $result = ($this->page - 1) * $this->limit;
        if ($this->getCount() > $result) {
            return $result;
        }
        return self::FIRST_RESULT_DEFAULT * $this->limit;
    }

    protected function getValidPage(): int
    {
        return $this->page > ceil($this->getCount() / $this->limit) ? self::PAGE_DEFAULT : $this->page;
    }
}

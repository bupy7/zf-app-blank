<?php

namespace DataProvider;

use Zend\Paginator\Paginator;

interface DataProviderInterface
{
    public function setPage(int $page): DataProviderInterface;
    public function setLimit(int $limit): DataProviderInterface;
    public function getPaginator(): Paginator;
    public function setPageRange(int $pageRange): DataProviderInterface;
}

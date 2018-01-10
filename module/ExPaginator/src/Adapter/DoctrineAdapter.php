<?php

namespace ExPaginator\Adapter;

use Zend\Paginator\Adapter\AdapterInterface;
use Doctrine\Common\Collections\Collection;
use Zend\Paginator\Adapter\Exception\InvalidArgumentException;

class DoctrineAdapter implements AdapterInterface
{
    /**
     * @var Collection|array
     */
    protected $collection;
    /**
     * @var int
     */
    protected $count;

    /**
     * @param Collection|array $collection
     * @param int $count
     */
    public function __construct($collection, int $count = 0)
    {
        if ($collection instanceof Collection) {
            $this->count = $collection->count();
        } elseif (is_array($collection)) {
            $this->count = $count;
        } else {
            throw new InvalidArgumentException('Iterator must implement ' . Collection::class . ' or array');
        }
        $this->collection = $collection;
    }

    /**
     * Returns an iterator of items for a page, or an empty array.
     * @param  int $offset Page offset
     * @param  int $itemCountPerPage Number of items per page
     * @return Collection|array
     */
    public function getItems($offset, $itemCountPerPage)
    {
        if ($this->count == 0) {
            return [];
        }
        return $this->collection;
    }

    /**
     * Returns the total number of rows in the collection.
     */
    public function count(): int
    {
        return $this->count;
    }
}

<?php

namespace ExDoctrine\Repository;

use Doctrine\Common\Persistence\ObjectRepository;

interface RepositoryInterface extends ObjectRepository
{
    /**
     * Tells the ObjectManager to make an instance managed and persistent.
     * The object will be entered into the database as a result of the flush operation.
     * NOTE: The persist operation always considers objects that are not yet known to
     * this ObjectManager as NEW. Do not pass detached objects to the persist operation.
     * @param object $object The instance to make managed and persistent.
     */
    public function persist($object);

    /**
     * Flushes all changes to objects that have been queued up to now to the database.
     * This effectively synchronizes the in-memory state of managed objects with the
     * database.
     */
    public function flush();
}

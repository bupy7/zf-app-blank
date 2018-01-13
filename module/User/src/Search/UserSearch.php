<?php

namespace User\Search;

use User\Form\UserSearchForm;
use DataProvider\QueryDataProvider;
use Doctrine\ORM\EntityManager;

class UserSearch
{
    private const RESULT_LIMIT_DEFAULT = 5;

    /**
     * @var QueryDataProvider
     */
    private $dataProvider;
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(QueryDataProvider $dataProvider, EntityManager $entityManager)
    {
        $this->dataProvider = $dataProvider;
        $this->entityManager = $entityManager;
    }

    public function search(array $data, UserSearchForm $form): QueryDataProvider
    {
        // query
        $this->dataProvider->getQueryBuilder()->select('t')
            ->from('User\Entity\User', QueryDataProvider::MAIN_ENTITY_ALIAS)
            ->orderBy('t.id', 'DESC');

        // limit
        $this->dataProvider->setLimit(self::RESULT_LIMIT_DEFAULT);

        // validation
        $form->setValues($data);
        if ($form->isValid()) {
            $this->dataProvider->setPage($form->_page);
            $this->dataProvider->setQueryParams($form->getValues());
        }

        // counter
        $this->dataProvider->getCountBuilder()->resetDQLPart('orderBy');

        return $this->dataProvider;
    }
}

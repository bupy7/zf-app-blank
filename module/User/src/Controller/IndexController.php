<?php

namespace User\Controller;

use Core\Controller\ActionControllerAbstract;
use User\Form\UserSearchForm;
use User\Search\UserSearch;
use Zend\View\Model\ViewModel;

class IndexController extends ActionControllerAbstract
{
    /**
     * @var UserSearch
     */
    private $userSearch;

    public function __construct(UserSearch $userSearch)
    {
        $this->userSearch = $userSearch;
    }

    public function indexAction(): ViewModel
    {
        $searchForm = new UserSearchForm();
        $dataProvider = $this->userSearch->search((array)$this->params()->fromQuery(), $searchForm);

        return $this->asView([
            'dataProvider' => $dataProvider,
        ]);
    }
}

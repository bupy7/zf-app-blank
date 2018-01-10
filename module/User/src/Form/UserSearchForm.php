<?php

namespace User\Form;

use Bupy7\Form\FormAbstract;

class UserSearchForm extends FormAbstract
{
    /**
     * @var int
     */
    public $_page = 1;

    protected function inputs(): array
    {
        return [
            [
                'name' => '_page',
                'allow_empty' => true,
                'validators' => [
                    [
                        'name' => 'Digits',
                    ],
                ],
            ],
        ];
    }
}

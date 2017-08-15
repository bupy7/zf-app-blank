<?php

namespace User\Form;

use Bupy7\Form\FormAbstract;

class RestorePassForm extends FormAbstract
{
    /**
     * @var string
     */
    public $password;

    protected function inputs(): array
    {
        return [
            [
                'name' => 'password',
                'required' => true,
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 4,
                        ],
                    ]
                ],
            ],
        ];
    }
}

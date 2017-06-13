<?php

namespace User\Form;

use Bupy7\Form\FormAbstract;

class AgainConfirmForm extends FormAbstract
{
    /**
     * @var string
     */
    public $email;

    protected function inputs(): array
    {
        return [
            [
                'name' => 'email',
                'required' => true,
                'validators' => [
                    [
                        'name' => 'EmailAddress',
                    ],
                ],
            ],
        ];
    }
}

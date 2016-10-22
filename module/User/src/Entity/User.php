<?php

namespace User\Entity;

use ZfcRbac\Identity\IdentityInterface;

class User implements UserInterface, IdentityInterface
{
    /**
     * @var integer
     */
    protected $id;
    /**
     * @var string
     */
    protected $person;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $password;
    /**
     * @var string
     */
    protected $role;

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * {@inheritDoc}
     */
    public function setPerson($person)
    {
        $this->person = $person;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * {@inheritDoc}
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        return [$this->getRole()];
    }
}

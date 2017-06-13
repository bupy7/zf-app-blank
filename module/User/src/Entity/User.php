<?php

namespace User\Entity;

use DateTime;
use ZfcRbac\Identity\IdentityInterface;

class User implements IdentityInterface
{
    const ROLE_GUEST = 'guest';
    const ROLE_REGISTERED = 'registered';
    
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
    protected $roleId;
    /**
     * @var boolean
     */
    protected $emailConfirm = false;
    /**
     * @var string
     */
    protected $confirmKey;
    /**
     * @var DateTime
     */
    protected $createdAt;
    /**
     * @var string|null
     */
    protected $restoreKey;
    /**
     * @var DateTime|null
     */
    protected $restoreKeyExpire;

    /**
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    public function getPerson(): string
    {
        return $this->person;
    }

    public function setPerson(string $person): User
    {
        $this->person = $person;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    public function setRoleId(string $role): User
    {
        $this->roleId = $role;
        return $this;
    }

    public function getRoles(): array
    {
        return [$this->getRoleId()];
    }

    public function getEmailConfirm(): bool
    {
        return $this->emailConfirm;
    }

    public function setEmailConfirm(bool $emailConfirm): User
    {
        $this->emailConfirm = $emailConfirm;
        return $this;
    }

    public function getConfirmKey(): string
    {
        return $this->confirmKey;
    }

    public function setConfirmKey(string $confirmKey): User
    {
        $this->confirmKey = $confirmKey;
        return $this;
    }

    public function setCreatedAt(DateTime $createdAt): User
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setRestoreKey(?string $restoreKey): User
    {
        $this->restoreKey = $restoreKey;
        return $this;
    }

    public function getRestoreKey(): ?string
    {
        return $this->restoreKey;
    }

    public function setRestoreKeyExpire(?DateTime $restoreKeyExpire): User
    {
        $this->restoreKeyExpire = $restoreKeyExpire;
        return $this;
    }

    public function getRestoreKeyExpire(): ?DateTime
    {
        return $this->restoreKeyExpire;
    }
}

<?php

namespace GimsSocial;

class User
{
    protected $name;
    protected $lastName;
    protected $username;
    protected $email;
    protected $birth;
    protected $password;
    protected $accountType;
    //protected $profileImage;
    //protected $timeline;
    //protected $avatar;

    public function __construct(string $name, string $lastName, string $username, string $email, string $birthdate, string $password, string $accountType)
    {
        $this->name = trim($name);
        $this->lastName = trim($lastName);
        $this->username = trim($username);
        $this->email = trim($email);
        $this->birth = $birthdate;
        $this->password = $this->encryptPassword(trim($password));
        $this->accountType = trim($accountType);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBirth(): string
    {
        return $this->birth;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAccountType(): string
    {
        return $this->accountType;
    }

    protected function encryptPassword($password): string
    {
        return md5($password);
    }
}

final class EnterpriseUser extends User
{
    protected $enterpriseName;

    public function __construct(string $name, string $lastName, string $username, string $email, string $birthdate, string $password, string $accountType, string $enterpriseName)
    {
        parent::__construct($name, $lastName, $username, $email, $birthdate, $password, $accountType);
        $this->enterpriseName = trim($enterpriseName);
    }

    public function getEnterpriseName(): string
    {
        return $this->enterpriseName;
    }
}

?>
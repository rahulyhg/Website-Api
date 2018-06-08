<?php

namespace GimsSocial;

interface LoginInterface
{
    public function __construct(User $user);
    public function executeLogin(): void;
    public function exitLogin(): void;
}

class Login implements LoginInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function executeLogin(): void
    {

    }
} 

?>
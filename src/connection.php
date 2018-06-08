<?php
use \GimsSocial\User as User;

interface ConnectionInterface
{
    public function connectDb(): void;
    public function disconnectDb(): void;
    public function searchUsername(string $username): bool;
    public function searchEmail(string $email): bool;
    public function registerUser(User $user);
    public function searchByName(string $user);
}

class Connection
{
    private $connection;
    private $servername;
    private $dbname;
    private $user;
    private $password;

    public function __construct()
    {
        $this->servername = 'localhost';
        $this->dbname = 'gims';
        $this->user = 'pedrobelotto';
        $this->password = 'edwald06';
    }

    public function __destruct(){}

    public function connectDb(): void
    {
        try
        {
            $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exc)
        {
            echo 'Connection Failed: '.$exc->getMessage();
        }
    }

    public function disconnectDb(): void
    {
        $this->connection = null;
    }

    public function searchUsername(string $username): bool
    {
        $queryUser = $this->connection->prepare('SELECT `username` FROM `gims_users` WHERE `username` = :user');
        $queryUser->bindParam(':user', $username, PDO::PARAM_STR);
        $queryUser->execute();
        if ($queryUser->rowCount() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function searchEmail(string $email): bool                                                            
    {
        $queryEmail = $this->connection->prepare('SELECT `email` FROM `gims_users` WHERE `email` = :email');
        $queryEmail->bindParam(':email', $email, PDO::PARAM_STR);
        $queryEmail->execute();
        if ($queryEmail->rowCount() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function registerUser(User $user): bool
    {
        $insert = $this->connection->prepare('INSERT INTO `gims_users` (`name`, `lastname`, `username`, `email`, `birthday`, `password`, `account_type`) VALUES (:name, :lastname, :username, :email, :birthday, :password, :account_type)');
        $insert->bindValue(':name', $user->getName(), PDO::PARAM_STR);
        $insert->bindValue(':lastname', $user->getLastName(), PDO::PARAM_STR);
        $insert->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $insert->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $insert->bindValue(':birthday', $user->getBirth(), PDO::PARAM_STR);
        $insert->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $insert->bindValue(':account_type', $user->getAccountType(), PDO::PARAM_STR);
        if ($insert->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>
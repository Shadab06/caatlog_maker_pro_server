<?php

error_reporting(E_ALL);
ini_set('display_error', 1);

class User
{

    //user fields

    public $id;
    public $name;
    public $email;
    public $phone;

    // db fields

    private $connection;
    private $table = 'users';

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function readAllUser()
    {
        $query = 'Select * from ' . $this->table;

        $users = $this->connection->prepare($query);

        $users->execute();

        return $users;
    }

    public function createUser($params)
    {
        $this->name = $params['name'];
        $this->email = $params['email'];
        $this->phone = $params['phone'];

        $query = 'INSERT INTO ' . $this->table . ' SET name=:name, email=:email, phone=:phone';

        $user = $this->connection->prepare($query);

        $user->bindValue('name', $this->name);
        $user->bindValue('email', $this->email);
        $user->bindValue('phone', $this->phone);

        if ($user->execute()) {
            $id = $this->connection->lastInsertId();
            return $id;
        }

        return 0;
    }
}

<?php

class dataBase
{

    // private $hostName = 'localhost';
    // private $userName = 'admin';
    // private $userPass = '2022@Ashar';
    // private $dbName = 'tworingz';
    // private $connection = null;

    
    private $hostName = 'localhost';
    private $userName = 'root';
    private $userPass = '';
    private $dbName = 'catlog_pro';
    private $connection = null;


    public function connect()
    {

        try {
            $this->connection = new PDO(
                'mysql:host=' . $this->hostName . ';dbname=' . $this->dbName,
                $this->userName,
                $this->userPass
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


        return $this->connection;
    }
}

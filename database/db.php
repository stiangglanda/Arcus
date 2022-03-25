<?php
class Database
{
    private $host = '127.0.0.1';
    private $dbname = "arcusdb";
    private $user = "root";
    private $pwd = "";
    public $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pwd);
        } catch (Exception $e) {
            echo $e;
        }
    }
}
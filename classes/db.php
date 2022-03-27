<?php
class Database
{
    public $db_host = '127.0.0.1';
    public $db_name = "arcusdb";
    public $db_user = "root";
    public $db_password = "";
    public $pdo;

    public function __construct()
    {
        try {
            $pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo = $pdo;
        } catch (Exception $e) {
            echo $e;
        }
    }
}

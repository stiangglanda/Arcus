<?php
class Database
{
    protected $db_host = '127.0.0.1';
    protected $db_name = "arcusdb";
    protected $db_user = "root";
    protected $db_password = "";

    // protected $db_host = "localhost";
    // protected $db_user = "id18558812_arcus";
    // protected $db_password = "vrbLW!V?o0-H/(Fk";
    // protected $db_database = "id18558812_arcusdb";

    public $pdo;

    public function __construct()
    {
        try {
            $pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo = $pdo;
        }
        catch (Exception $e) {
            echo $e;
        }
    }
}

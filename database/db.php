<?php
class Database
{
    private $db_host = '127.0.0.1';
    private $db_name = "arcusdb";
    private $db_user = "root";
    private $db_password = "";
    public $pdo;

    function __construct()
    {
        try {
            $pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo = $pdo;
        } catch (Exception $e) {
            echo $e;
        }
    }

    // public function nextId($table)
    // {
    //     $stmt1 = $this->pdo->prepare("SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = SCHEMA() AND table_name = ? AND ordinal_position = 1");
    //     $stmt1->execute([$table]);

    //     $tableId = $stmt1->fetch()["column_name"];

    //     $stmt2 = $this->pdo->prepare("SELECT MAX(?) AS 'latest' FROM user)");
    //     $stmt2->execute([$tableId]);

    //     return $stmt2->fetch()["latest"];
    // }
}

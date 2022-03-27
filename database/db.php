<?php
class Database
{
    protected $db_host = '127.0.0.1';
    protected $db_name = "arcusdb";
    protected $db_user = "root";
    protected $db_password = "";
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

    public static function nextId($table)
    {
        $db = new Database();
        $stmt = $db->pdo->prepare("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE lower(table_name) = lower(?) AND table_schema = DATABASE()");
        $stmt->execute([$table]);

        return $stmt->fetch()["AUTO_INCREMENT"];
    }
}

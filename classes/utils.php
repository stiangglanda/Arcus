<?php
require_once "db.php";
class Utils extends Database
{
    public static function nextId($table)
    {
        $db = new Database();
        
        $stmt = $db->pdo->prepare("SHOW VARIABLES LIKE 'version'");
        $stmt->execute();

        print_r($stmt->fetch());

        if(str_contains(strtolower($stmt->fetch()["Value"]), 'mariadb'))
        {
            $stmt = $db->pdo->prepare("SET GLOBAL information_schema_stats_expiry = 0");
            $stmt->execute();
        }
        
        $stmt = $db->pdo->prepare("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE lower(table_name) = lower(?) AND table_schema = DATABASE()");
        $stmt->execute([$table]);

        return $stmt->fetch()["AUTO_INCREMENT"];
    }

    public static function getCleanPdoErr($input)
    {
        $matches = array();
        $regex = '/[0-9]+(\\s+([a-zA-Z]+\\s+)+)\'[a-zA-Z]+\'(\\s+([a-zA-Z]+\\s+)+)\'[^\']*\'/i';
        preg_match($regex, $input, $matches);
        return $matches[0];
    }

    public static function resetDb()
    {
        $db = new Database();
        $stmt = $db->pdo->prepare(file_get_contents("assets/sql/arcusdb_local.sql"));
        $stmt->execute();
    }

    public static function executeAnything($query, $array = null)
    {
        $db = new Database();
        $stmt = $db->pdo->prepare($query);
        $stmt->execute($array);
    }
}

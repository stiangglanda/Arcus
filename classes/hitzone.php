<?php
require_once 'db.php';
class Hitzone extends Database
{
    #region ctor
    public $hitzoneId;
    public $hitzoneName;

    public function __construct($hitzoneId = null, $hitzoneName = null)
    {
        $this->hitzoneId = $hitzoneId;
        $this->hitzoneName = $hitzoneName;
    }

    #endregion

    public static function getAll()
    {
        $db = new Database();
        $stmt = $db->pdo->prepare("SELECT * FROM hitzone");
        $stmt->execute();
        $data = array();

        for ($i = 0; $i < $stmt->rowCount(); $i++) {
            $row = $stmt->fetch();
            $data[$i] = new Hitzone($row["hitzoneId"], $row["hitzoneName"]);
        }

        return $data;
    }

    public static function getById($id)
    {
        $db = new Database();
        $stmt = $db->pdo->prepare("SELECT * FROM hitzone WHERE hitzoneId = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        return new Hitzone($row["hitzoneId"], $row["hitzoneName"]);
    }
}
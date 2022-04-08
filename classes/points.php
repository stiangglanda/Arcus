<?php
require_once 'db.php';
class Points extends Database
{
    #region ctor
    public $pointsId;
    public $counting;
    public $hitZoneId;
    public $arrowId;


    public function __construct($pointsId = null, $counting = null, $hitZoneId = null, $arrowId = null)
    {
        $this->pointsId = $pointsId;
        $this->counting = $counting;
        $this->hitZoneId = $hitZoneId;
        $this->arrowId = $arrowId;
    }

    #endregion

    public static function getAll()
    {
        $db = new Database();
        $stmt = $db->pdo->prepare("SELECT * FROM points");
        $stmt->execute();
        $data = array();

        for ($i = 0; $i < $stmt->rowCount(); $i++) {
            $row = $stmt->fetch();
            $data[$i] = new Points($row["pointsId"], $row["counting"], $row["hitZoneId"], $row["arrowId"]);
        }

        return $data;
    }

    public static function getById($id)
    {
        $db = new Database();
        $stmt = $db->pdo->prepare("SELECT * FROM points WHERE pointsId = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        return new Points($row["pointsId"], $row["counting"], $row["hitZoneId"], $row["arrowId"]);
    }
}
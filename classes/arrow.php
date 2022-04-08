<?php
require_once 'db.php';
class Arrow extends Database
{
    #region ctor
    public $arrowId;
    public $arrowUsed;

    public function __construct($arrowId = null, $arrowUsed = null)
    {
        $this->arrowId = $arrowId;
        $this->arrowUsed = $arrowUsed;
    }

    #endregion

    public static function getAll()
    {
        $db = new Database();
        $stmt = $db->pdo->prepare("SELECT * FROM arrow");
        $stmt->execute();
        $data = array();

        for ($i = 0; $i < $stmt->rowCount(); $i++) {
            $row = $stmt->fetch();
            $data[$i] = new Arrow($row["arrowId"], $row["arrowUsed"]);
        }

        return $data;
    }

    public static function getById($id)
    {
        $db = new Database();
        $stmt = $db->pdo->prepare("SELECT * FROM arrow WHERE arrowId = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        return new Arrow($row["arrowId"], $row["arrowUsed"]);
    }
}
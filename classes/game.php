<?php
require_once 'db.php';
class Game extends Database
{
	#region ctor
	public $eventId;
	public $countingMode;

	public function __construct($eventId = null, $countingMode = null)
	{
		$this->eventId = $eventId;
		$this->countingMode = $countingMode;
	}
	#endregion

	public function insert()
	{
		$stmt = $this->pdo->prepare("INSERT INTO user(userId, firstName, lastName, nickName, password, guest) VALUES (?,?,?,?,?,?)");
		$stmt->execute([$this->userId, $this->firstName, $this->lastName, $this->nickName, $this->password, $this->guest]);
	}

	public static function getAll()
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM event");
		$stmt->execute();
		$data = array();

		for ($i = 0; $i < $stmt->rowCount(); $i++) {
			$row = $stmt->fetch();
			$data[$i] = new Game($row["eventId"], $row["countingMode"]);
		}

		return $data;
	}

	public static function getById($id)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM event WHERE eventId = ?");
		$stmt->execute([$id]);
		$row = $stmt->fetch();

		return new Game($row["eventId"], $row["countingMode"]);
	}
}

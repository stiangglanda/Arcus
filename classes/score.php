<?php

require_once 'db.php';
class Score extends Database
{
	#region ctor
	public $userId;
	public $animalId;
	public $pointsId;
	public $eventId;

	public function __construct($userId = null, $animalId = null, $pointsId = null, $eventId = null)
	{
		parent::__construct();
		$this->userId = $userId;
		$this->animalId = $animalId;
		$this->pointsId = $pointsId;
		$this->eventId = $eventId;
	}
	#endregion

	public function insert()
	{
		$stmt = $this->pdo->prepare("INSERT INTO score(userId, animalId, pointsId, eventId) VALUES (?,?,?,?)");
		$stmt->execute([$this->userId, $this->animalId, $this->pointsId, $this->eventId]);
	}

	public static function getAll()
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM score");
		$stmt->execute();
		$data = array();

		for ($i = 0; $i < $stmt->rowCount(); $i++) {
			$row = $stmt->fetch();
			$data[$i] = new Score($row['scoreId'], $row['userId'], $row['animalId'], $row['pointsId'], $row['eventId'], $row['created']);
		}

		return $data;
	}

	public static function getById($id)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM score WHERE scoreId = ?");
		$stmt->execute([$id]);
		$row = $stmt->fetch();

		return new Score($row['scoreId'], $row['userId'], $row['animalId'], $row['pointsId'], $row['eventId'], $row['created']);
	}
}

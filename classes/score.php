<?php

class Score extends Database
{
	#region ctor
	public $scoreId;
	public $points;
	public $userId;
	public $animalId;
	public $created;

	public function __construct($scoreId = null, $points = null, $userId = null, $animalId = null, $created = null)
	{
		$this->scoreId = $scoreId;
		$this->points = $points;
		$this->userId = $userId;
		$this->animalId = $animalId;
		$this->created = $created;
	}
	#endregion

	public function insert()
	{
		$stmt = $this->pdo->prepare("INSERT INTO score(scoreId, points, userId, animalId, created) VALUES (?,?,?,?,?)");
		$stmt->execute([$this->scoreId, $this->points, $this->userId, $this->animalId, $this->created]);
	}

	public static function getAll()
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM score");
		$stmt->execute();
		$data = array();

		for ($i = 0; $i < $stmt->rowCount(); $i++) {
			$row = $stmt->fetch();
			$data[$i] = new Score($row["scoreId"], $row["points"], $row["userId"], $row["animalId"], $row["created"]);
		}

		return $data;
	}

	public static function getById($id)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM score WHERE scoreId = ?");
		$stmt->execute([$id]);
		$row = $stmt->fetch();

		return new Score($row["scoreId"], $row["points"], $row["userId"], $row["animalId"], $row["created"]);
	}
}

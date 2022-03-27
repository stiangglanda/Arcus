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
		try {
			$stmt = $this->pdo->prepare("INSERT INTO score(scoreId, points, userId, animalId, created) VALUES (?,?,?,?,?)");
			$stmt->execute([$this->scoreId, $this->points, $this->userId, $this->animalId, $this->created]);
			return true;
		} catch (Throwable $e) {
			return false;
		}
	}

	#region statics
	public static function getScores()
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM score");
		$stmt->execute();
		$data = array();

		while ($row = $stmt->fetch()) {
			$data[] = $row;
		}

		return $data;
	}

	public static function exists($id)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM score where scoreId = ?");
		$stmt->execute([$id]);

		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}
	#endregion
}

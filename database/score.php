<?php

class Score extends Database
{
	public $scoreId;
	public $points;
	public $userId;
	public $animalId;
	public $created;
	public $pdo;

	public function getScore()
	{
		$stmt = $this->connection()->prepare("SELECT * FROM score");
		$stmt->execute();
		$data = array();

		while ($row = $stmt->fetch()) {
			$data[] = $row;
		}

		return $data;
	}
}

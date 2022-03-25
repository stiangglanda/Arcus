<?php

class Animal extends Database
{
	public $animalId;
	public $animalNumber;
	public $parcourId;

	public function getAnimals()
	{
		$stmt = $this->connection()->prepare("SELECT * FROM animal");
		$stmt->execute();
		$data = array();

		while ($row = $stmt->fetch()) {
			$data[] = $row;
		}

		return $data;
	}

	public function insert($animalNumber, $parcourId)
	{
		$stmt = $this->connection()->prepare("INSERT INTO animal (animalNumber, parcourId) VALUES (?,?)");
		$stmt->execute([$animalNumber, $parcourId]);
	}

	public function exists($id)
	{
		$stmt = $this->connection()->prepare("SELECT * FROM user where id = ?");
		$stmt->execute([$id]);

		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}
}

<?php

class Animal extends Database
{
	public $animalId;
	public $animalNumber;
	public $parcourId;

	public function getAnimals()
	{
		$stmt = $this->pdo->prepare("SELECT * FROM animal");
		$stmt->execute();
		$data = array();

		while ($row = $stmt->fetch()) {
			$data[] = $row;
		}

		return $data;
	}

	public function insert($animalNumber, $parcourId)
	{
		$stmt = $this->pdo->prepare("INSERT INTO animal (animalNumber, parcourId) VALUES (?,?)");
		$stmt->execute([$animalNumber, $parcourId]);
	}

	public function exists($id)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM user where id = ?");
		$stmt->execute([$id]);

		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}
}

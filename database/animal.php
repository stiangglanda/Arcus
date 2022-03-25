<?php

class Animal extends Database
{
	public $animalId;
	public $animalNumber;
	public $parcourId;
	public  $pdo;

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
}

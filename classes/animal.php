<?php

class Animal extends Database
{
	protected $animalId;
	protected $animalNumber;
	protected $parcourId;

	public function __construct($animalId = null, $animalNumber = null, $parcourId = null)
	{
		parent::__construct();
		$this->animalId = $animalId;
		$this->animalNumber = $animalNumber;
		$this->parcourId = $parcourId;
	}

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

	public function getAnimalById($id)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM animal WHERE animalId = ?");
		$stmt->execute([$id]);

		return $stmt->fetch();
	}

	public function insert($animalNumber, $parcourId)
	{
		$stmt = $this->pdo->prepare("INSERT INTO animal (animalNumber, parcourId) VALUES (?,?)");
		$stmt->execute([$animalNumber, $parcourId]);
	}

	public function exists($id)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM animal where id = ?");
		$stmt->execute([$id]);

		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}
}

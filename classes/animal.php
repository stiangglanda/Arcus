<?php

class Animal extends Database
{
	#region ctor
	public $animalId;
	public $animalNumber;
	public $parcourId;

	public function __construct($animalId = null, $animalNumber = null, $parcourId = null)
	{
		parent::__construct();
		$this->animalId = $animalId;
		$this->animalNumber = $animalNumber;
		$this->parcourId = $parcourId;
	}
	#endregion

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

	public function insert()
	{
		$stmt = $this->pdo->prepare("INSERT INTO animal (animalNumber, parcourId) VALUES (?,?)");
		return $stmt->execute([$this->animalNumber, $this->parcourId]);
	}

	public function delete()
	{
		$stmt = $this->pdo->prepare("DELETE FROM animal WHERE animalId = ?");
		$stmt->execute([$this->animalId]);
	}

	public static function getAnimalById($id)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM animal WHERE animalId = ?");
		$stmt->execute([$id]);

		return $stmt->fetch();
	}

	public static function exists($id)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM animal where id = ?");
		$stmt->execute([$id]);

		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}
}

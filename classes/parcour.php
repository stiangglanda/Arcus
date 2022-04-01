<?php

class Parcour extends Database
{
	public $parcourId;
	public $name;
	public $place;
	public $animalCount;

	public function __construct($parcourId = null, $name = null, $place = null, $animalCount = null)
	{
		parent::__construct();
		$this->parcourId = $parcourId;
		$this->name = $name;
		$this->place = $place;
		$this->animalCount = $animalCount;
	}

	public function getParcours()
	{
		$stmt = $this->pdo->prepare("SELECT * FROM parcour");
		$stmt->execute();
		$data = array();

		while ($row = $stmt->fetch()) {
			$data[] = $row;
		}

		return $data;
	}

	public function insert()
	{
		try {
			$stmt = $this->pdo->prepare("INSERT INTO parcour (name, place, animalCount) VALUES (?,?,?)");
			$stmt->execute([$this->name, $this->place, $this->animalCount]);

			for ($i=0; $i < $this->animalCount; $i++) { 
				$animal = new Animal(Utils::nextId("animal"), $i, $this->parcourId);
				$animal->insert();
			}

			return true;
		}
		catch (PDOException $e) {
			return false;
		}
	}

	public function getParcourById($id)
	{
		$parcour = new Parcour();
		$stmt = $parcour->pdo->prepare("SELECT * FROM parcour WHERE parcourId = ?");
		$stmt->execute([$id]);

		$parcour->id = $stmt->fetch()['parcourId'];
		$parcour->nickname = $stmt->fetch()['name'];
		$parcour->vName = $stmt->fetch()['place'];
		$parcour->nName = $stmt->fetch()['animalCount'];
		return $parcour;
	}
}

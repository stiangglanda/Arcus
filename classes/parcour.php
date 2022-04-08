<?php

require_once 'db.php';
class Parcour extends Database
{
	#region ctor
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
	#endregion

	public static function getParcours()
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM parcour");
		$stmt->execute();
		$data = array();

		for ($i = 0; $i < $stmt->rowCount(); $i++) {
			$row = $stmt->fetch();
			$data[$i] = new User($row["userId"], $row["firstName"], $row["lastName"], $row["nickName"], $row["password"], $row["guest"]);
		}

		return $data;
	}

	public function insert()
	{
		$stmt = $this->pdo->prepare("INSERT INTO parcour (name, place, animalCount) VALUES (?,?,?)");
		$stmt->execute([$this->name, $this->place, $this->animalCount]);

		for ($i = 1; $i <= $this->animalCount; $i++) {
			$animal = new Animal(Utils::nextId("animal"), $i, $this->parcourId);
			$animal->insert();
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
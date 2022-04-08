<?php
require_once 'db.php';
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

	public function getAll()
	{
		$stmt = $this->pdo->prepare("SELECT * FROM animal");
		$stmt->execute();
		$data = array();

		for ($i = 0; $i < $stmt->rowCount(); $i++) {
			$row = $stmt->fetch();
			$data[$i] = new Animal($row["animalId"], $row["animalNumber"], $row["parcourId"]);
		}

		return $data;
	}

	public function insert()
	{
		$stmt = $this->pdo->prepare("INSERT INTO animal (animalNumber, parcourId) VALUES (?,?)");
		$stmt->execute([$this->animalNumber, $this->parcourId]);
	}

	public function delete()
	{
		$stmt = $this->pdo->prepare("DELETE FROM animal WHERE animalId = ?");
		$stmt->execute([$this->animalId]);
	}

	public static function getById($id)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM animal WHERE animalId = ?");
		$stmt->execute([$id]);
		$row = $stmt->fetch();

		return new Animal($row["animalId"], $row["animalNumber"], $row["parcourId"]);
	}
}

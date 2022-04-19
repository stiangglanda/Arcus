<?php
require_once 'db.php';
class Animal extends Database
{
	#region constructor and variables
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

	/**
	 * Gets all animals from the database and returns them as an array
	 * 
	 * @return array[Animal]
	 */
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

	/**
	 * Inserts a new animal into the database.
	 * Throws an exception if unsuccessful.
	 * @return void
	 */
	public function insert()
	{
		$stmt = $this->pdo->prepare("INSERT INTO animal (animalNumber, parcourId) VALUES (?,?)");
		$stmt->execute([$this->animalNumber, $this->parcourId]);
	}

	/**
	 * Deletes an animal from the database.
	 * Throws an exception if unsuccessful.
	 * @return void
	 */
	public function delete()
	{
		$stmt = $this->pdo->prepare("DELETE FROM animal WHERE animalId = ?");
		$stmt->execute([$this->animalId]);
	}

	/**
	 * Gets an animal from the database by its id.
	 * Throws an exception if unsuccessful.
	 * @param int $id
	 * @return Animal
	 */
	public static function getById($id)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM animal WHERE animalId = ?");
		$stmt->execute([$id]);
		$row = $stmt->fetch();

		return new Animal($row["animalId"], $row["animalNumber"], $row["parcourId"]);
	}

	public static function findShotAnimal($parcourId, $currAnimal)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM animal WHERE parcourId = ? and animalNumber = ?");
		$stmt->execute([$parcourId, $currAnimal]);
		$row = $stmt->fetch();

		return $row["animalId"];
	}
}

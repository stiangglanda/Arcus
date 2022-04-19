<?php
require_once "db.php";
class User extends Database
{
	#region ctor
	public $userId;
	public $firstName;
	public $lastName;
	public $nickName;
	public $password;
	public $guest;

	function __construct($userId = null, $firstName = null, $lastName = null, $nickName = null, $password = null, $guest = null)
	{
		parent::__construct();
		$this->userId = $userId;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->nickName = $nickName;
		$this->password = $password;
		$this->guest = $guest;
	}
	#endregion

	#region DML
	public function insert()
	{
		$stmt = $this->pdo->prepare("INSERT INTO user(firstName, lastName, nickName, password, guest) VALUES (?,?,?,?,?)");
		$stmt->execute([$this->firstName, $this->lastName, $this->nickName, $this->password, $this->guest]);
	}
	public function delete()
	{
		$stmt = $this->pdo->prepare("DELETE FROM user WHERE userId = ?");
		$stmt->execute([$this->userId]);
	}
	#endregion

	#region get user(s)
	public static function getAll()
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM user");
		$stmt->execute();
		$data = array();

		for ($i = 0; $i < $stmt->rowCount(); $i++) {
			$row = $stmt->fetch();
			$data[$i] = new User($row["userId"], $row["firstName"], $row["lastName"], $row["nickName"], $row["password"], $row["guest"]);
		}

		return $data;
	}

	public static function getById($id)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM user WHERE userId = ?");
		$stmt->execute([$id]);
		$res = $stmt->fetch();

		if ($res) {
			return new User($res["userId"], $res["firstName"], $res["lastName"], $res["nickName"], $res["password"], $res["guest"]);
		}
		else {
			return false;
		}
	}

	public static function getBynickName($nickName)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM user WHERE nickName = ?");
		$stmt->execute([$nickName]);
		$res = $stmt->fetch();

		if ($res) {
			return new User($res["userId"], $res["firstName"], $res["lastName"], $res["nickName"], $res["password"], $res["guest"]);
		}
		else {
			return false;
		}
	}
	#endregion

	public static function validate($nickName, $password)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM user WHERE nickName = ? and password = ?");
		$stmt->execute([$nickName, $password]);
		$res = $stmt->fetch();

		if ($res) {
			return new User($res["userId"], $res["firstName"], $res["lastName"], $res["nickName"], $res["password"], $res["guest"]);
		}
		else {
			return null;
		}
	}

	#region Guest related functions
	public static function addGuest($firstName, $lastName, $nickName)
	{
		$db = new Database();
		$user = new User();
		$stmt = $db->pdo->prepare("INSERT INTO user(userId, firstName, lastName, nickName, password, guest) VALUES (?,?,?,?,?,1)");
		$stmt->execute([$user->getNextGuestId(), $firstName, $lastName, $user->getNextGuestId().'_'.$nickName, 'guest'.$user->getNextGuestId()]);

		$stmt = $db->pdo->prepare("SELECT * FROM user WHERE userId = ?");
		$stmt->execute([$db->pdo->lastInsertId()]);
		$res = $stmt->fetch();

		if ($res) {
			return new User($res["userId"], $res["firstName"], $res["lastName"], $res["nickName"], $res["password"], $res["guest"]);
		}
		else {
			throw new PDOException("Could not add the guest.", 1);
			
		}
	}

	public static function getNextGuestId()
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT userId FROM user WHERE guest = 1 ORDER BY userId DESC LIMIT 1");
		$stmt->execute();
		$res = $stmt->fetch();

		if ($res) {
			return $res["userId"] + 1;
		}
		else {
			return 900000000;
		}
	}

	public static function showGuestName($nickName)
	{
		return substr($nickName, strpos($nickName, '_') + 1);
	}
	#endregion
}
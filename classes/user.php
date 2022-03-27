<?php
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

	public function insert()
	{
		try {
			$stmt = $this->pdo->prepare("INSERT INTO user(userId, firstName, lastName, nickName, password, guest) VALUES (?,?,?,?,?,?)");
			$stmt->execute([$this->userId, $this->firstName, $this->lastName, $this->nickName, $this->password, $this->guest]);
		} catch (Exception $err) {
			return false;
		}
	}

	public function drop()
	{
		try {
			$stmt = $this->pdo->prepare("DELETE FROM user WHERE userId = ?");
			$stmt->execute([$this->userId]);
		} catch (Exception $err) {
			return false;
		}
	}

	public function exists()
	{
		try {
			$stmt = $this->pdo->prepare("SELECT * FROM user where userId = ?");
			$stmt->execute([$this->userId]);

			if ($stmt->rowCount() > 0) {
				return true;
			}
			return false;
		} catch (Error $th) {
			return false;
		}
	}

	#region statics
	public static function getUsers()
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

	public static function getUserById($id)
	{

		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM user WHERE userId = ?");
		$stmt->execute([$id]);
		$res = $stmt->fetch();

		if ($res) {
			return new User($res["userId"], $res["firstName"], $res["lastName"], $res["nickName"], $res["password"], $res["guest"]);
		} else {
			return false;
		}
	}

	public static function getUserByNickName($nickName)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM user WHERE nickName = ?");
		$stmt->execute([$nickName]);
		$res = $stmt->fetch();

		if ($res) {
			return new User($res["userId"], $res["firstName"], $res["lastName"], $res["nickName"], $res["password"], $res["guest"]);
		} else {
			return false;
		}
	}

	public static function nickNameExists($nickName)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM user where nickName = ?");
		$stmt->execute([$nickName]);

		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}

	public static function idExists($id)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM user where userId = ?");
		$stmt->execute([$id]);

		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}
	#endregion
}

<?php

class User extends Database
{
	#region ctor
	protected $userId;
	protected $firstName;
	protected $lastName;
	protected $nickName;
	protected $password;
	protected $guest;

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
		$stmt = $this->pdo->prepare("INSERT INTO user(userId, firstName, lastName, nickName, password, guest) VALUES (?,?,?,?,?,?)");
		$stmt->execute([$this->userId, $this->firstName, $this->lastName, $this->nickName, $this->password, $this->guest]);
	}

	public function drop()
	{
		$stmt = $this->pdo->prepare("DELETE FROM user WHERE userId = ?");
		$stmt->execute([$this->userId]);
	}

	// todo: wip making non-static
	public function exists()
	{
		$stmt = $this->pdo->prepare("SELECT * FROM user where userId = ?");
		$stmt->execute([$this->userId]);

		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}

	#region statics
	public static function getUsers()
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM user");
		$stmt->execute();
		$data = array();

		while ($row = $stmt->fetch()) {
			$data[] = $row;;
		}

		return $data;
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
	#endregion
}

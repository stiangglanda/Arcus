<?php

class User extends Database
{
	public $userId;
	public $firstName;
	public $lastName;
	public $nickName;
	public $password;
	public $guest;

	public function getUsers()
	{
		$stmt = $this->pdo->prepare("SELECT * FROM user");
		$stmt->execute();
		$data = array();

		while ($row = $stmt->fetch()) {
			$data[] = $row;
		}

		return $data;
	}

	public function insert($firstName, $lastName, $nickName, $password, $guest)
	{
		if (!$this->nickNameExists($nickName)) {
			$stmt = $this->pdo->prepare("INSERT INTO user(firstName, lastName, nickName, password, guest) VALUES (?,?,?,?,?)");
			$stmt->execute([$firstName, $lastName, $nickName, $password, $guest]);
			return true;
		}
		return false;
	}

	public function nickNameExists($nickName)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM user where nickName = ?");
		$stmt->execute([$nickName]);

		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}
}

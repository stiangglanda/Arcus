<?php

class User extends Database
{
	public $userId;
	public $firstName;
	public $lastName;
	public $nickName;
	public $password;
	public $guest;
	public $pdo;

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
}

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

	// function __construct($pdo, $userId = null, $firstName = null, $lastName = null, $nickName = null, $password = null, $guest = null)
	// {
	// 	$this->userId = $userId;
	// 	$this->firstName = $firstName;
	// 	$this->lastName = $lastName;
	// 	$this->nickName = $nickName;
	// 	$this->password = $password;
	// 	$this->guest = $guest;
	// 	$this->pdo = $pdo;
	// }
}

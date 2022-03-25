<?php

class Score extends Database
{
	public $scoreId;
	public $points;
	public $userId;
	public $animalId;
	public $created;
	public $pdo;

	// function __construct($pdo, $scoreId = null, $points = null, $userId = null, $animalId = null, $created = null)
	// {
	// 	$this->scoreId = $scoreId;
	// 	$this->points = $points;
	// 	$this->userId = $userId;
	// 	$this->animalId = $animalId;
	// 	$this->created = $created;
	// 	$this->pdo = $pdo;
	// }
}

<?php

class Parcour extends Database
{
	public $parcourId;
	public $name;
	public $place;
	public $animalCount;

	public function getParcours()
	{
		$stmt = $this->connection()->prepare("SELECT * FROM parcour");
		$stmt->execute();
		$data = array();

		while ($row = $stmt->fetch()) {
			$data[] = $row;
		}

		return $data;
	}
}

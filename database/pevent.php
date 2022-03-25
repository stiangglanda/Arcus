<?php
require_once "./database/db.php";
class PEvent extends Database
{
	public $eventId;
	public $countingMode;

	public function getEvents()
	{
		$stmt = $this->connection()->prepare("SELECT * FROM event");
		$stmt->execute();
		$data = array();

		while ($row = $stmt->fetch()) {
			$data[] = $row;
		}

		return $data;
	}
}

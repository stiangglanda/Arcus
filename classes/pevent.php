<?php
class PEvent extends Database
{
	#region ctor
	public $eventId;
	public $countingMode;

	public function __construct($eventId = null, $countingMode = null)
	{
		$this->eventId = $eventId;
		$this->countingMode = $countingMode;
	}
	#endregion

	public function insert()
	{
		try {
			$stmt = $this->pdo->prepare("INSERT INTO user(userId, firstName, lastName, nickName, password, guest) VALUES (?,?,?,?,?,?)");
			$stmt->execute([$this->userId, $this->firstName, $this->lastName, $this->nickName, $this->password, $this->guest]);
			return true;
		}
		catch (Throwable $e) {
			return false;
		}
	}

	public static function getEvents()
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM event");
		$stmt->execute();
		$data = array();

		while ($row = $stmt->fetch()) {
			$data[] = $row;
		}

		return $data;
	}

	public static function exists($id)
	{
		$db = new Database();
		$stmt = $db->pdo->prepare("SELECT * FROM event where eventId = ?");
		$stmt->execute([$id]);

		if ($stmt->rowCount() > 0) {
			return true;
		}
		return false;
	}
}

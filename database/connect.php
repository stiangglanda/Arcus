<?php

require '../database/config.php';

function connect($db_host, $db_database, $db_user, $db_password)
{
	$dsn = "mysql:host=$db_host;dbname=$db_database;charset=UTF8";

	try {
		$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

		$pdo = new PDO($dsn, $db_user, $db_password, $options);

		if ($pdo) {
			// echo "Successfully connected to $db_database";
		}

		return $pdo;
	} catch (PDOException $e) {
		die($e->getMessage());
	}
}

return connect($db_host, $db_database, $db_user, $db_password);

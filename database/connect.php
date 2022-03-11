<?php

require_once 'config.php';

function connect($db_host, $db_database, $db_user, $db_password)
{
	$dsn = "mysql:host=$db_host;dbname=$db_database;charset=UTF8";

	try {
		$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

		return new PDO($dsn, $db_user, $db_password, $options);
	} catch (PDOException $e) {
		echo $e->getMessage();
		die($e->getMessage());
	}
}

return connect($db_host, $db_database, $db_user, $db_password);

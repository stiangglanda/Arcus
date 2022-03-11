<?php

require_once 'config.php';

function connect($host, $database, $user, $password)
{
	$dsn = "mysql:host=$host;dbname=$database;charset=UTF8";

	try {
		$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

		return new PDO($dsn, $user, $password, $options);
	} catch (PDOException $e) {
		echo $e->getMessage();
		die($e->getMessage());
	}
}

return connect($host, $database, $user, $password);

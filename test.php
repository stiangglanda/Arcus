<?php

require_once "./classes/db.php";
require_once "./classes/animal.php";
require_once "./classes/pevent.php";
require_once "./classes/parcour.php";
require_once "./classes/score.php";
require_once "./classes/user.php";
require_once "./classes/utils.php";

$pdo = new Database();
$utils = new Utils();

$animal = new Animal();
$user = new User();
$event = new PEvent();
$parcour = new Parcour();
$score = new Score();

$david = new User(Utils::nextId("user"), "David", "Kaiser", "Kr4mpuz", "1234", 0);
$leander = new User(Utils::nextId("user"), "Leander", "Kieweg", "stiangglanda", "1234", 0);
$tim = new User(Utils::nextId("user"), "Tim", "Hofmann", "ThisTim", "1234", 0);

$david->insert();
$leander->insert();
$tim->insert();
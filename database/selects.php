<?php
if (isset($_GET['getUser'])) {
    getUser();
}
if (isset($_GET['getScore'])) {
    getScore();
}
if (isset($_GET['getAnimal'])) {
    getAnimal();
}
if (isset($_GET['getParcour'])) {
    getParcour();
}
if (isset($_GET['getEvent'])) {
    getEvent();
}

function getUser()
{
    try {
        $pdo = require '../database/connect.php';
        $sql = "SELECT * FROM user"; // call getUser
        $array = array();
        $count = 0;

        // save result rows to array
        foreach ($pdo->query($sql) as $row) {
            $array += array(
                $count => array(
                    "userId" => $row['userId'], // int
                    "firstName" => $row['firstName'], // string
                    "lastName" => $row['lastName'], // string
                    "nickName" => $row['nickName'], // string
                    "password" => $row['password'], // string
                    "guest" => $row['guest'] // bool (0 = no guest, 1 = guest)
                )
            );

            $count++;
        }

        // encode array to json
        $json = json_encode(array('user' => $array));

        //write json to file
        if (!file_put_contents("data.json", $json)) {
            echo "Oops! Error creating json file...";
        }
    } catch (\Throwable $e) {
        die($e->getMessage());
    }
}

function getScore()
{
    try {
        $pdo = require '../database/connect.php';
        $sql = "call getScore()";
        $array = array();
        $count = 0;

        // save result rows to array
        foreach ($pdo->query($sql) as $row) {
            $array += array(
                $count => array(
                    "scoreId" => $row['scoreId'], // int
                    "points" => $row['points'], // int
                    "userId" => $row['userId'], // int
                    "animalId" => $row['animalId'], // string
                    "created" => $row['created'] // DateTime
                )
            );

            $count++;
        }

        // encode array to json
        $json = json_encode(array('score' => $array));

        //write json to file
        if (!file_put_contents("data.json", $json)) {
            echo "Oops! Error creating json file...";
        }
    } catch (\Throwable $e) {
        die($e->getMessage());
    }
}

function getAnimal()
{
    try {
        $pdo = require '../database/connect.php';
        $sql = "call getAnimal()";
        $array = array();
        $count = 0;

        // save result rows to array
        foreach ($pdo->query($sql) as $row) {
            $array += array(
                $count => array(
                    "animalId" => $row['animalId'], // int
                    "animalNumber" => $row['animalNumber'], // int
                    "parcourId" => $row['parcourId'] // int
                )
            );

            $count++;
        }

        // encode array to json
        $json = json_encode(array('animal' => $array));

        //write json to file
        if (!file_put_contents("data.json", $json)) {
            echo "Oops! Error creating json file...";
        }
    } catch (\Throwable $e) {
        die($e->getMessage());
    }
}

function getParcour()
{
    try {
        $pdo = require '../database/connect.php';
        $sql = "SELECT * FROM parcour";
        $array = array();
        $count = 0;

        // save result rows to array
        foreach ($pdo->query($sql) as $row) {
            $array += array(
                $count => array(
                    "parcourId" => $row['parcourId'], // int
                    "name" => $row['name'], // string
                    "place" => $row['place'], // string
                    "animalCount" => $row['animalCount'] // int
                )
            );

            $count++;
        }

        // encode array to json
        $json = json_encode(array('parcour' => $array));

        //write json to file
        if (!file_put_contents("data.json", $json)) {
            echo "Oops! Error creating json file...";
        }
    } catch (\Throwable $e) {
        die($e->getMessage());
    }
}

function getEvent()
{
    try {
        $pdo = require '../database/connect.php';
        $sql = "call getEvent()";
        $array = array();
        $count = 0;

        // save result rows to array
        foreach ($pdo->query($sql) as $row) {
            $array += array(
                $count => array(
                    "eventId" => $row['eventId'], // int
                    "countingMode" => $row['countingMode'] // string
                )
            );

            $count++;
        }

        // encode array to json
        $json = json_encode(array('event' => $array));

        //write json to file
        if (!file_put_contents("data.json", $json)) {
            echo "Oops! Error creating json file...";
        }
    } catch (\Throwable $e) {
        die($e->getMessage());
    }
}

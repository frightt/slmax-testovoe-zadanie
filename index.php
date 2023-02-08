<?php
require_once 'connect.php';
require_once 'Person.php';
require_once 'PersonList.php';

$db = new Database();
$conn = $db->connect();

$person = new Person(1, $conn);
$person->formatPerson(true, true);

$personList = new PersonList($conn);
$personList->getAll();

$conn->close();


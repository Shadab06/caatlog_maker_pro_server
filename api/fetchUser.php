<?php

error_reporting(E_ALL);
ini_set('display_error', 1);

Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Methods: POST');

//incluse required files
include_once('../config/database.php');
include_once('../models/user.php');

//connction with db

$database = new Database();
$db = $database->connect();

$users = new User($db);

$data = $users->readAllUser();

if ($data->rowCount()) {
    $calls = [];

    while ($row = $data->fetch(PDO::FETCH_OBJ)) {
        $calls[] = $row;
    }
    echo json_encode($calls);
} else {
    echo json_encode(['message' => 'No data found!!!']);
}

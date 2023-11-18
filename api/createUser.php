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

$data = json_decode(file_get_contents('php://input'));

if (isset($data)) {
    $user = new User($db);

    $params = [
        'name' => $data->name,
        'email' => $data->email,
        'phone' => $data->phone
    ];

    try {
        $id = $user->createUser($params);

        $params = [
            'id' => $id,
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone
        ];

        echo json_encode($params);
    } catch (PDOException $e) {
        echo "Error in user registration: " . $e->getMessage();
    }
}

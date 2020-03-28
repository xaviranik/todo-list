<?php

require_once('../../../bootstrap.php');
header('Access-Control-Allow-Methods: DELETE');

// Getting Request
$request = json_decode(file_get_contents("php://input"));
if ($request == null) {
    echo json_encode(['message' => 'error']);
    die();
}

$todo = new Todo($db);
$todo->id = $request->id;

if ($todo->delete()) 
{
    echo json_encode(['message' => 'deleted']);
} 
else
{
    echo json_encode(['message' => 'error']);
}
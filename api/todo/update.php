<?php

require_once('../../index.php');
header('Access-Control-Allow-Methods: PUT');

// Getting Request
$request = json_decode(file_get_contents("php://input"));
if ($request == null) 
{
    echo json_encode(['message' => 'error']);
    die();
}

$todo = new Todo($db);
$todo->id = $request->id;
$todo->title = $request->title;
$todo->completed = $request->completed;

if ($todo->update()) 
{
    echo json_encode(['message' => 'updated']);
} 
else 
{
    echo json_encode(['message' => 'error']);
}
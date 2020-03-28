<?php

require_once('../../../bootstrap.php');
header('Access-Control-Allow-Methods: POST');

// Getting Request
$request = json_decode(file_get_contents("php://input"));
if($request == null)
{
    echo json_encode([ 'message' => 'error' ]);
    die();
}

$todo = new Todo($db);
$todo->title = $request->title;
$todo->completed = 0;

if($todo->create())
{
    echo json_encode(['message' => 'created']);
}
else
{
    echo json_encode(['message' => 'error']);
}


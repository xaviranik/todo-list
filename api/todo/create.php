<?php

require_once('../../index.php');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

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


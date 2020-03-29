<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php');
header('Access-Control-Allow-Methods: DELETE');

$todo = new Todo($db);

if ($todo->deleteCompleted()) 
{
    echo json_encode(['message' => 'deleted']);
} 
else
{
    echo json_encode(['message' => 'error']);
}
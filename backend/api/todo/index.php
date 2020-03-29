<?php

require_once('../../../bootstrap.php');

$todo = new Todo($db);
$data = $todo->index();

if ($data->rowCount() > 0)
{
    $todo_array = array();

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) 
    {
        extract($row);
        $todo_item = array(
            'id' => $id,
            'title' => $title,
            'completed' => $completed ? true : false,
        );

        array_push($todo_array, $todo_item);
    }

    echo json_encode($todo_array);
}
else 
{
    // No todos
    echo json_encode(
        array('message' => 'No Todos Found')
    );
}
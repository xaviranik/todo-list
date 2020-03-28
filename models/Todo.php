<?php

class Todo {

    private $db;
    private $table = 'todos';

    public $id;
    public $title;
    public $completed;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        $sql = 'SELECT * from ' . $this->table;
        return $this->db->runQuery($sql);
    }

    public function create()
    {
        $sql = 'INSERT INTO ' . $this->table . ' SET title = :title, completed = :completed';
        return $this->db->runQuery($sql, [
            'title' => $this->title,
            'completed' => $this->completed
        ]);
    }

    public function update()
    {
        $sql = 'UPDATE ' . $this->table . ' SET title = :title, completed = :completed' . ' WHERE id = :id';
        return $this->db->runQuery($sql, [
            'title' => $this->title,
            'completed' => $this->completed,
            'id' => $this->id
        ]);
    }
}
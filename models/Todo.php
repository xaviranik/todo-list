<?php

class Todo {

    private $db;
    private $table = 'todos';

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
        return $this->db->runQuery($sql, ['title' => $this->title, 'completed' => $this->completed]);
    }

    
}
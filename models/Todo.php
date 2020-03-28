<?php

class Todo {

    private $db;
    private $table = 'todos';

    private $title;
    private $completed;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        $sql = 'SELECT * from ' . $this->table;
        return $this->db->runQuery($sql);
    }

    
}
<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'todo_db';
    private $username = 'root';
    private $password = 'root';
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->db;
    }

    public function runQuery($sql, $args = NULL)
    {
        return $args == null ? $this->db->query($sql) : $this->db->prepare($sql)->execute($args);
    }
}
<?php

  class Database {
    public $connection;
    public $db;

    function __construct() {
       $this->db = $this->open_db_connection();
    }

    public function open_db_connection() {
      $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

      if($this->connection->connect_errno) {
        die("Database connection failed badly " . $this->connection->connect_error);
      }
      return $this->connection;
    }

    public function query($sql) {
      $result = $this->db->query($sql);
      $this->confirm_query($result);
      return $result;
    }

    private function confirm_query($result) {
      if(!$result) {
        die("Query failed" . $this->db->error);
      }
    }

    public function escape_string($string) {
      $escaped_string = $this->db->real_escape_string($string);
      return $escaped_string;
    }

    public function the_insert_id() {
      return $this->db->insert_id;
    }

  }

  $database = new Database();
 ?>

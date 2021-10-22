<?php 
  class Database {
    
    // Database Parameters
    private $host = 'localhost';
    private $dbname = 'myblog';
    private $username = 'root';
    private $password = '';
    private $conn;
    

    // connect method
    public function connect() {

      $this->conn = null;

      try { 

        $dsn = "mysql:host=" . $this->host .";dbname=" . $this->dbname;
        $this->conn = new PDO($dsn, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
      } catch(PDOException $e) {

        echo 'Connection Error: ' . $e->getMessage();

      }

      return $this->conn;
    }
  }
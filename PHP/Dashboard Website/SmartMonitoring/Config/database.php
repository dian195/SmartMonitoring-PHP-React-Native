<?php 
    class DB {
        private $host = "localhost";
        private $db = "rab_smartmon";
        private $username = "root";
        private $password = "";
        private $port = "3306";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database not connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>
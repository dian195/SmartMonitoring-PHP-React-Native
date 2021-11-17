<?php
    class Lokasi{

        // conn
        private $conn;

        // table
        private $dbTable = "tbllokasi";

        // col
        public $id;
        public $lokasi_name;
        public $status;

        // db conn
        public function __construct($db){
            $this->conn = $db;
        }

        // GET Users
        public function getLokasi(){

            $sqlQuery = "";

            if (isset($this->id) == true && isset($this->lokasi_name) == true)
            {
                if ($this->id == "" && $this->lokasi_name == "")
                {
                    $sqlQuery = "SELECT id, lokasi_name, status FROM " . $this->dbTable . "";
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                }
                else if ($this->id != "" && $this->lokasi_name == "")
                {
                    $sqlQuery = "SELECT id, lokasi_name, status FROM " . $this->dbTable . " where id = ?";
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->bindParam(1, $this->id);
                    $stmt->execute();
                    return $stmt;
                }
                else if ($this->id == "" && $this->lokasi_name != "")
                {
                    $sqlQuery = "SELECT id, lokasi_name, status FROM " . $this->dbTable . " where lokasi_name = ?";
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->bindParam(1, $this->lokasi_name);
                    $stmt->execute();
                    return $stmt;
                }
                else 
                {
                    $sqlQuery = "SELECT id, lokasi_name, status FROM " . $this->dbTable . " where id = ? and lokasi_name = ?";
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->bindParam(1, $this->id);
                    $stmt->bindParam(2, $this->lokasi_name);
                    $stmt->execute();
                    return $stmt;
                }
            }
            else if (isset($this->id) == true && isset($this->lokasi_name) == false)
            {
                if ($this->id == "")
                {
                    $sqlQuery = "SELECT id, lokasi_name, status FROM " . $this->dbTable . "";
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                }
                else
                {
                    $sqlQuery = "SELECT id, lokasi_name, status FROM " . $this->dbTable . " where id = ?";
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->bindParam(1, $this->id);
                    $stmt->execute();
                    return $stmt;
                }
            }
            else if (isset($this->id) == false && isset($this->lokasi_name) == true)
            {
                if ($this->lokasi_name == "")
                {
                    $sqlQuery = "SELECT id, lokasi_name, status FROM " . $this->dbTable . "";
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->execute();
                    return $stmt;
                }
                else
                {
                    $sqlQuery = "SELECT id, lokasi_name, status FROM " . $this->dbTable . " where lokasi_name = ?";
                    $stmt = $this->conn->prepare($sqlQuery);
                    $stmt->bindParam(1, $this->lokasi_name);
                    $stmt->execute();
                    return $stmt;
                }
            }
            else
            {
                $sqlQuery = "SELECT id, lokasi_name, status FROM " . $this->dbTable . "";
                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->execute();
                return $stmt;
            }
        }

        // CREATE 
        public function InsertData(){
            $sqlQuery = "INSERT INTO
                        ". $this->dbTable ."
                    SET
                        id = :id, 
                        lokasi_name = :lokasi_name, 
                        status = 1";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->lokasi_name=htmlspecialchars(strip_tags($this->lokasi_name));
        
            // bind data
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":lokasi_name", $this->lokasi_name);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function UpdateData(){
            $sqlSet = "";
            $lokasiStat = "";
            $statusStat = "";

            if (isset($this->lokasi_name) == true)
            {
                if ($this->lokasi_name != "")
                {
                    $lokasiStat = "OK";

                    if ($sqlSet == "")
                    {
                        $sqlSet = $sqlSet . " SET lokasi_name = :lokasi_name ";
                    }
                    else
                    {
                        $sqlSet = $sqlSet . ", lokasi_name = :lokasi_name ";
                    }
                }
            }

            if (isset($this->status) == true)
            {
                if ($this->status != "")
                {
                    $statusStat = "OK";

                    if ($sqlSet == "")
                    {
                        $sqlSet = $sqlSet . " SET status = :status ";
                    }
                    else
                    {
                        $sqlSet = $sqlSet . ", status = :status ";
                    }
                }
            }

            if (isset($this->id) == true)
            {
                if ($this->id == "")
                {
                    return false;
                }
            }
            else
            {
                return false;
            }

            if ($sqlSet == "")
            {
                return false;
            }

            $sqlQuery = "UPDATE " . $this->dbTable . $sqlSet . " 
                    WHERE
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            if ($lokasiStat == "OK")
            {
                $this->lokasi_name=htmlspecialchars(strip_tags($this->lokasi_name));
            }

            if ($statusStat == "OK")
            {
                $this->status=htmlspecialchars(strip_tags($this->status));
            }

            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            if ($lokasiStat == "OK")
            {
                $stmt->bindParam(":lokasi_name", $this->lokasi_name);
            }

            if ($statusStat == "OK")
            {
                $stmt->bindParam(":status", $this->status);
            }
            
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // GET User
        /*public function getLokasiByID(){
            $sqlQuery = "SELECT
                        id, 
                        lokasi_name, 
                        status 
                      FROM
                        ". $this->dbTable ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->id = $dataRow['id'];
            $this->lokasi_name = $dataRow['lokasi_name'];
            $this->status = $dataRow['status'];
        }        */

        // DELETE User
        /*function deleteUser(){
            $sqlQuery = "DELETE FROM " . $this->dbTable . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }*/

    }
?>
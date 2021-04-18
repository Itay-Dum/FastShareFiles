<?php

include_once 'config.inc.php';
include_once 'uid.inc.php';

class DB extends DBConfig {
    private $username;
    private $servername;
    private $password;
    private $dbname;
    private $conn;

    public function  __construct() {
        $config = DBConfig::getConfig();
        
        $this->username = $config["username"];
        $this->servername = $config["servername"];
        $this->password = $config["password"];
        $this->dbname = $config["dbname"];
        $this->initDBConn();
    }

    private function initDBConn() {    

        $this->conn = new PDO (
            "mysql:host=$this->servername;dbname=$this->dbname",
            $this->username,
            $this->password
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }


    public function MakeNewFileQuery($temp_name, $name, $upload_id) {
        $stmt = $this->conn->prepare("INSERT INTO files (temp_name, name, upload_id)
        VALUES (:temp_name, :name, :upload_id)");

        $stmt->bindParam(":temp_name", $temp_name);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":upload_id", $upload_id);

        $stmt->execute();

    }

    public function IsIDExist($id) {
        $stmt = $this->conn->prepare("SELECT 1 FROM files WHERE upload_id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        return count($stmt->fetchAll()) > 0;
    }

    public function SelectFilesOnId($id) {
        $stmt = $this->conn->prepare("SELECT name, temp_name FROM files
        WHERE upload_id=:id");
        
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $arr = $stmt->fetchAll();
        
        return $arr;
    }

}

$test = new DB();

// $test->MakeNewFileQuery("dumay.cat", "dsdsadsadsawd", "yourmom");

?>
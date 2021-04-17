<?php

include_once 'config.inc.php';


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

}

$test = new DB();
$test->MakeNewFileQuery("ffdlf", "fdsf", "Dsds");

?>
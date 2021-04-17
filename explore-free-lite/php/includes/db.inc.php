<?php

class DB {
    private $username;
    private $servername;
    private $password;
    private $dbname;
    private $conn;

    public function  __construct(string $uname, string $pwd, string $sname, string $dbname) {
        $this->username = $uname;
        $this->servername = $sname;
        $this->password = $pwd;
        $this->dbname = $dbname;
    }

    public function initConn() {

        $this->conn = new PDO (
            "mysql:host=$this->servername;dbname=$this->dbname",
            $this->username,
            $this->password
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }

    public function createTestQuery($temp_name, $name, $upload_id) {

        $stmt = $this->conn->prepare("INSERT INTO files (temp_name, name, upload_id)
        VALUES (:temp_name, :name, :upload_id)");

        $stmt->bindParam(":temp_name", $temp_name);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":upload_id", $upload_id);

        $stmt->execute();

    }

}

$test = new DB("root", "", "127.0.0.1", "sharefiles");
$test->initConn();
$test->createTestQuery("ffdlf", "fdsf", "Dsds");

?>
<?php 
include_once 'db.inc.php';

class Uploads {
    private $db;

    public function  __construct() {
        $this->db = new DB();
    }


    public function verifyID() {
        $id = $_GET["id"];
        if (!isset($id)) 
        {
            echo "You must specify and id in the request parametres!";
            exit; 
        }
        elseif (!($this->db->IsIDExist($id))) {
            echo "The id: $id dosent exist on our system!";
            exit;
        }
    }

    public function RenderFileNames() {
        $filesID = $_GET["id"];
        $db = new DB();
        $filesOnIDArr = $db->SelectFilesOnId($filesID);
        
        foreach ($filesOnIDArr as $file) {
            $fileTempName = $file["temp_name"];
            echo "<span class='file-item-row'><h3 class='file-name'>$fileTempName</h3 ></span>";
        }

    }


}

?>
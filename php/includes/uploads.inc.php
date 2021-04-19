<?php 

include_once 'db.inc.php';
// define("UPLOAD_DIRECTORY", "../uploads/");

class Uploads {
    private $db;
    private $id;

    public function  __construct() {
        $this->db = new DB();
    }

    public function verifyID() {
        $this->id = $_GET["id"];
        if (!isset($this->id)) 
        {
            echo "You must specify and id in the request parametres!";
            exit; 
        }
        elseif (!($this->db->IsIDExist($this->id))) {
            echo "The id: $this->id dosent exist on our system!";
            exit;
        }
    }

    public function RecieveFileRequests() {
        $fileID = $_GET["fileId"];
        if (!isset($fileID)) {  
        }
        else {
            if ($this->db->IsFileIdExistOnUploadId($this->id, $fileID)) {
                $fileTempName = $this->db->GetFileTempName($this->id, $fileID);
                if ($fileTempName) {
                    echo var_dump($fileTempName);
                    $ext = explode(".", $fileTempName);
                    $ext = end($ext);
                    $this->SendFile($fileTempName, $fileID, $ext);
                }
            }
        }
    }

    private function SendFile($fileTempName, $fileId, $ext) {
        $fileName =  $fileId . "." .$ext;

        clearstatcache();
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$fileTempName.'"');
        header('Pragma: public');  
        header('Content-Length: ' . filesize($fileName));
        flush();
        ob_clean();
        readfile($fileName);
        exit();
    }

    public function RenderFileNames() {
        $filesID = $_GET["id"];
        $db = new DB();
        $filesOnIDArr = $db->SelectFilesOnId($filesID);
        
        foreach ($filesOnIDArr as $file) {
            $fileTempName = $file["temp_name"];
            $fileDownloadID = $file["name"];

            echo <<<PHP_EOL
                <span class="file-item-row"><h3 class="file-name">$fileTempName
                
                <svg class="download-button" onclick='DownloadFile("$fileDownloadID");' xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                </svg>
               
                </h3></span>
                
            PHP_EOL;
        }
    }
}
?>
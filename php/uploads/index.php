<?php

    include_once '../includes/uploads.inc.php';

    $fileID = $_GET["fileId"];
    $uploadID = $_GET["id"];

    if (isset($fileID) && isset($uploadID)) {
        $upload = new Uploads();
        $upload->verifyID();
        $upload->RecieveFileRequests();
    }
    else {
        echo "Must specify fileId and id params.";
        exit;
    }


?>
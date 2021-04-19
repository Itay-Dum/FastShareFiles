<?php

include_once 'includes/db.inc.php';
include_once 'includes/uid.inc.php';

header("Content-Type: application/json");


if (!empty($_FILES['file']['name'][0])) {
    $db = new DB();
    $newUploadUrl = UID::guidv4();

    foreach ($_FILES['file']['name'] as $position => $name) {

        $uidFileLocation = UID::guidv4();
        $ext = explode(".", $name);

        if (move_uploaded_file (
                $_FILES['file']['tmp_name'][$position],
                'uploads/'.$uidFileLocation. "." . end($ext),
            )
        )
        {
            $db->MakeNewFileQuery($name, $uidFileLocation, $newUploadUrl);
        }
        else {
            echo http_response_code(400);
        }
    }
    echo substr($newUploadUrl, 0, -3);
}

?>

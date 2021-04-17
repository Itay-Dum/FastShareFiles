<?php

header("Content-Type: application/json");


if (!empty($_FILES['file']['name'][0])) {
    foreach ($_FILES['file']['name'] as $position => $name) {
        if(move_uploaded_file($_FILES['file']['tmp_name'][$position], 'uploads/'.$name)) {
            
            
            
            
            echo http_response_code(200);
        }
        else {
            echo http_response_code(400);
        }
    }
}

?>

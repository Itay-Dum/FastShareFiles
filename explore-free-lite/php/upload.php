<?php

header("Content-Type: application/json");

$uploaded = array();
echo var_dump($_FILES);

if (!empty($_FILES['file']['name'][0])) {
    foreach ($_FILES['file']['name'] as $position => $name) {
        if(move_uploaded_file($_FILES['file']['tmp_name'][$position], 'uploads/'.$name)) {
            echo "all good";
        }
        else {
            echo "No. Just No.";
        }
    }
}

?>

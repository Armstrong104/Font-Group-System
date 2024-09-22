<?php
if ($_FILES['file']['name']) {
    $file_name = $_FILES['file']['name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    if ($ext == 'ttf') {
        move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $file_name);
        echo "File uploaded";
    } else {
        echo "Invalid file type";
    }
}


<?php
$group_name = $_GET['group'];
$group_file = "groups/$group_name.json";

if (file_exists($group_file)) {
    unlink($group_file); // Delete the file
    echo "Font group '$group_name' has been deleted.";
} else {
    echo "Font group does not exist.";
}
// Redirect back to index
header('Location: index.php');

<?php
$font_file = $_GET['font'];
$font_path = "uploads/$font_file";

// Check if the font file exists
if (file_exists($font_path)) {
    unlink($font_path); // Delete the font file
    echo "Font '$font_file' deleted successfully.";
} else {
    echo "Font not found.";
}

// Redirect back to index
header('Location: index.php');
?>

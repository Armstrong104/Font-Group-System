<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $group_name = $_POST['group_name']; // Get the group name from the form
    $selected_fonts = $_POST['fonts']; // Get the selected fonts from the form
    
    // Ensure $selected_fonts is an array before proceeding
    if (!is_array($selected_fonts) || count($selected_fonts) < 2) {
        die('You must select at least two fonts.');
    }

    $dir = 'groups'; // Directory where font groups are stored
    $group_file = "$dir/$group_name.json"; // JSON file for the group

    // Save the selected fonts back to the JSON file
    file_put_contents($group_file, json_encode($selected_fonts));

    // Set the success message in the session
    $_SESSION['success'] = "Group updated successfully";

    // Redirect to index.php without a query string
    header("Location: index.php");
    exit();
}

<?php
$dir = 'uploads';
$files = scandir($dir);

// Check if the request is for the font select options (via AJAX request)
if (isset($_GET['forSelect']) && $_GET['forSelect'] == '1') {
    $options = "<option value='' disabled selected>Select Font</option>"; // Add placeholder option

    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) == 'ttf') {
            // Get the font name (without the extension)
            $font_name = pathinfo($file, PATHINFO_FILENAME);
            // Create option element
            $options .= "<option value='" . htmlspecialchars($file) . "'>" . htmlspecialchars($font_name) . "</option>";
        }
    }
    
    // Return the options for select dropdown
    echo $options;
} else {
    // Otherwise, render the table for the UI
    echo '<table class="table table-bordered">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">Font Name</th>';
    echo '<th scope="col">Preview</th>';
    echo '<th scope="col">Actions</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) == 'ttf') {
            // Get the font name (without the extension)
            $font_name = pathinfo($file, PATHINFO_FILENAME);

            // Output table row
            echo '<tr>';
            echo '<td>' . htmlspecialchars($font_name) . '</td>';

            // Inline CSS to preview the font by dynamically referencing the uploaded font file
            echo '<td style="font-family: ' . htmlspecialchars($font_name) . ';">Example Style</td>';

            // Action buttons (Delete functionality with confirmation)
            echo '<td>';
            echo '<a href="delete_font.php?font=' . urlencode($file) . '" class="text-danger" ';
            echo 'onclick="return confirm(\'Are you sure you want to delete the font ' . htmlspecialchars($font_name) . '?\')">Delete</a>';
            echo '</td>';

            echo '</tr>';

            // Dynamically add a @font-face rule in the style section to apply the uploaded font in the preview
            echo "<style>
                    @font-face {
                        font-family: '" . htmlspecialchars($font_name) . "';
                        src: url('" . $dir . "/" . $file . "');
                    }
                  </style>";
        }
    }

    echo '</tbody>';
    echo '</table>';
}
?>

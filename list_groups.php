<?php
$dir = 'groups'; // Directory where font groups are stored

// Check if the 'groups' directory exists; if not, create it
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

// Scan the 'groups' directory
$groups = scandir($dir);

echo '<div class="container mt-5">';
echo '<h2>Font Groups</h2>';
echo '<p>List of all available font groups.</p>';

echo '<table class="table table-bordered">';
echo '<thead>';
echo '<tr>';
echo '<th scope="col">Name</th>';
echo '<th scope="col">Fonts</th>';
echo '<th scope="col">Count</th>';
echo '<th scope="col">Actions</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

// Initialize a counter for naming the groups
$example_counter = 1;

foreach ($groups as $group) {
    if (pathinfo($group, PATHINFO_EXTENSION) == 'json') {
        // Dynamically generate the group name as "Example X"
        $group_name = "Group " . $example_counter;

        // Read the JSON file content
        $json_content = file_get_contents("$dir/$group");

        // Check if the content is a string and convert it to an array
        $fonts = json_decode($json_content, true);

        // If $fonts is a string, try converting it to an array
        if (is_string($fonts)) {
            $fonts = explode(',', $fonts); // Split the string into an array
        }

        // Prepare the font list and count
        if (is_array($fonts)) {
            $font_list = implode(', ', $fonts); // Convert the array back to a comma-separated string
            $font_count = count($fonts); // Count the number of fonts in the group
        } else {
            $font_list = 'No fonts available';
            $font_count = 0;
        }

        echo '<tr>';
        echo '<td>' . htmlspecialchars($group_name) . '</td>';
        echo '<td>' . htmlspecialchars($font_list) . '</td>';
        echo '<td>' . htmlspecialchars($font_count) . '</td>';
        echo '<td>';
        echo '<a href="edit_group.php?group=' . urlencode(pathinfo($group, PATHINFO_FILENAME)) . '" class="text-primary me-3">Edit</a> ';
        echo '<a href="delete_group.php?group=' . urlencode(pathinfo($group, PATHINFO_FILENAME)) . '" class="text-danger"';
        echo 'onclick="return confirm(\'Are you sure you want to delete the font group ' . htmlspecialchars($group_name) . '?\')">Delete</a>';
        echo '</td>';
        echo '</tr>';

        // Increment the example counter
        $example_counter++;
    }
}

echo '</tbody>';
echo '</table>';
echo '</div>';

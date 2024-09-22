<?php
$group_name = $_GET['group']; // Get the group name from the query parameter
$dir = 'groups'; // Directory where font groups are stored
$group_file = "$dir/$group_name.json"; // JSON file for the group

// Read the JSON file content
$fonts = json_decode(file_get_contents($group_file), true);

// Ensure $fonts is an array; if not, set it to an empty array to avoid errors
if (!is_array($fonts)) {
    $fonts = [];
}

// Get all available fonts from the 'uploads' directory
$available_fonts = scandir('uploads');

// Filter out non-TTF files
$available_fonts = array_filter($available_fonts, function($file) {
    return pathinfo($file, PATHINFO_EXTENSION) == 'ttf';
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Font Group</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Font Group: <?php echo htmlspecialchars($group_name); ?></h2>
        <form id="editFontGroupForm" action="update_group.php" method="post">
            <input type="hidden" name="group_name" value="<?php echo htmlspecialchars($group_name); ?>">

            <div class="mb-3">
                <label for="fonts" class="form-label">Select Fonts</label>
                <select id="fonts" name="fonts[]" multiple class="form-select" size="3">
                    <?php foreach ($available_fonts as $font): ?>
                        <option value="<?php echo htmlspecialchars($font); ?>" 
                        <?php echo in_array($font, $fonts) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($font); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Group</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Prevent submission if less than two fonts are selected
            $('#editFontGroupForm').submit(function(e) {
                var selectedFonts = $('#fonts').val();
                if (selectedFonts.length < 2) {
                    alert("You must select at least two fonts.");
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>

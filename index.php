<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Font Group System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: uploadedFont;
            src: url('./uploads/example.ttf');
            /* Placeholder */
        }

        .preview {
            font-family: uploadedFont;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body class="bg-light p-5">
    <div class="container">
        <?php
        session_start(); // Start the session
        ?>

        <h1 class="mb-5">Font Group System</h1>
        <?php
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
            echo htmlspecialchars($_SESSION['success']);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';

            // Clear the message after displaying it
            unset($_SESSION['success']);
        }
        ?>

        <!-- Font Upload Form -->
        <div class="mb-5">
            <h2>Upload Font (TTF only)</h2>
            <input type="file" id="fontUpload" accept=".ttf" class="form-control mt-3">
            <div id="fontList" class="mt-3">
                <!-- Uploaded font list will appear here -->
            </div>
        </div>

        <!-- Create Font Group -->
        <div class="mb-5">
            <h2>Create Font Group</h2>
            <p>You have to select at least two fonts</p>
            <form id="fontGroupForm">
                <div id="fontGroupFields">
                    <div class="font-group-row d-flex mb-2">
                        <select class="font-select form-select">
                            <!-- Options dynamically generated -->
                        </select>
                        <button type="button" class="btn btn-primary ms-2" id="addRow">Add Row</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">Create Group</button>
            </form>
        </div>

        <!-- List of Font Groups -->
        <div>
            <div id="fontGroupList" class="mt-3">
                <!-- Font group list will appear here -->
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
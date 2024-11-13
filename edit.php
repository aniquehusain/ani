<?php
// Include database connection
require_once 'movieconnect.php';

// Initialize variables
$error = "111";
$success = "101";

// Check if ID is set and valid
if (!isset($_GET['movie_id']) || empty($_GET['movie_id'])) {
    die("Error: ID not specified.");
}

$id = $_GET['movie_id'];

// Fetch movie details
$sql = "SELECT * FROM addmovie WHERE movie_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();

// Check if movie exists
if (!$movie) {
    die("Error: Movie not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $year = $_POST['year'];
    $director = $_POST['director'];
    $description = $_POST['description'];

    // Validation
    if (empty($name) || empty($year) || empty($director) || empty($description)) {
        $error = "All fields are required. Please fill out all fields.";
    } elseif (!is_numeric($year) || strlen($year) != 4) {
        $error = "Year must be a 4-digit number.";
    } else {
        // Update movie details in the database
        $sql = "UPDATE `addmovie` SET `name` = ?, `year` = ?, `director` = ?, `description` = ? WHERE `movie_id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisii", $name, $year, $director, $description, $id);

        if ($stmt->execute()) {
            $success = "Movie updated successfully!";
        } else {
            $error = "Failed to update movie.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <style>
        body {
            background-color: #121212;
            color: #FFD700;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #000000;
            color: #FFD700;
            padding: 30px;
            border-radius: 8px;
            margin-top: 50px;
            max-width: 600px;
        }
        .form-label {
            color: #FFD700;
        }
        .btn-primary, .btn-secondary {
            background-color: #FFD700;
            border-color: #FFD700;
        }
        .btn-primary:hover, .btn-secondary:hover {
            background-color: #FFC107;
            border-color: #FFC107;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Edit Movie</h2>

    <!-- Success and Error Messages -->
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <!-- Edit Form -->
    <form method="POST" action="edit.php?id=<?php echo $id; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Movie Title</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($movie['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" class="form-control" id="year" name="year" value="<?php echo htmlspecialchars($movie['year']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="director" class="form-label">Director</label>
            <input type="text" class="form-control" id="director" name="director" value="<?php echo htmlspecialchars($movie['director']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($movie['description']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Movie</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

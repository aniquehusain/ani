<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieRulez</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Header Section -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="logo.png" alt="MovieRulez Logo"> <!-- Replace with the path to your logo -->    
        </a>
        <form class="d-flex mx-auto" role="search">
            <input class="form-control me-2" type="search" placeholder="Search for a movie..." aria-label="Search">
            <button class="btn btn-outline-warning" type="submit">Search</button>
        </form>
        <button class="btn btn-warning ms-auto" type="button"><a href = "addmovie.php">Add Movie</a></button>
    </div>
</nav>
<div class="modal fade" id="movieDetailsModal" tabindex="-1" aria-labelledby="movieDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="movieDetailsModalLabel">Movie Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="movieDetailsContent">
                <!-- Content will be loaded here with AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Main Content Section -->
<?php
include 'movieclass.php';
include 'movieconnect.php';
$film=new movie($conn);
$film->displayMovie();
?>
<!-- Footer Section -->
<div class="footer">
    <p>&copy; 2024 MovieRulez. All rights reserved.</p>
</div>

<!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

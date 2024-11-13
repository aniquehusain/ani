<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieRulez - Movie List</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <style>
        body {
            background-color: #121212;
            color: #FFD700;
        }
        .modal-content {
            background-color: #000000;
            color: #FFD700;
        }
    </style>
</head>
<body>

<!-- Movie List Table (Your existing content) -->
<<?php	
	include 'movieconnect.php';
	$sql = "SELECT * from addmovie";
	$result = mysqli_query($conn,$sql);
	$moviesArr = [];
	while($row = mysqli_fetch_assoc($result)) {
	$moviesArr[] = $row;
	}
if (is_array($moviesArr) && count($moviesArr) > 0) { ?>
<div class="container mt-4">
    <div class="movie-table">
        <h2 class="text-center mt-3">Movie List</h2>
        <table class="table table-dark table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Year</th>
                    <th scope="col">Director</th>
                    <th scope="col">Description</th>
					<th scope="col">Action</th>
                </tr>
            </thead>
			<?php
	   foreach ($moviesArr as $movie) { ?> 
            <tbody>
                <tr>
                    <td><?php echo $movie['name'] ?> </td>
                    <td><?php echo $movie['year'] ?></td>
                    <td><?php echo $movie['director'] ?></td>
                    <td><?php echo $movie['description'] ?></td>
					<td><button class="btn btn-warning" onclick="window.location.href = 'edit.php'">EDIT</button>
						<button class="btn btn-warning" onclick="showDetails(1)">Details</button>
						<button class="btn btn-warning">Delete</button></td>
                </tr>
				 <?php
	   }
	   ?>
            </tbody>
        </table>
		<?php
  }
?>
    </div>
</div>

<!-- Movie Details Modal -->
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

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>
function showDetails(movie_id) {
    const modalContent = document.getElementById('movieDetailsContent');
    modalContent.innerHTML = '<p>Loading...</p>'; // Display loading message

    // Fetch the movie details using AJAX
    fetch(`details.php?movie_id=${movie_id}`)
        .then(response => response.text())
        .then(data => {
            modalContent.innerHTML = data; // Load the fetched content into modal
            const myModal = new bootstrap.Modal(document.getElementById('movieDetailsModal'));
            myModal.show();
        })
        .catch(error => {
            modalContent.innerHTML = '<p>Error loading details.</p>';
            console.error("Error fetching details:", error);
        });
}
</script>

</body>
</html>

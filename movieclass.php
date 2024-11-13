<?php 
    require 'movieconnect.php';
    require_once 'index.php';

    //class movie
    class movie{


        //addmovie function 
        function addMovie(){
            if(isset($_POST['submit']) && $_POST['submit']){
                $name=$_POST['name'];
                $director=$_POST['director'];
                $year=$_POST['year'];
                $description=$_POST['description'];
                $url=$_POST['poster_link'];
                $sql = "INSERT INTO addmovie( 'poster_link', 'title', 'year', 'director', 'description') VALUES ('$url','$name','$director','$year','$description')";
                $result = mysqli_query($conn,$sql);
            }
        }

        //display movie function
        function displayMovie(){
            require 'movieconnect.php';
            $sql = "SELECT * from addmovie";
            $result = mysqli_query($conn,$sql);
            $moviesarr = [];
            while($row = mysqli_fetch_assoc($result)){
                $moviesarr[]= $row;
            }
        
            if(is_array($moviesarr)&& count($moviesarr)>0){?>
            <!doctype html>
                                                <html lang="en">
                                                <head>
                                                <meta charset="utf-8">
                                                <meta name="viewport" content="width=device-width, initial-scale=1">
                                                <title>ADD MOVIE</title>
                                                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                                                </head>
  <body>
  <table class="table table-bordered border-primary">
                <tr>
                    <th scope="col"><td>title</td></th>
                    <th scope="col"><td>poster</td></th>
                    <th scope="col"><td>year</td></th>
                    <th scope="col"><td>director</td></th>
                    
                </tr>
                    <?php 
                    foreach ($moviesarr as $movies){?>
                <tr>
                    <td><?php echo $movies['movie_id'] ?></td>
                    <td><?php echo $movies['name'] ?></td>
                    <td><?php echo $movies['poster_link'] ?></td>
                    <td><?php echo $movies['year'] ?></td>
                    <td><?php echo $movies['director'] ?></td>
                </tr>
                <?php } ?>
</table>
</html>
            <?php } 
        }
    }       ?>
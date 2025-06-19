<?php 
include("connect.php");

// Check if form is submitted, otherwise reset search variables
$movie_search = '';
$theater_name = '';

$catid = '';
if (isset($_POST['btnSearch'])) {
    $movie_search = $_POST['movie_search'];
    $theater_name = $_POST['theater_name'];
    $catid = $_POST['catid'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Hall System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section id="team" class="team section light-background">
    <div class="container section-title" data-aos="fade-up">

    </div>

    <form action="index.php" method="post">
        <div class="row">
        <div class="col-lg-3 col-md-6 d-flex">
                <div class="form-group">
                    <input type="text" class="form-control" name="movie_search" placeholder="Search the movies" value="<?= $movie_search ?>">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex">
                <div class="form-group">
                    <input type="text" class="form-control" name="theater_name" placeholder="Search the theater" value="<?= $theater_name ?>">
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex">
                <div class="form-group">
                    <select name="catid" class="form-control">
                        <option value="">Select category</option>
                        <?php 
                        $sql = 'SELECT * FROM `category`';
                        $res = mysqli_query($con, $sql);
                        if(mysqli_num_rows($res) > 0){
                            while($data = mysqli_fetch_array($res)){
                                ?> 
                                <option value="<?= $data['catid'] ?>" <?= $catid == $data['catid'] ? 'selected' : '' ?>> <?= $data['catname'] ?></option>
                                <?php
                            }
                        } else {
                            ?> <option value="">No Category Found</option> <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex">
                <div class="form-group">
                    <input type="submit" name="btnSearch" value="Search" class="btn btn-primary">
                </div>
            </div>
        </div>
    </form>
    <div class="containers display">
    <a href="index.php" class="showing">Now Showing</a> 
    </div>
    <br> <br> <br>
    <div class="container movie-grid">
        <?php
        if(isset($_POST['btnSearch'])) {
            // Search logic
            $sql = "SELECT movies.*, category.catname FROM movies 
                    INNER JOIN category ON category.catid = movies.catid
                    WHERE movies.title LIKE '%$movie_search%' 
                    AND movies.catid = '$catid'";
        } else {
            // Default logic to show all movies
            $sql = "SELECT movies.*, category.catname FROM movies 
                    INNER JOIN category ON category.catid = movies.catid 
                    ORDER BY movies.movieid DESC";
        }

        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) > 0) {
            while($data = mysqli_fetch_array($res)) {
                ?>
            <a href="movie_details.php?movieid=<?= $data['movieid'] ?>" class="movie-container-link">

                <div class="team-member">
                    <div class="member-img">
                        <img src="admin/uploads/<?= $data['image'] ?>" class="img-fluid" alt="<?= $data['title'] ?>">
                        <a href="play_video.php?file=<?= $data['trailer'] ?>" target="_blank" class="watch-trailer-btn"> Watch Trailer </a>
                        <div class="member-info">
                            <h4><?= $data['title'] ?></h4>
                            <span><?= $data['catname'] ?></span>
                        </div>
                    </div>
                </div>
            </a>
                <?php
            }
        } else {
            echo "<p>No movies available.</p>";
        }
        ?>
    </div>
</section>

</body>
</html>

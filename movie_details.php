<?php
include("connect.php");

if (isset($_GET['movieid'])) {
    $movieid = $_GET['movieid'];

    // Fetch the movie details using the movieid
    $sql = "SELECT movies.*, category.catname FROM movies 
            INNER JOIN category ON category.catid = movies.catid
            WHERE movies.movieid = '$movieid'";
    $res = mysqli_query($con, $sql);

    if (mysqli_num_rows($res) > 0) {
        $movie = mysqli_fetch_array($res);
    } else {
        echo "Movie not found.";
        exit;
    }
} else {
    echo "Invalid movie ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $movie['title'] ?></title>
    <link rel="stylesheet" href="css/movieDetails.css">
</head>
<body>
    <?php include("header.php"); ?>
    
    <section id="movie-details">
        <div class="movie-details-container">
            <div class="movie-image">
                <img src="admin/uploads/<?= $movie['image'] ?>" alt="<?= $movie['title'] ?>" />
            </div>
            <div class="movie-info">
                <h1><?= $movie['title'] ?></h1>
                <p><strong>Category:</strong> <?= $movie['catname'] ?></p>
                <p><strong>Description:</strong> <?= $movie['description'] ?></p>
                <p><strong>Rating:</strong> <?= $movie['rating'] ?></p>
                <div class="movie-actions">
                    <a href="booking.php?id=<?= $movie['movieid'] ?>" class="btn btn-primary">Book Tickets</a>
                    <a href="play_video.php?file=<?= $movie['trailer'] ?>" target="_blank" class="btn btn-secondary">Watch Trailer</a>
                </div>
            </div>
        </div>
    </section>

    <?php include("footer.php"); ?>
</body>
</html>

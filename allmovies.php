<?php 
include("connect.php");

// Check if form is submitted, otherwise reset search variables
$movie_search = '';
$catid = '';
if (isset($_POST['btnSearch'])) {
    $movie_search = $_POST['movie_search'];
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
    <div class="container123 section-title" data-aos="fade-up">
        <h4>Holloywood <span>Movies</span></h4>
    </div>

    <div class="container movie-grid">
        <?php
            // Default logic to show all movies
            $sql = "SELECT movies.*, category.catname FROM movies 
                    INNER JOIN category ON category.catid = movies.catid 
                    where movies.catid=1
                    ORDER BY movies.movieid DESC";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) > 0) {
            while($data = mysqli_fetch_array($res)) {
                ?>
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
                <?php
            }
        } else {
            echo "<p>No movies available.</p>";
        }
        ?>
    </div>

    <div class="container123 section-title" data-aos="fade-up">
        <h4>Bollywood <span>Movies</span></h4>
    </div>

    <div class="container movie-grid">
        <?php
            // Default logic to show all movies
            $sql = "SELECT movies.*, category.catname FROM movies 
                    INNER JOIN category ON category.catid = movies.catid 
                    where movies.catid=2
                    ORDER BY movies.movieid DESC";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) > 0) {
            while($data = mysqli_fetch_array($res)) {
                ?>
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
                <?php
            }
        } else {
            echo "<p>No movies available.</p>";
        }
        ?>
    </div>

    <div class="container123 section-title" data-aos="fade-up">
        <h4>Kollywood <span>Movies</span></h4>
    </div>

    <div class="container movie-grid">
        <?php
            // Default logic to show all movies
            $sql = "SELECT movies.*, category.catname FROM movies 
                    INNER JOIN category ON category.catid = movies.catid 
                    where movies.catid=3
                    ORDER BY movies.movieid DESC";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) > 0) {
            while($data = mysqli_fetch_array($res)) {
                ?>
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
                <?php
            }
        } else {
            echo "<p>No movies available.</p>";
        }
        ?>
    </div>

    <div class="container123 section-title" data-aos="fade-up">
        <h4>Tollywood <span>Movies</span></h4>
    </div>

    <div class="container movie-grid">
        <?php
            // Default logic to show all movies
            $sql = "SELECT movies.*, category.catname FROM movies 
                    INNER JOIN category ON category.catid = movies.catid 
                    where movies.catid=4
                    ORDER BY movies.movieid DESC";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) > 0) {
            while($data = mysqli_fetch_array($res)) {
                ?>
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

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
    <link rel="stylesheet" href="css/theater.css">
</head>
<body>

<section id="team" class="team section light-background">
    <div class="container123 section-title" data-aos="fade-up">
        <h4>Our <span>Theater</span></h4>
    </div>

    <div class="container movie-grid">
        <?php
            // Default logic to show all movies
            $sql = "select theater.*,movies.*, category.catname 
                    from theater
                    INNER JOIN movies on movies.movieid=theater.movieid
                    INNER JOIN category on category.catid=movies.catid
                    order by theater.theaterid DESC";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) > 0) {
            while($data = mysqli_fetch_array($res)) {
                ?>
                <div class="team-member">
                    <div class="member-img">
                        <img src="admin/uploads/<?= $data['image'] ?>" class="img-fluid" alt="<?= $data['title'] ?>">
                        <a href="play_video.php?file=<?= $data['trailer'] ?>" target="_blank" class="watch-trailer-btn"> Watch Trailer </a>
                        <div class="member-info">
                            <h2><?= $data['theater_name'] ?></h2>
                            <h4><?= $data['title'] ?> - <span><?= $data['catname'] ?></span></h4>
        
                            <!-- Show all available timings -->
                            <p>
                                <?php
                                $timingFields = ['timing', 'timing2', 'timing3', 'timing4'];
                                foreach ($timingFields as $field) {
                                    if (!empty($data[$field])) {
                                        echo '<span class="timing-pill">' . htmlspecialchars($data[$field]) . '</span> ';
                                    }
                                }
                                ?>
                            </p>
        
                            <p><?= $data['days'] ?></p>
                            <p><?= $data['date'] ?></p>
                            <p><?= $data['location'] ?></p>
                            <h3>Price Per Ticket: <?= $data['price'] ?></h3> <br>
                            <a href="booking.php?id=<?= $data['theaterid'] ?>" class="btn btn-primary"> Book Now</a>
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

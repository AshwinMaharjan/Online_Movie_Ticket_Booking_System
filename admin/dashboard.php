<?php 
    include("connect.php");
    if(!isset($_SESSION['uid'])){
        echo "<script> window.location.href='login.php'; </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Hall System</title>
    <link rel="stylesheet" href="../css/admin_dashboard.css">
</head>
<body>

    <?php include("header.php") ?>
    <br><br>
    <h3>Welcome to the Admin Dashboard</h3>

<div class="container">
    <div class="row">
        <div class="col-lg-4 mb-2">
            <a href="categories.php">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <h2>CATEGORIES</h2>
                            <?php
                                $sql = "SELECT count(catid) as 'Category' FROM `category`";
                                $res = mysqli_query($con, $sql);
                                $catdata = mysqli_fetch_array($res);
                            ?>
                            <h3><?=$catdata['Category']?></h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-lg-4 mb-2">
            <a href="movies.php">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <h2>MOVIES</h2>
                            <?php
                                $sql = "SELECT count(movieid) as 'Movies' FROM `movies`";
                                $res = mysqli_query($con, $sql);
                                $moviedata = mysqli_fetch_array($res);
                            ?>
                            <h3><?=$moviedata['Movies']?></h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 mb-2">
            <a href="viewallbooking.php">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <h2>BOOKING</h2>
                            <?php
                                $sql = "SELECT count(bookingid) as 'Booking' FROM `booking`";
                                $res = mysqli_query($con, $sql);
                                $bookingdata = mysqli_fetch_array($res);
                            ?>
                            <h3><?=$bookingdata['Booking']?></h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4 mb-2">
            <a href="theater.php">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <h2>THEATER</h2>
                            <?php
                                $sql = "SELECT count(theaterid) as 'Theater' FROM `theater`";
                                $res = mysqli_query($con, $sql);
                                $theaterdata = mysqli_fetch_array($res);
                            ?>
                            <h3><?=$theaterdata['Theater']?></h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-2">
            <a href="revenue.php">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <h2>REVENUE</h2>
                            <h4>See the total revenue</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 mb-2">
            <a href="viewallusers.php">
                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <h2>USERS</h2>
                            <?php
                                $sql = "SELECT count(userid) as 'Users' FROM `users` where roteype=2";
                                $res = mysqli_query($con, $sql);
                                $userdata = mysqli_fetch_array($res);
                            ?>
                            <h3><?=$userdata['Users']?></h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

    <?php include("footer.php") ?>

</body>
</html>

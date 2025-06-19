<?php 
include("connect.php");

if(!isset($_SESSION['uid'])){
    echo "<script>window.location.href='login.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="css/userbooking.css">
</head>
<body>
<?php include ("header.php")?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <table class="table">
                <tr>
                    <th>#</th>    
                    <th>Theater Name</th>    
                    <th>Movie</th>    
                    <th>Date</th>    
                    <th>Time/Days</th>    
                    <th>Ticket</th>    
                    <th>Location</th>    
                    <th>Seats</th>    
                    <th>Status</th>    
                </tr>

                <?php
                $uid = $_SESSION['uid'];
                // Fetching bookings related to the logged-in user
                $sql = "SELECT booking.bookingid, booking.booking_date, booking.person,
                        theater.theater_name, theater.timing, theater.days, theater.price, theater.location, 
                        movies.title, category.catname, users.name as 'Username', booking.status, booking.seats
                        FROM booking
                        INNER JOIN theater ON theater.theaterid = booking.theaterid
                        INNER JOIN users ON users.userid = booking.userid
                        INNER JOIN movies ON movies.movieid = theater.movieid
                        INNER JOIN category ON category.catid = movies.catid
                        WHERE booking.userid = '$uid' order by bookingid DESC";  // User-specific bookings
                $res = mysqli_query($con, $sql);

                if(mysqli_num_rows($res) > 0){
                    while($data = mysqli_fetch_array($res)){
                ?>
                <tr>
                    <td><?= $data['bookingid'] ?></td>
                    <td><?= $data['theater_name'] ?></td>
                    <td><?= $data['title'] ?> - <?= $data['catname'] ?></td>
                    <td><?= $data['booking_date'] ?></td>
                    <td><?= $data['timing'] ?> - <?= $data['days'] ?></td>
                    <td><?= $data['price'] ?></td>
                    <td><?= $data['location'] ?></td>
                    <td><?= $data['seats'] ?></td>
                    <td>
                        <?php 
                        // Show status as 'Pending' or 'Approved' depending on booking status
                        if($data['status'] == 0){
                            echo "<a href='#' class='btn btn-third'> Pending</a>";
                        } else {
                            echo "<a href='ticket.php?bookingid=" . $data['bookingid'] . "' class='btn btn-secondary'> View Ticket</a>";
                        }
                        ?>
                    </td>
                </tr>      
                <?php
                    }
                } else {
                    echo "<tr><td colspan='8'>No Bookings Found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php include ("footer.php") ?>
</body>
</html>

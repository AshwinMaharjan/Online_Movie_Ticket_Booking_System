<?php 
include("connect.php");

// Ensure the user is logged in
if (!isset($_SESSION['uid'])) {
    echo "<script>window.location.href='../login.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revenue Report</title>
    <link rel="stylesheet" href="../css/view_all_booking.css">
</head>
<body>
<?php include("header.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Total Revenue Report</h2>
            <table class="table">
                <tr>
                    <th>#</th>    
                    <th>Movie Name</th>    
                    <th>Booking Date</th>    
                    <th>Time/Days</th>        
                    <th>Location</th>    
                    <th>User</th>    
                    <th>Ticket Price</th>    
                    <th>No. of People</th>    
                    <th>Total Price</th>  
                    <th>Status</th>    
                    <th>Action</th> 
                </tr>

                <?php
                // Fetch booking and revenue data
                $sql = "SELECT booking.bookingid, booking.booking_date, booking.person,
                            theater.theater_name, theater.timing, theater.days, theater.price, theater.location, 
                            movies.title, category.catname, users.name AS 'Username', booking.status,
                            (theater.price * booking.person) AS total_price
                        FROM booking
                        INNER JOIN theater ON theater.theaterid = booking.theaterid
                        INNER JOIN users ON users.userid = booking.userid
                        INNER JOIN movies ON movies.movieid = theater.movieid
                        INNER JOIN category ON category.catid = movies.catid";

                $res = mysqli_query($con, $sql);
                $totalRevenue = 0; // Initialize total revenue

                if (mysqli_num_rows($res) > 0) {
                    while ($data = mysqli_fetch_array($res)) {
                        // Only add to total revenue if booking is approved
                        if ($data['status'] == 1) {
                            $totalRevenue += $data['total_price'];
                        }
                ?>
                <tr>
                    <td><?= $data['bookingid'] ?></td>
                    <td><?= $data['title'] ?> - <?= $data['catname'] ?></td>
                    <td><?= $data['booking_date'] ?></td>
                    <td><?= $data['timing'] ?> - <?= $data['days'] ?></td>
                    <td><?= $data['location'] ?></td>
                    <td><?= $data['Username'] ?></td>
                    <td><?= $data['price'] ?></td>
                    <td><?= $data['person'] ?></td>
                    <td>
                        <?php 
                        if ($data['status'] == 1) {
                            echo $data['total_price'];
                        } else {
                            echo "-"; // Display "-" if status is pending
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if ($data['status'] == 0) {
                            echo "<span class='btn btn-light'> Pending</span>";
                        } else {
                            echo "<span class='btn btn-secondary'> Approved</span>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if ($data['status'] == 1) {
                            echo "<button type='button' class='btn btn-light' disabled> Completed</button>";
                        } else {
                            echo "<a href='revenue.php?bookingid=" . $data['bookingid'] . "' class='btn btn-secondary'> Approve</a>";
                        }
                        ?>
                    </td>
                </tr>      
                <?php
                    }
                } else {
                    echo "<tr><td colspan='11'>No Booking Found</td></tr>";
                }
                ?>

                <!-- Row to display total revenue -->
                <tr>
                    <td colspan="8" style="text-align: right;"><strong>Total Revenue:</strong></td>
                    <td><strong><?= $totalRevenue ?></strong></td>
                    <td colspan="2"></td>
                </tr>
                
            </table>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>

<?php
// Approve booking action
if (isset($_GET['bookingid'])) {
    $bookingid = $_GET['bookingid'];
    $sql = "UPDATE `booking` SET `status` = 1 WHERE bookingid='$bookingid'";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Booking Approved Successfully!')</script>";
        echo "<script>window.location.href='revenue.php'; </script>";
    } else {
        echo "<script>alert('Booking Not Approved!')</script>";
    }
}
?>

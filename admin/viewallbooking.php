<?php 
include("connect.php");

if(!isset($_SESSION['uid'])){
    echo "<script>window.location.href='../login.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="../css/view_all_booking.css">
</head>
<body>
<?php include ("header.php")?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <table class="table">
                <tr>
                    <th>#</th>    
                    <th>Name</th>    
                    <th>Category</th>    
                    <th>Date</th>    
                    <th>Time/Days</th>    
                    <th>Ticket</th>    
                    <th>Location</th>    
                    <th>User</th>    
                    <th>Seats</th>    
                    <th>Status</th>    
                    <th>Action</th>    
                </tr>

                <?php
                $sql = "SELECT booking.bookingid, booking.booking_date, booking.seats, booking.person, theater.theater_name, theater.timing, theater.days, theater.price, theater.location, movies.title, category.catname, users.name as 'Username', booking.status FROM booking
                INNER JOIN theater ON theater.theaterid = booking.theaterid
                INNER JOIN users ON users.userid = booking.userid
                INNER JOIN movies ON movies.movieid = theater.movieid
                INNER JOIN category ON category.catid = movies.catid order by bookingid DESC";
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
                    <td><?= $data['Username'] ?></td>
                    <td><?= $data['seats'] ?></td>
                    <td>
                        <?php 
                        if($data['status'] == 0){
                            echo "<a href='#' class='btn btn-third'> Pending</a>";
                        } else {
                            echo "<a href='#' class='btn btn-secondary'> Approved</a>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if($data['status'] == 1){
                            echo "<button type='button' class='btn btn-light' disabled> Completed</button>";
                        } else {
                            echo "<a href='viewallbooking.php?bookingid=" . $data['bookingid'] . "' class='btn btn-secondary'> Approve</a>";
                        }
                        ?>
                    </td>
                </tr>      
                <?php
                    }
                } else {
                    echo "<tr><td colspan='10'>No Booking Found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php include ("footer.php") ?>
</body>
</html>

<?php
    if(isset($_GET['bookingid'])){
        $bookingid = $_GET['bookingid'];
        $sql="UPDATE `booking` SET `status` = 1 where bookingid='$bookingid'";

        if(mysqli_query($con,$sql)){
            echo "<script>alert('Booking Approved Successfully!')</script>";
            echo "<script>window.location.href='viewallbooking.php'; </script>";
        } else {
            echo "<script>alert('Booking Not Approved!')</script>";
        }
    }
?>

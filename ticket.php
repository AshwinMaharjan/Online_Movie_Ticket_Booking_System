<?php
include("connect.php");
require_once('lib/phpqrcode/qrlib.php');

$bookingid = $_GET['bookingid'];
$qrDir = 'qr/';
$qrFile = $qrDir . 'qr_' . $bookingid . '.png';

// Create the folder if it doesn't exist
if (!file_exists($qrDir)) {
    mkdir($qrDir, 0777, true);
}

// Generate QR code only if it doesn't already exist
if (!file_exists($qrFile)) {
    QRcode::png('Yes, confirmed ticket', 'qr/qr_' . $bookingid . '.png', 0, 4);
}

if (!isset($_SESSION['uid'])) {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

if (!isset($_GET['bookingid'])) {
    echo "<script>alert('Invalid access.'); window.location.href='booking.php';</script>";
    exit();
}

$bookingid = $_GET['bookingid'];
$uid = $_SESSION['uid'];

// Fetch booking details including movie image
$sql = "SELECT booking.*, theater.theater_name, theater.timing, theater.days, theater.price, 
               theater.location, movies.title, movies.image, category.catname, users.name as username
        FROM booking
        INNER JOIN theater ON theater.theaterid = booking.theaterid
        INNER JOIN users ON users.userid = booking.userid
        INNER JOIN movies ON movies.movieid = theater.movieid
        INNER JOIN category ON category.catid = movies.catid
        WHERE booking.bookingid = '$bookingid' AND booking.userid = '$uid' AND booking.status = 1";

$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) != 1) {
    echo "<script>alert('Ticket not found or not approved.'); window.location.href='booking.php';</script>";
    exit();
}

$data = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Ticket</title>
    <link rel="stylesheet" href="css/ticket.css">
</head>
<body>

<?php include("header.php"); ?>
    
<div class="ticket">
    <h2><?= $data['theater_name'] ?></h2>
    <h3><?= $data['location'] ?></h3>

    <div class="ticket-content">
        <!-- Left: Movie Poster -->
        <div class="ticket-image">
            <img src="admin/uploads/<?= $data['image'] ?>" alt="Movie Poster" class="poster">
        </div>

        <!-- Right: Ticket Details -->
        <div class="ticket-info">
            <p><strong>Name:</strong> <?= $data['username'] ?></p>
            <p><strong>Movie:</strong> <?= $data['title'] ?> (<?= $data['catname'] ?>)</p>
            <p><strong>Date:</strong> <?= $data['booking_date'] ?></p>
            <p><strong>Time:</strong> <?= $data['timing'] ?> (<?= $data['days'] ?>)</p>
            <img src="<?= $qrFile ?>" alt="QR Code" width="150" height="150">

        </div>
    </div>

    <hr>

    <div class="details">
        <p><strong>Number of Seats:</strong> <?= $data['seats'] ?></p>
        <p><strong>Ticket Price:</strong> Rs. <?= $data['price'] ?></p>
        <p><strong>Total:</strong> Rs. <?= ($data['person'] * $data['price']) ?></p>

        <hr>

        <p><strong>Important Instructions</strong></p>
        <p>All sales are final, no refund or exchange possible.</p>
        <p>For 3D only: all glasses must be returned after the show. Rs. 200 fine for damage or lost glasses.</p>
        <p>Keep ticket until the end of the show.Please follow internal rules of the theatre.Please check the time and date of the show.</p>
        <p>Enjoy your movie experience!</p>

        <hr>

        <p><strong>Transaction Details</strong></p>
        <p><?= $data['booking_date'] ?> | <?= $data['timing'] ?> (<?= $data['days'] ?>)</p>

        <p><strong>Payment Method:</strong> Online</p>
        <div class="print-button">
            <button onclick="window.print()">Print Ticket</button>
        </div>

    </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
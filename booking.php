<?php
include("connect.php");

// Redirect if user is not logged in
if (!isset($_SESSION['uid'])) {
    echo "<script>window.location.href='login.php'</script>";
    exit;
}

$theaterid = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$theaterid) {
    echo "<script>alert('Invalid Theater ID!'); window.location.href='booking.php?id={$theaterid_post}&timing=" . urlencode($timing_post) . "';</script>";
    exit;
}

$theater = null;
$movie = null;
$movie_image = '';
$booked_seats = [];

// Get selected timing from URL param or default to first timing
$selected_timing = isset($_GET['timing']) ? $_GET['timing'] : '';

// Fetch theater info
$stmt = $con->prepare("SELECT * FROM theater WHERE theaterid = ?");
$stmt->bind_param("i", $theaterid);
$stmt->execute();
$result = $stmt->get_result();
$theater = $result->fetch_assoc();
$stmt->close();

if (!$theater) {
    echo "<script>alert('Theater not found!'); window.location.href='booking.php?id={$theaterid_post}&timing=" . urlencode($timing_post) . "';</script>";
    exit;
}

// Get movie info
$movieid = $theater['movieid'] ?? 0;
if ($movieid) {
    $stmt = $con->prepare("SELECT * FROM movies WHERE movieid = ?");
    $stmt->bind_param("i", $movieid);
    $stmt->execute();
    $result = $stmt->get_result();
    $movie = $result->fetch_assoc();
    $stmt->close();

    $movie_image = $movie['image'] ?? '';
}

// Get booking date from theater
$booking_date = $theater['date'] ?? '';

// If no timing selected, use first non-empty timing field from theater
if (!$selected_timing) {
    $timingFields = ['timing', 'timing2', 'timing3', 'timing4'];
    foreach ($timingFields as $field) {
        if (!empty($theater[$field])) {
            $selected_timing = $theater[$field];
            break;
        }
    }
}

// Fetch booked seats for the selected theater, date, and timing
if ($booking_date && $selected_timing) {
    $stmt = $con->prepare("SELECT seats FROM booking WHERE theaterid = ? AND booking_date = ? AND timing = ?");
    $stmt->bind_param("iss", $theaterid, $booking_date, $selected_timing);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $seatsArray = explode(',', $row['seats']);
        $booked_seats = array_merge($booked_seats, $seatsArray);
    }
    $stmt->close();
}

// Handle booking form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ticketbook'])) {
    $uid = $_SESSION['uid'];
    $theaterid_post = intval($_POST['theaterid']);
    $booking_date_post = $_POST['booking_date'];
    $timing_post = $_POST['timing'];
    $person = intval($_POST['person']);
    $seats = $_POST['seats'];

    $selected_seats = explode(',', str_replace(' ', '', $seats));

    if (count($selected_seats) !== $person) {
        echo "<script>alert('Number of selected seats (" . count($selected_seats) . ") must match number of people ($person).'); window.history.back();</script>";
        exit;
    }
    
    // Verify seats are not already booked for this timing
    $stmt = $con->prepare("SELECT seats FROM booking WHERE theaterid = ? AND booking_date = ? AND timing = ?");
    $stmt->bind_param("iss", $theaterid_post, $booking_date_post, $timing_post);
    $stmt->execute();
    $result = $stmt->get_result();

    $existing_booked = [];
    while ($row = $result->fetch_assoc()) {
        $existing_booked = array_merge($existing_booked, explode(',', $row['seats']));
    }
    $stmt->close();

    $already_booked = array_intersect($selected_seats, $existing_booked);
    if (!empty($already_booked)) {
        echo "<script>alert('The following seats are already taken: " . implode(', ', $already_booked) . "'); window.location.href='booking.php?id=$theaterid_post&timing=" . urlencode($timing_post) . "';</script>";
        exit;
    }

    // Insert booking
    $stmt = $con->prepare("INSERT INTO booking (theaterid, booking_date, timing, person, seats, userid) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issisi", $theaterid_post, $booking_date_post, $timing_post, $person, $seats, $uid);
    if ($stmt->execute()) {
        echo "<script>alert('Ticket Booked Successfully!'); window.location.href='booking.php?id={$theaterid_post}&timing=" . urlencode($timing_post) . "';</script>";
    } else {
        echo "<script>alert('Ticket Booking Failed!');</script>";
    }
    $stmt->close();
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Ticket Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/booking.css" />
    <style>
      /* Basic seat style */
      .seat { 
          display: inline-block; 
          width: 35px; height: 35px; 
          margin: 4px; 
          border-radius: 6px; 
          background-color: #b9d9ea; 
          cursor: pointer; 
          text-align: center; 
          line-height: 35px;
          user-select: none;
          font-weight: 600;
          color: #333;
      }
      .seat.booked {
          background-color: #e74c3c;
          cursor: not-allowed;
          color: #fff;
      }
      .seat.selected {
          background-color: #27ae60;
          color: #fff;
      }
      .screen-label {
          background-color: #333;
          color: #fff;
          font-weight: bold;
          padding: 6px 10px;
          margin-bottom: 10px;
          text-align: center;
          border-radius: 6px;
          user-select: none;
      }
      .seat-map {
          max-width: 380px;
          margin-top: 10px;
          border: 2px solid #333;
          padding: 10px;
          border-radius: 8px;
          background: #f4f6f7;
      }
    </style>
</head>
<body>

<?php include("header.php") ?>

<div class="container d-flex" style="padding: 20px;">
    <!-- Movie Poster -->
    <div style="flex: 1;">
        <?php if ($movie_image): ?>
            <img src="admin/uploads/<?= htmlspecialchars($movie_image) ?>" alt="<?= htmlspecialchars($movie['title']) ?>" style="width: 100%; max-width: 500px; border-radius: 10px;" />
        <?php else: ?>
            <p>No poster available</p>
        <?php endif; ?>

        <?php if (!empty($movie['description']) || !empty($movie['rating'])): ?>
            <div style="margin-top: 15px; padding: 15px; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <?php if (!empty($movie['description'])): ?>
                    <h3 style="color: black; margin-top: 0; font-size: 1.4em;">Description</h3>
                    <p style="font-size: 1em; color: black; line-height: 1.5;">
                        <?= nl2br(htmlspecialchars($movie['description'])) ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($movie['rating'])): ?>
                    <div style="margin-top: 10px;">
                        <strong style="font-size: 1.1em; color: black;">⭐ Rating:</strong>
                        <span style="color: black; font-size: 1.1em;"><?= htmlspecialchars($movie['rating']) ?>/10</span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Booking Form -->
    <div style="flex: 1; margin-left: 30px;">
        <form class="bookingForm" method="post" action="">
            <input type="hidden" name="theaterid" value="<?= htmlspecialchars($theaterid) ?>" />
            <input type="hidden" name="booking_date" value="<?= htmlspecialchars($booking_date) ?>" />
            
            <h2><?= htmlspecialchars($theater['theater_name'] ?? '') ?></h2>
            <p><strong>Date:</strong> <?= htmlspecialchars($booking_date) ?></p>
            
            <!-- Timing select -->
            <div>
                <label for="timing">Select Time:</label>
                <select name="timing" id="timing" class="form-control" required onchange="onTimingChange(this.value)">
                    <?php
                    $timingFields = ['timing', 'timing2', 'timing3', 'timing4'];
                    foreach ($timingFields as $field) {
                        if (!empty($theater[$field])) {
                            $value = $theater[$field];
                            $selected = ($value == $selected_timing) ? 'selected' : '';
                            echo "<option value=\"" . htmlspecialchars($value) . "\" $selected>" . htmlspecialchars($value) . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <p><strong>Days:</strong> <?= htmlspecialchars($theater['days'] ?? '') ?></p>
            <p><strong>Location:</strong> <?= htmlspecialchars($theater['location'] ?? '') ?></p>
            <p><strong>Price:</strong> <?= htmlspecialchars($theater['price'] ?? '') ?></p>

            <div>
                <label for="person">Number of People:</label>
                <input type="number" name="person" id="person" required class="form-control" min="1" />
            </div>

            <div>
                <label>Select Seats:</label>
                <div class="screen-label">SCREEN</div>
                <div id="seat-map" class="seat-map"></div>
                <input type="hidden" name="seats" id="selected-seats" required />
            </div>

            <div class="seat-legend" style="margin-top: 15px;">
                <div class="legend-item" style="display:inline-block; margin-right:15px;">
                    <div class="seat-box taken" style="width: 20px; height: 20px; background:#e74c3c; display:inline-block; border-radius:4px;"></div>
                    <span>Taken</span>
                </div>
                <div class="legend-item" style="display:inline-block;">
                    <div class="seat-box selected" style="width: 20px; height: 20px; background:#27ae60; display:inline-block; border-radius:4px;"></div>
                    <span>Selected</span>
                </div>
            </div>

            <button type="submit" name="ticketbook">Book Ticket</button>
        </form>
    </div>
</div>

<?php include("footer.php") ?>

<script>
function onTimingChange(timing) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('timing', timing);
    // Force hard reload to ensure PHP reruns
    window.location.href = window.location.pathname + '?' + urlParams.toString();
}
document.addEventListener("DOMContentLoaded", function () {
    const seatMap = document.getElementById("seat-map");
    const selectedSeatsInput = document.getElementById("selected-seats");
    const bookedSeats = <?= json_encode($booked_seats) ?>; // PHP will inject this
    const selectedSeats = new Set();

    const rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L']; // extend if needed
    const cols = 10;

    function toggleSeat(seat, seatId) {
        if (selectedSeats.has(seatId)) {
            selectedSeats.delete(seatId);
            seat.classList.remove("selected");
        } else {
            selectedSeats.add(seatId);
            seat.classList.add("selected");
        }
        selectedSeatsInput.value = Array.from(selectedSeats).join(',');
    }

    function renderSeats() {
        // Clear previous seats if any
        seatMap.innerHTML = '';

        rows.forEach(row => {
            for (let col = 1; col <= cols; col++) {
                const seatId = row + col;
                const seat = document.createElement("div");
                seat.classList.add("seat");
                seat.textContent = seatId;

                if (bookedSeats.includes(seatId)) {
                    seat.classList.add("booked");
                } else {
                    seat.addEventListener("click", () => toggleSeat(seat, seatId));
                }

                seatMap.appendChild(seat);
            }
        });
    }

    renderSeats();

    document.querySelector("form.bookingForm").addEventListener("submit", function (e) {
        const personCount = parseInt(document.getElementById("person").value, 10);
        const selectedSeatsList = Array.from(selectedSeats);

        if (selectedSeatsList.length !== personCount) {
            e.preventDefault();
            alert(`You selected ${selectedSeatsList.length} seat(s) but entered ${personCount} people. Please match the numbers.`);
        }
    });
});
</script>

</body>
</html>
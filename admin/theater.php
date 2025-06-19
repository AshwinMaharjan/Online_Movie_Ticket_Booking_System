<?php 
include("connect.php");

if(!isset($_SESSION['uid'])){
    echo "<script>window.location.href='../login.php'</script>";
}

$editData = null;
if(isset($_GET['editid'])){
    $editid = $_GET['editid'];
    
    $sql = "SELECT * FROM `theater` WHERE theaterid='$editid'";
    $res = mysqli_query($con, $sql);

    if(mysqli_num_rows($res) > 0){
        $editData = mysqli_fetch_array($res);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Theater</title>
    <link rel="stylesheet" href="../css/admin_theater.css" />
    <script>
    // Client-side validation function
    function validateForm() {
        let theaterName = document.forms["theaterForm"]["theater_name"].value.trim();
        let price = document.forms["theaterForm"]["price"].value.trim();
        let location = document.forms["theaterForm"]["location"].value.trim();
        let date = document.forms["theaterForm"]["date"].value;

        // Regex for alphabets and spaces only
        let alphaRegex = /^[A-Za-z\s]+$/;

        if (!alphaRegex.test(theaterName)) {
            alert("Theater name should only contain alphabets and spaces.");
            return false;
        }

        if (!alphaRegex.test(location)) {
            alert("Location should only contain alphabets and spaces.");
            return false;
        }

        if (price === "" || isNaN(price) || Number(price) < 0) {
            alert("Price should be a non-negative number.");
            return false;
        }

        if (!date) {
            alert("Please select a date.");
            return false;
        }

        let selectedDate = new Date(date);
        let today = new Date();
        today.setHours(0,0,0,0); // remove time part for comparison

        if (selectedDate < today) {
            alert("Date should not be in the past.");
            return false;
        }

        return true;
    }
    </script>
</head>
<body>
<?php include("header.php") ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <form name="theaterForm" action="theater.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-group mb-4">
                    <select name="movieid" class="form-control" required>
                        <option value="">Select Movie</option>
                        <?php
                            if ($editData) {
                                // If editing, include the current movie assigned to this theater
                                $sql = "SELECT * FROM `movies` 
                                        WHERE movieid NOT IN (SELECT movieid FROM `theater` WHERE movieid != '{$editData['movieid']}') 
                                        OR movieid = '{$editData['movieid']}'";
                            } else {
                                // If adding a new theater, exclude all movies already assigned
                                $sql = "SELECT * FROM `movies` 
                                        WHERE movieid NOT IN (SELECT movieid FROM `theater`)";
                            }
                        
                            $res = mysqli_query($con, $sql);

                            if(mysqli_num_rows($res) > 0){
                                while($data = mysqli_fetch_array($res)){
                        ?>
                        <option value="<?= $data['movieid'] ?>" 
                            <?= ($editData && $editData['movieid'] == $data['movieid']) ? "selected" : "" ?>>
                            <?= htmlspecialchars($data['title']) ?>
                        </option>
                        <?php
                                }
                            } else {
                                echo '<option value="">No Movies Found</option>';
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <input type="text" class="form-control" value="<?= $editData['theater_name'] ?? '' ?>" name="theater_name" placeholder="Enter the theater name" required>
                </div>

                <div class="form-group mb-4">
                    <input type="time" class="form-control" value="<?= $editData['timing'] ?? '' ?>" name="timing" required>
                </div>

                <div class="form-group mb-4">
                    <input type="time" class="form-control" value="<?= $editData['timing2'] ?? '' ?>" name="timing2">
                </div>

                <div class="form-group mb-4">
                    <input type="time" class="form-control" value="<?= $editData['timing3'] ?? '' ?>" name="timing3">
                </div>

                <div class="form-group mb-4">
                    <input type="time" class="form-control" value="<?= $editData['timing4'] ?? '' ?>" name="timing4">
                </div>

                <div class="form-group mb-4">
                    Days:
                    <select name="days" class="form-control" required>
                        <option value="">Select Day</option>
                        <?php
                        $daysOfWeek = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                        foreach($daysOfWeek as $day){
                            $selected = ($editData && $editData['days'] == $day) ? "selected" : "";
                            echo "<option value='$day' $selected>$day</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <input type="date" class="form-control" value="<?= $editData['date'] ?? '' ?>" name="date" min="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="form-group mb-4">
                    Price:
                    <input type="number" class="form-control" value="<?= $editData['price'] ?? '' ?>" name="price" placeholder="Enter the price" min="0" required>
                </div>

                <div class="form-group mb-4">
                    Location:
                    <input type="text" class="form-control" value="<?= $editData['location'] ?? '' ?>" name="location" placeholder="Enter the location" required>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="<?= $editData ? 'Update Theater' : 'Add Theater' ?>" name="<?= $editData ? 'update' : 'add' ?>">
                </div>

                <?php if($editData): ?>
                    <input type="hidden" name="theaterid" value="<?= $editData['theaterid'] ?>">
                <?php endif; ?>
            </form>
        </div>

        <div class="col-lg-6">
            <table class="table">
                <tr>
                    <th>#</th>    
                    <th>Name</th>    
                    <!-- <th>Description</th>     -->
                    <th>Category</th>    
                    <th>Theater Name</th>    
                    <th>Date</th>    
                    <th>Time1</th>    
                    <th>Time2</th>    
                    <th>Time3</th>    
                    <th>Time4</th>    
                    <th>Days</th>    
                    <th>Ticket Price</th>    
                    <th>Location</th>    
                    <!-- <th>Rating</th>     -->
                    <th>Action</th>    
                </tr>

                <?php
                $sql = "SELECT theater.*, movies.title, category.catname
                        FROM theater
                        INNER JOIN movies on movies.movieid = theater.movieid
                        INNER JOIN category on category.catid = movies.catid
                        order by theaterid DESC";
                $res = mysqli_query($con, $sql);
                if(mysqli_num_rows($res) > 0){
                    while($data = mysqli_fetch_array($res)){
                ?>
                <tr>
                    <td><?= $data['theaterid'] ?></td>
                    <td><?= $data['title'] ?></td>
                    <td><?= $data['catname'] ?></td>
                    <td><?= $data['theater_name'] ?></td>
                    <td><?= $data['date'] ?></td>
                    <td><?= $data['timing'] ?>
                    <td><?= $data['timing2'] ?></td>
                    <td><?= $data['timing3'] ?></td>
                    <td><?= $data['timing4'] ?></td>
                    <td><?= $data['days'] ?></td>
                    <td><?= $data['price'] ?></td>
                    <td><?= $data['location'] ?></td>
    

            <td>
            <a href="theater.php?editid=<?= $data['theaterid'] ?>" class="btn btn-secondary"> Edit </a>
            <a href="theater.php?delid=<?= $data['theaterid'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this theater?')"> Delete </a>
        </td>

                </tr>      
                <?php
                    }
                } else {
                    echo "<tr><td colspan='3'>No Theater Found</td></tr>";
                }
                ?>
            </table>
            <br><br><br><br>
        </div>

    </div>
</div>

<?php include("footer.php") ?>
</body>
</html>

<?php
// ADD or UPDATE THEATER
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $movieid = mysqli_real_escape_string($con, $_POST['movieid']);
    $theater_name = mysqli_real_escape_string($con, trim($_POST['theater_name']));
    $days = mysqli_real_escape_string($con, $_POST['days']);
    $timing = mysqli_real_escape_string($con, $_POST['timing']);
    $timing2 = mysqli_real_escape_string($con, $_POST['timing2']);
    $timing3 = mysqli_real_escape_string($con, $_POST['timing3']);
    $timing4 = mysqli_real_escape_string($con, $_POST['timing4']);
    $price = floatval($_POST['price']);
    $date = $_POST['date'];
    $location = mysqli_real_escape_string($con, trim($_POST['location']));

    // Server-side validation
    if (!preg_match('/^[A-Za-z\s]+$/', $theater_name)) {
        echo "<script>alert('Theater name should only contain alphabets and spaces.');</script>";
        exit;
    }
    if (!preg_match('/^[A-Za-z\s]+$/', $location)) {
        echo "<script>alert('Location should only contain alphabets and spaces.');</script>";
        exit;
    }
    if ($price < 0) {
        echo "<script>alert('Price should not be negative.');</script>";
        exit;
    }
    if (strtotime($date) < strtotime(date('Y-m-d'))) {
        echo "<script>alert('Date should not be in the past.');</script>";
        exit;
    }

    if (isset($_POST['add'])) {
        $sql = "INSERT INTO `theater`(`theater_name`, `timing`, `timing2`, `timing3`, `timing4`, `days`, `date`, `price`, `location`, `movieid`)
                VALUES ('$theater_name','$timing','$timing2','$timing3','$timing4','$days','$date','$price','$location','$movieid')";
        if(mysqli_query($con, $sql)){
            echo "<script>alert('Theater Added');window.location.href='theater.php';</script>";
        } else {
            echo "<script>alert('Theater Not Added');</script>";
        }
    }

    if (isset($_POST['update'])) {
        $theaterid = intval($_POST['theaterid']);
        $sql = "UPDATE `theater` SET 
                `theater_name`='$theater_name', 
                `timing`='$timing',
                `timing2`='$timing2',
                `timing3`='$timing3',
                `timing4`='$timing4',
                `days`='$days',
                `date`='$date',
                `price`='$price',
                `location`='$location',
                `movieid`='$movieid'
                WHERE theaterid='$theaterid'";

        if(mysqli_query($con, $sql)){
            echo "<script>alert('Theater Updated');window.location.href='theater.php';</script>";
        } else {
            echo "<script>alert('Theater Not Updated');</script>";
        }
    }
}

// DELETE THEATER
if(isset($_GET['delid'])){
    $delid = intval($_GET['delid']);
    $check_sql = "SELECT * FROM `theater` WHERE theaterid='$delid'";
    $check_res = mysqli_query($con, $check_sql);

    if(mysqli_num_rows($check_res) > 0){
        $sql = "DELETE FROM `theater` WHERE theaterid='$delid'";
        if(mysqli_query($con, $sql)){
            echo "<script>alert('Theater Deleted');window.location.href='theater.php';</script>";
        } else {
            echo "<script>alert('Theater Not Deleted');</script>";
        }
    } else {
        echo "<script>alert('Invalid Theater ID');</script>";
    }
}
?>

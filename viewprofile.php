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
    <title>User Profile</title>
    <link rel="stylesheet" href="css/display_users.css">
</head>
<body>
<?php include("header.php")?>

<div class="container">
    <div class="profile-container">
        <?php
        $uid=$_SESSION['uid'];
        $sql = "SELECT * from `users` where userid = '$uid'";
        $res = mysqli_query($con, $sql);
        if(mysqli_num_rows($res) > 0){
            while($data = mysqli_fetch_array($res)){
                ?>
        <div class="profile-card">
            <!-- <h2><?= $data['name'] ?>'s Profile</h2> -->
            <div class="profile-header">
                <div class="info-item">
                    <?php if($data['profile_pic']) { ?>
                        <img src="uploads/<?= $data['profile_pic'] ?>" alt="Profile Picture" width="100" height="100">
                        <?php } else { ?>
                            <p>No Profile Picture</p>
                            <?php } ?>
                        </div>
                        <strong><?= $data['name'] ?>'s Profile</strong> 
            </div>
            <div class="profile-info">
                <div class="info-item">
                    <strong>Email:</strong> <?= $data['email'] ?>
                </div>
                <div class="info-item">
                    <strong>Phone Number:</strong> <?= $data['phone_number'] ?>
                </div>
                <div class="info-item">
                    <strong>Date of Birth:</strong> <?= $data['date_of_birth'] ?>
                </div>
                <div class="info-item">
                    <strong>Gender:</strong> <?= $data['gender'] ?>
                </div>
                <div class="info-item">
                    <strong>City:</strong> <?= $data['city'] ?>
                </div>
                <div class="info-item">
                    <strong>Country:</strong> <?= $data['country'] ?>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<p>No User Found</p>";
        }
        ?>
    </div>
</div>

<?php include("footer.php") ?>
</body>
</html>

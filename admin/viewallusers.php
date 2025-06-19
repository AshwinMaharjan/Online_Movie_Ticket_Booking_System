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
    <title>Users</title>
    <link rel="stylesheet" href="../css/view_all_users.css">
</head>
<body>
<?php include("header.php")?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <table class="table_display">
                <tr>
                    <th>#</th>    
                    <th>Name</th>    
                    <th>Email</th>    
                    <th>Password</th>    
                    <th>Role Type</th>    
                    <th>Phone Number</th>    
                    <th>Date of Birth</th>    
                    <th>Gender</th>    
                    <th>City</th>    
                    <th>Country</th>    
                    <th>Action</th>    
                </tr>

                <?php
                $sql = "SELECT * FROM `users`";
                $res = mysqli_query($con, $sql);
                if(mysqli_num_rows($res) > 0){
                    while($data = mysqli_fetch_array($res)){
                ?>
                <tr>
                    <td><?= $data['userid'] ?></td>
                    <td><?= $data['name'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td>****</td> <!-- Hide password for security -->
                    <td>
                        <?php
                            if($data['roteype'] == 1){
                                echo "ADMIN";
                            } else{
                                echo "USER";
                            }
                        ?>
                    </td>
                    <td><?= $data['phone_number'] ?></td>
                    <td><?= $data['date_of_birth'] ?></td>
                    <td><?= $data['gender'] ?></td>
                    <td><?= $data['city'] ?></td>
                    <td><?= $data['country'] ?></td>
                    <td>
                        <a href='viewallusers.php?userid=<?= $data['userid'] ?>' class='btn btn-danger'>Delete</a>
                    </td>
                </tr>      
                <?php
                    }
                } else {
                    echo "<tr><td colspan='11'>No Users Found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php include("footer.php") ?>
</body>
</html>

<?php
// DELETE USER
if(isset($_GET['userid'])){
    $userid = $_GET['userid'];

    // Ensure to sanitize the user ID and prevent SQL Injection
    $userid = mysqli_real_escape_string($con, $userid);

    $sql = "DELETE FROM `users` WHERE userid='$userid'";
    if(mysqli_query($con, $sql)){
        echo "<script>alert('User Deleted');</script>";
        echo "<script>window.location.href='viewallusers.php';</script>";
    } else {
        echo "<script>alert('User Not Deleted');</script>";
    }    
}
?>

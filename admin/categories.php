<?php 
include("connect.php");

if(!isset($_SESSION['uid'])){
    echo "<script>window.location.href='../login.php'</script>";
}

$editData = null;
if(isset($_GET['editid'])){
    $editid = $_GET['editid'];
    
    $sql = "SELECT * FROM `category` WHERE catid='$editid'";
    $res = mysqli_query($con, $sql);

    if(mysqli_num_rows($res) > 0){
        $editData = mysqli_fetch_array($res);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="../css/categories.css">
</head>
<body>
<?php include ("header.php")?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <form action="categories.php" method="post">
                <div class="form-group mb-4">
                    <input type="hidden" class="form-control" 
                        value="<?= $editData ? $editData['catid'] : '' ?>" name="catid">
                </div>
                <div class="form-group mb-4">
                    <input type="text" class="form-control" 
                        value="<?= $editData ? $editData['catname'] : '' ?>" name="catname" 
                        placeholder="Enter the category" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="Add" name="add">
                    <input type="submit" class="btn btn-info" value="Update" name="update">
                </div>
            </form>
        </div>

        <div class="col-lg-6">
            <table class="table">
                <tr>
                    <th>#</th>    
                    <th>Name</th>    
                    <th>Action</th>    
                </tr>

                <?php
                $sql = "SELECT * FROM `category`";
                $res = mysqli_query($con, $sql);
                if(mysqli_num_rows($res) > 0){
                    while($data = mysqli_fetch_array($res)){
                ?>
                <tr>
                    <td><?= $data['catid'] ?></td>
                    <td><?= $data['catname'] ?></td>
                    <td>
                        <a href="categories.php?editid=<?= $data['catid'] ?>" class="btn btn-secondary"> Edit </a>
                        <a href="categories.php?delid=<?= $data['catid'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"> Delete </a>
                    </td>
                </tr>      
                <?php
                    }
                } else {
                    echo "<tr><td colspan='3'>No Category Found</td></tr>";
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
// ADD CATEGORY
if(isset($_POST['add'])){
    $name = trim($_POST['catname']);

    // Check for duplicate category
    $checkSql = "SELECT * FROM `category` WHERE LOWER(catname) = LOWER('$name')";
    $checkRes = mysqli_query($con, $checkSql);

    if(mysqli_num_rows($checkRes) > 0){
        echo "<script>alert('Category already exists. Duplicate entries not allowed.');</script>";
    } else {
        $sql = "INSERT INTO `category`(`catname`) VALUES ('$name')";
        if(mysqli_query($con, $sql)){
            echo "<script>alert('Category Added');</script>";
            echo "<script>window.location.href='categories.php';</script>";
        } else {
            echo "<script>alert('Category Not Added');</script>";
        }
    }
}

// UPDATE CATEGORY
if(isset($_POST['update'])){
    $catid = $_POST['catid'];  
    $name = trim($_POST['catname']);

    // Check for duplicate name in other records
    $checkSql = "SELECT * FROM `category` WHERE LOWER(catname) = LOWER('$name') AND catid != '$catid'";
    $checkRes = mysqli_query($con, $checkSql);

    if(mysqli_num_rows($checkRes) > 0){
        echo "<script>alert('Another category with this name already exists.');</script>";
    } else {
        $sql = "UPDATE `category` SET `catname`='$name' WHERE catid='$catid'";
        if(mysqli_query($con, $sql)){
            echo "<script>alert('Category Updated');</script>";
            echo "<script>window.location.href='categories.php';</script>";
        } else {
            echo "<script>alert('Category Not Updated');</script>";
        }
    }
}

// DELETE CATEGORY
if(isset($_GET['delid'])){
    $delid = $_GET['delid'];

    $sql = "DELETE FROM `category` WHERE catid='$delid'";
    if(mysqli_query($con, $sql)){
        echo "<script>alert('Category Deleted');</script>";
        echo "<script>window.location.href='categories.php';</script>";
    } else {
        echo "<script>alert('Category Not Deleted');</script>";
    }
}
?>

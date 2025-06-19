<?php 
include("connect.php");

if (!isset($_SESSION['uid'])) {
    echo "<script>window.location.href='../login.php'</script>";
}

$editData = null;
if (isset($_GET['editid'])) {
    $editid = $_GET['editid'];
    $sql = "SELECT * FROM `movies` WHERE movieid='$editid'";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) > 0) {
        $editData = mysqli_fetch_array($res);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movies</title>
    <link rel="stylesheet" href="../css/movies.css">
</head>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const description = form.querySelector("input[name='description']");
    const releaseDate = document.getElementById("release_date");
    const rating = form.querySelector("input[name='rating']");
    const title = form.querySelector("input[name='title']");
    const category = form.querySelector("select[name='catid']");
    const image = form.querySelector("input[name='image']");
    const trailer = form.querySelector("input[name='trailer']");
    const movie = form.querySelector("input[name='movie']");

    const showError = (element, message) => {
        let error = element.nextElementSibling;
        if (!error || !error.classList.contains("error")) {
            error = document.createElement("div");
            error.className = "error";
            error.style.color = "red";
            error.style.fontSize = "0.9em";
            element.insertAdjacentElement("afterend", error);
        }
        error.textContent = message;
    };

    const clearError = (element) => {
        const error = element.nextElementSibling;
        if (error && error.classList.contains("error")) {
            error.remove();
        }
    };

    description.addEventListener("input", () => {
    const val = description.value.trim();
    // Check: must contain at least one alphabet
    if (!/[A-Za-z]/.test(val)) {
        showError(description, "Description must contain at least one alphabet.");
    } else {
        clearError(description);
    }
});


    const today = new Date().toISOString().split('T')[0];
    releaseDate.setAttribute('min', today);

    rating.addEventListener("input", () => {
        const val = parseFloat(rating.value);
        if (val < 1 || val > 10) {
            showError(rating, "Rating must be between 1 and 10.");
        } else {
            clearError(rating);
        }
    });

    form.addEventListener("submit", (e) => {
        let valid = true;

        const fields = [title, description, releaseDate, rating, category];
        fields.forEach(field => {
            if (field.value.trim() === "") {
                showError(field, "This field is required.");
                valid = false;
            } else {
                clearError(field);
            }
        });

        if (!/^[A-Za-z\s]+$/.test(description.value.trim())) {
            showError(description, "Only alphabets and spaces allowed.");
            valid = false;
        }

        const release = new Date(releaseDate.value);
        const now = new Date();
        now.setHours(0, 0, 0, 0);
        if (release <= now) {
            showError(releaseDate, "Date must be in the future.");
            valid = false;
        }

        const ratingVal = parseFloat(rating.value);
        if (ratingVal < 1 || ratingVal > 10) {
            showError(rating, "Rating must be between 1 and 10.");
            valid = false;
        }

        const imageFile = image.files[0];
        const trailerFile = trailer.files[0];
        const movieFile = movie.files[0];

        if (!form.querySelector("input[name='movieid']").value) {
            if (!imageFile || !trailerFile || !movieFile) {
                if (!imageFile) showError(image, "Poster file required.");
                if (!trailerFile) showError(trailer, "Trailer file required.");
                if (!movieFile) showError(movie, "Movie file required.");
                valid = false;
            } else {
                if (!imageFile.type.startsWith("image/")) {
                    showError(image, "Only image files are allowed for poster.");
                    valid = false;
                } else {
                    clearError(image);
                }
                if (!trailerFile.type.startsWith("video/")) {
                    showError(trailer, "Only video files are allowed for trailer.");
                    valid = false;
                } else {
                    clearError(trailer);
                }
                if (!movieFile.type.startsWith("video/")) {
                    showError(movie, "Only video files are allowed for movie.");
                    valid = false;
                } else {
                    clearError(movie);
                }
            }
        }

        if (!valid) e.preventDefault();
    });
});
</script>

<body>
<?php include("header.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <form action="movies.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="movieid" value="<?= isset($editData['movieid']) ? $editData['movieid'] : '' ?>">

                <!-- Category -->
                <div class="form-group mb-4">
                    <select name="catid" class="form-control" required>
                        <option value="" disabled <?= !isset($editData['catid']) ? 'selected' : '' ?>>Select Category</option>
                        <?php
                        $sql = "SELECT * FROM `category`";
                        $res = mysqli_query($con, $sql);
                        while ($data = mysqli_fetch_array($res)) {
                        ?>
                            <option value="<?= $data['catid'] ?>" <?= ($editData && $editData['catid'] == $data['catid']) ? "selected" : "" ?>>
                                <?= $data['catname'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Title -->
                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="title" value="<?= $editData['title'] ?? '' ?>" placeholder="Enter the title" required>
                </div>

                <!-- Description -->
                <div class="form-group mb-4">
                <textarea class="form-control" name="description" rows="15" cols="100" placeholder="Enter the description" required><?= $editData['description'] ?? '' ?></textarea>
                </div>

                <!-- Release Date -->
                <div class="form-group mb-4">
                    <?php $today = date('Y-m-d'); ?>
                    <input type="date" class="form-control" name="release_date" id="release_date" value="<?= $editData['release_date'] ?? '' ?>" min="<?= $today ?>" required>
                </div>

                <!-- Poster -->
                <div class="form-group mb-4">
                    Poster:
                    <input type="file" class="form-control" name="image" <?= $editData ? '' : 'required' ?>>
                    <?php if (isset($editData['image'])): ?>
                        <img src="uploads/<?= $editData['image'] ?>" width="100">
                    <?php endif; ?>
                </div>

                <!-- Trailer -->
                <div class="form-group mb-4">
                    Trailer:
                    <input type="file" class="form-control" name="trailer" <?= $editData ? '' : 'required' ?>>
                </div>

                <!-- Movie -->
                <div class="form-group mb-4">
                    Video:
                    <input type="file" class="form-control" name="movie" <?= $editData ? '' : 'required' ?>>
                </div>

                <!-- Rating -->
                <div class="form-group mb-4">
                    Rating:
                    <input type="number" class="form-control" name="rating" value="<?= $editData['rating'] ?? '' ?>" required>
                </div>

                <!-- Submit -->
                <div class="form-group">
                    <input type="submit" class="btn btn-secondary" value="<?= $editData ? 'Update' : 'Add' ?>" name="<?= $editData ? 'update' : 'add' ?>">
                </div>
            </form>
        </div>

        <!-- Movie Table -->
        <div class="col-lg-6">
            <table class="table">
                <tr>
                    <th>#</th>    
                    <th>Name</th>    
                    <th>Category</th>    
                    <th>Release Date</th>    
                    <th>Poster</th>    
                    <th>Action</th>    
                </tr>
                <?php
                $sql = "SELECT movies.*, category.catname FROM movies INNER JOIN category ON category.catid = movies.catid";
                $res = mysqli_query($con, $sql);
                while ($data = mysqli_fetch_array($res)) {
                ?>
                <tr>
                    <td><?= $data['movieid'] ?></td>
                    <td><?= $data['title'] ?></td>
                    <td><?= $data['catname'] ?></td>
                    <td><?= $data['release_date'] ?></td>
                    <td><img src="uploads/<?= $data['image'] ?>" height="150" width="150"></td>
                    <td>
                        <a href="movies.php?editid=<?= $data['movieid'] ?>" class="btn btn-secondary"> Edit </a>
                        <a href="movies.php?delid=<?= $data['movieid'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this movie?')"> Delete </a>
                    </td>
                </tr>      
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>

<?php
// Add movie
if (isset($_POST['add'])) {
    $catid = $_POST['catid'];
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $rating = $_POST['rating'];
    $release_date = $_POST['release_date'];

    // Validate description
    if (!preg_match("/[A-Za-z]/", $description)) {
        echo "<script>alert('Description must contain at least one alphabet character.'); window.history.back();</script>";
        exit;
    }

    // Validate rating
    if (!is_numeric($rating) || $rating < 1 || $rating > 10) {
        echo "<script>alert('Rating must be a number between 1 and 10.'); window.history.back();</script>";
        exit;
    }

    // File validation
    $image = $_FILES['image']['name'];
    $trailer = $_FILES['trailer']['name'];
    $movie = $_FILES['movie']['name'];

    $imageTmp = $_FILES['image']['tmp_name'];
    $trailerTmp = $_FILES['trailer']['tmp_name'];
    $movieTmp = $_FILES['movie']['tmp_name'];

    $imageType = mime_content_type($imageTmp);
    $trailerType = mime_content_type($trailerTmp);
    $movieType = mime_content_type($movieTmp);

    if (strpos($imageType, 'image/') !== 0) {
        echo "<script>alert('Poster must be an image file.'); window.history.back();</script>";
        exit;
    }

    if (strpos($trailerType, 'video/') !== 0) {
        echo "<script>alert('Trailer must be a video file.'); window.history.back();</script>";
        exit;
    }

    if (strpos($movieType, 'video/') !== 0) {
        echo "<script>alert('Movie must be a video file.'); window.history.back();</script>";
        exit;
    }

    move_uploaded_file($imageTmp, "uploads/$image");
    move_uploaded_file($trailerTmp, "uploads/$trailer");
    move_uploaded_file($movieTmp, "uploads/$movie");

    $sql = "INSERT INTO `movies` (`title`, `description`, `release_date`, `image`, `trailer`, `movie`, `rating`, `catid`) 
            VALUES ('$title','$description','$release_date','$image','$trailer','$movie','$rating','$catid')";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Movie Added'); window.location.href='movies.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}

// Delete movie
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $sql = "DELETE FROM `movies` WHERE movieid='$delid'";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Movie Deleted'); window.location.href='movies.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}
?>

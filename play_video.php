<?php
$file = 'admin/uploads/' . $_GET['file'];

if (file_exists($file)) {
    header('Content-Type: video/mp4');
    header('Content-Disposition: inline; filename="' . basename($file) . '"');
    readfile($file);
    exit;
} else {
    echo "Video not found!";
}
?>
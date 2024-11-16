<?php
include 'db_connection.php'; // Include your database connection file

// Check if user is admin
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#content'
        });
    </script>
</head>
<body>
    <form action="submit_blog.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="tags" placeholder="Tags (comma separated)" required>
        <input type="file" name="cover_image" required>
        <textarea id="content" name="content"></textarea>
        <button type="submit">Create Blog</button>
    </form>
</body>
</html>

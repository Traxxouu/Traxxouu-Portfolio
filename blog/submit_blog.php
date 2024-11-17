
<?php
include 'db_connection.php'; // Include your database connection file

session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

$title = $_POST['title'];
$tags = json_encode(explode(',', $_POST['tags']));
$description = $_POST['description'];
$content = $_POST['content'];
$created_by = $_SESSION['user_id'];

$cover_image = $_FILES['cover_image']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($cover_image);
move_uploaded_file($_FILES['cover_image']['tmp_name'], $target_file);

$query = "INSERT INTO blogs (title, cover_image, tags, description, content, created_by) VALUES ('$title', '$target_file', '$tags', '$description', '$content', '$created_by')";
if (mysqli_query($conn, $query)) {
    header('Location: index.php');
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
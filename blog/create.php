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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Blog - Maël</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tiny.cloud/1/your-api/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content'
        });
    </script>
</head>
<body>
    <div class="container my-5">
        <h2>Créer un Blog</h2>
        <form action="submit_blog.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tags">Tags (séparés par des virgules)</label>
                <input type="text" id="tags" name="tags" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cover_image">Image de couverture</label>
                <input type="file" id="cover_image" name="cover_image" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="content">Contenu</label>
                <textarea id="content" name="content" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Créer le Blog</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

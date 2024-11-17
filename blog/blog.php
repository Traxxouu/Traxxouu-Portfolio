<?php
include 'db_connection.php'; // Include your database connection file

$blog_id = $_GET['id'];
$query = "SELECT * FROM blogs WHERE id = $blog_id";
$result = mysqli_query($conn, $query);
$blog = mysqli_fetch_assoc($result);

$comments_query = "SELECT * FROM comments WHERE blog_id = $blog_id";
$comments_result = mysqli_query($conn, $comments_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ...existing code... -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- ...existing code... -->
    <div class="container my-5">
        <div class="blog-detail card p-4">
            <h1 class="blog-title"><?php echo $blog['title']; ?></h1>
            <img src="<?php echo $blog['cover_image']; ?>" alt="Cover Image" class="img-fluid my-3">
            <div class="tags mb-3">
                <?php foreach (json_decode($blog['tags']) as $tag): ?>
                    <span class="badge bg-info text-dark"><?php echo $tag; ?></span>
                <?php endforeach; ?>
            </div>
            <p class="blog-description"><?php echo $blog['description']; ?></p>
            <hr class="my-4">
            <div class="blog-content"><?php echo $blog['content']; ?></div>
        </div>
        <hr class="my-4">
        <div class="comments-section card p-4 mt-4">
            <h2>Comments</h2>
            <?php while($comment = mysqli_fetch_assoc($comments_result)): ?>
                <div class="comment mb-3 p-3 border rounded">
                    <p><?php echo $comment['comment_text']; ?></p>
                    <!-- Add user role badge here -->
                </div>
            <?php endwhile; ?>
            <form action="add_comment.php" method="POST" class="mt-3">
                <div class="form-group">
                    <textarea name="comment_text" class="form-control modern-textarea" rows="3" placeholder="Add your comment..." required></textarea>
                </div>
                <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
                <button type="submit" class="btn btn-primary mt-2 modern-button">Add Comment</button>
            </form>
        </div>
    </div>
    <!-- ...existing code... -->
</body>
</html>

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
</head>
<body>
    <!-- ...existing code... -->
    <div class="blog-detail">
        <h1><?php echo $blog['title']; ?></h1>
        <img src="<?php echo $blog['cover_image']; ?>" alt="Cover Image">
        <p><?php echo json_encode($blog['tags']); ?></p>
        <p><?php echo $blog['description']; ?></p>
        <div><?php echo $blog['content']; ?></div>
    </div>
    <div class="comments-section">
        <h2>Comments</h2>
        <?php while($comment = mysqli_fetch_assoc($comments_result)): ?>
            <div class="comment">
                <p><?php echo $comment['comment_text']; ?></p>
                <!-- Add user role badge here -->
            </div>
        <?php endwhile; ?>
        <form action="add_comment.php" method="POST">
            <textarea name="comment_text" required></textarea>
            <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
            <button type="submit">Add Comment</button>
        </form>
    </div>
    <!-- ...existing code... -->
</body>
</html>

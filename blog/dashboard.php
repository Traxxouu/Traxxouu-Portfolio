<?php
include 'db_connection.php'; // Include your database connection file

session_start();
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$profile_image = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : 'default_profile.png'; // Default profile image if not set

$liked_blogs_query = "SELECT blogs.* FROM blogs 
                      JOIN likes ON blogs.id = likes.blog_id 
                      WHERE likes.user_id = $user_id";
$liked_blogs_result = mysqli_query($conn, $liked_blogs_query);

$comments_query = "SELECT * FROM comments WHERE user_id = $user_id";
$comments_result = mysqli_query($conn, $comments_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Maël</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container my-5">
        <div class="dashboard-container text-center">
            <img src="<?php echo $profile_image; ?>" alt="Profile Image" class="rounded-circle mb-3" width="100" height="100">
            <h1>Bienvenue, <?php echo $username; ?> 
                <span class="badge bg-<?php echo $role === 'admin' ? 'danger' : ($role === 'collaborator' ? 'warning' : 'secondary'); ?>">
                    <?php echo ucfirst($role); ?>
                </span>
            </h1>
            <div class="d-flex justify-content-end mb-4">
                <a href="index.php" class="btn btn-primary me-2">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <a href="logout.php" class="btn btn-deconnexion">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2>Blogs aimés</h2>
                        </div>
                        <div class="card-body">
                            <?php while($blog = mysqli_fetch_assoc($liked_blogs_result)): ?>
                                <div class="blog-card mb-3">
                                    <h3><?php echo $blog['title']; ?></h3>
                                    <a href="blog.php?id=<?php echo $blog['id']; ?>" class="btn btn-primary">
                                        <i class="fas fa-book-open"></i> Lire le blog
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2>Vos commentaires</h2>
                        </div>
                        <div class="card-body">
                            <?php while($comment = mysqli_fetch_assoc($comments_result)): ?>
                                <div class="comment-card mb-3">
                                    <p><?php echo $comment['comment_text']; ?></p>
                                    <div class="d-flex justify-content-end">
                                        <a href="edit_comment.php?id=<?php echo $comment['id']; ?>" class="btn btn-warning me-2">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>
                                        <a href="delete_comment.php?id=<?php echo $comment['id']; ?>" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i> Supprimer
                                        </a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

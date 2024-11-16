<?php
include 'db_connection.php'; // Include your database connection file
session_start();

$query = "SELECT * FROM blogs";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Maël</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Barre de navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Maël - Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../Accueil/index.html">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../programme/index.html">Projet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Reseaux/index.html">Réseaux</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Section d'introduction -->
    <section id="intro" class="d-flex align-items-center justify-content-center text-center">
        <div>
            <h1 class="animate__animated animate__fadeInDown">Bienvenue sur le Blog de Maël</h1>
            <p class="animate__animated animate__fadeInUp">Découvrez les derniers articles et actualités</p>
        </div>
    </section>

    <!-- Liste des blogs -->
    <div class="container my-5">
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="d-flex justify-content-end">
                <a href="dashboard.php" class="btn btn-primary me-2">
                    <i class="fas fa-user"></i> Mon Compte
                </a>
                <a href="logout.php" class="btn btn-deconnexion">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </div>
            <div class="blog-list row mt-3">
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-4">
                        <div class="blog-card card animate__animated animate__fadeInUp">
                            <h2><?php echo $row['title']; ?></h2>
                            <img src="<?php echo $row['cover_image']; ?>" alt="Cover Image" class="img-fluid">
                            <p><?php echo json_encode($row['tags']); ?></p>
                            <a href="blog.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">
                                <i class="fas fa-book-open"></i> Lire le blog
                            </a>
                            <button class="like-btn btn btn-secondary mt-2" data-id="<?php echo $row['id']; ?>">
                                <i class="fas fa-thumbs-up"></i> Like
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="d-flex justify-content-center">
                <a href="login.php" class="btn btn-primary me-2">
                    <i class="fas fa-sign-in-alt"></i> Connexion
                </a>
                <a href="register.php" class="btn btn-success">
                    <i class="fas fa-user-plus"></i> Inscription
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center py-4">
        <nav class="mb-3">
            <a href="../Accueil/index.html" class="mx-2 text-light">Accueil</a>
            <a href="index.php" class="mx-2 text-light">Blog</a>
            <a href="../programme/index.html" class="mx-2 text-light">Projet</a>
            <a href="../Reseaux/index.html" class="mx-2 text-light">Réseaux</a>
        </nav>
        <p class="text-light">Maël Barbe &copy; Tous droits réservés</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>

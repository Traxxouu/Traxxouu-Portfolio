<?php
include 'db_connection.php'; // Include your database connection file
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $profile_image = $_POST['profile_image'];

    $query = "INSERT INTO users (email, username, password, profile_image) VALUES ('$email', '$username', '$password', '$profile_image')";
    if (mysqli_query($conn, $query)) {
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'user';
        $_SESSION['profile_image'] = $profile_image; // Set profile image in session
        header('Location: index.php');
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Maël</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container my-5">
        <div class="form-container">
            <h2>Inscription</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <i class="fas fa-envelope icon"></i>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <i class="fas fa-user icon"></i>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <i class="fas fa-lock icon"></i>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="profile_image">Choisir une photo de profil</label>
                    <select id="profile_image" name="profile_image" required>
                        <option value="profile1.png">Image 1</option>
                        <option value="profile2.png">Image 2</option>
                        <option value="profile3.png">Image 3</option>
                        <option value="profile4.png">Image 4</option>
                    </select>
                </div>
                <img id="profileImagePreview" class="profile-image-preview" src="profile1.png" alt="Profile Image Preview">
                <button type="submit">
                    <i class="fas fa-user-plus"></i> Inscription
                </button>
                <a href="index.php" class="btn btn-secondary mt-2">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('profile_image').addEventListener('change', function() {
            const selectedImage = this.value;
            document.getElementById('profileImagePreview').src = selectedImage;
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
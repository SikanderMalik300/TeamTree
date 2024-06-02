<?php
// Include database connection and session management
include_once 'includes/db.php';
include_once 'session.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert user into database
        $query = "INSERT INTO users (username, email, phoneno, password) 
                  VALUES ('$username', '$email', '$phoneno', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - TeamTree</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="logo-container">
        <a href="index.php">
            <span class="logo-text">TeamTree</span>
        </a>
    </div>
    <div class="form-container">
        <h2>Join TeamTree</h2>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="signup.php">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            
            <label for="phone">Phone Number</label>
            <input type="text" id="phoneno" name="phoneno" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <button type="submit" class="submit-button">Join Now</button>
        </form>
        <p>Already have an account? <a href="login.php">Log In</a></p>
    </div>
</body>

</html>

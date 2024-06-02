<?php
// Include database connection and session management
include_once 'includes/db.php';
include_once 'session.php';

// Redirect to login if the user is not logged in
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $message = $_POST['message'];
    $userId = getCurrentUserId();

    $query = "INSERT INTO donations (user_id, amount, message) VALUES ('$userId', '$amount', '$message')";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate - TeamTree</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/donate.css"> <!-- Separate CSS file for donate.php -->
    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
        }

        /* Sidebar styles */
        #sidebar {
            position: fixed;
            right: -300px;
            /* Initially hidden */
            top: 0;
            height: 100%;
            width: 300px;
            background-color: #28a745;
            /* Appealing green */
            z-index: 1000;
            transition: right 0.3s ease;
            padding-top: 60px;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
        }

        .logo {
            display: block;
            text-align: center;
            color: #fff;
            font-size: 1.5rem;
            padding: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        #sidebar.active {
            right: 0;
        }

        #sidebar-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 1.5rem;
            background: none;
            border: none;
            color: #fff;
            cursor: pointer;
            z-index: 1100;
        }

        #sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #sidebar nav ul li {
            padding: 15px;
            border-bottom: 1px solid #218838;
        }

        #sidebar nav ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
            transition: color 0.3s ease;
        }

        #sidebar nav ul li a:hover {
            color: #c3e6cb;
        }

        /* Main content styles */
        #main-content {
            margin-right: 0;
            transition: margin-right 0.3s ease;
        }

        #main-content.active {
            margin-right: 300px;
            /* Adjust for sidebar width */
        }

        

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: slideInDown 0.5s ease;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-size: 2.5rem;
            color: #333;
            /* Dark text color */
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-size: 1.2rem;
            text-align: left;
            color: #333;
            /* Dark text color */
        }

        .form-container input,
        .form-container textarea {
            width: calc(100% - 20px);
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1.2rem;
            transition: border-color 0.3s ease;
        }

        .form-container input:focus,
        .form-container textarea:focus {
            outline: none;
            border-color: #28a745;
            /* Green border color on focus */
        }

        .form-container textarea {
            resize: none;
        }

        .submit-button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            /* Green button color */
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #218838;
            /* Darker green on hover */
        }

        .error {
            color: red;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        /* Keyframes for animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive styles */
        @media screen and (max-width: 768px) {
            #sidebar {
                width: 200px;
            }

            #main-content.active {
                margin-right: 200px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar">
        <a href="index.php" class="logo">TeamTree</a>
        <button id="sidebar-toggle" onclick="toggleSidebar()">☰</button>
        <nav>
            <ul>
        <li><a href="index.php">Home</a></li>
        <?php if (isLoggedIn()): ?>
            <li class='active'><a href="donate.php">Donate Now</a></li>
            <li><a href="leaderboard.php">View Leaderboard</a></li>
            <li><a href="logout.php">Log Out</a></li>
        <?php else: ?>
            <li class='active'><a href="donate.php">Donate Now</a></li>
            <li><a href="leaderboard.php">View Leaderboard</a></li>
            <li><a href="login.php">Sign In</a></li>
            <li><a href="signup.php">Join TeamTree</a></li>
        <?php endif; ?>
    </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div id="main-content">
        <!-- Background Image -->
        <div class="background-image">
            <div class="form-container">
                <h2>Donate</h2>
                <?php if (isset($error)): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>
                <form method="POST" action="donate.php">
                    <label for="amount">Donation Amount</label>
                    <input type="number" id="amount" name="amount" required>
                    
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                    
                    <button type="submit" class="submit-button">Donate Now</button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Sidebar Toggle -->
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var sidebarToggle = document.getElementById('sidebar-toggle');
            sidebar.classList.toggle('active');
            sidebarToggle.textContent = sidebar.classList.contains('active') ? '✖' : '☰';
        }
    </script>
</body>

</html>

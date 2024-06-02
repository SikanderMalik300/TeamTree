<?php
// Include database connection
include_once 'includes/db.php';
include_once 'session.php';

// Query to get total donations amount
$query = "SELECT SUM(amount) AS total_amount FROM donations";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_amount = $row['total_amount'] ?? 0;

// Format total amount
$total_amount_formatted = number_format($total_amount, 2);

// Close connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar">
        <a href="index.php" class="logo">TeamTree</a>
        <button id="sidebar-toggle" onclick="toggleSidebar()">☰</button>
        <nav>
            <ul>
    <li class='active'><a href="index.php">Home</a></li>
    <?php if (isLoggedIn()): ?>
        <li><a href="donate.php">Donate Now</a></li>
        <li><a href="leaderboard.php">View Leaderboard</a></li>
        <li><a href="logout.php">Log Out</a></li>
    <?php else: ?>
        <li><a href="login.php">Sign In</a></li>
        <li><a href="signup.php">Join TeamTree</a></li>
        <li><a href="donate.php">Donate Now</a></li>
        <li><a href="leaderboard.php">View Leaderboard</a></li>
    <?php endif; ?>
</ul>

        </nav>
    </div>

    <!-- Main Content -->
    <div id="main-content">
        <!-- Background Image -->
        <div class="background-image">
            <!-- Total Donations Display -->
            <div id="total-donations">
                <div class="total-amount">
                    <h1>Total Donations</h1>
                    <p>$<?php echo $total_amount_formatted; ?></p>
                </div>
                <div class="contribution-message">
                    <p>Your contribution helps us make a difference. Thank you for your support!</p>
                    <?php if (isLoggedIn()): ?>
                        <a href="donate.php" class="donate-button">Donate Now</a>
                    <?php else: ?>
                        <a href="login.php" class="donate-button">Sign In to Donate</a>
                    <?php endif; ?>
                </div>
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

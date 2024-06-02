<?php
// Include database connection
include_once 'includes/db.php';
include_once 'session.php';

// Query to get leaderboard data
$query = "SELECT users.username, donations.amount, donations.message 
          FROM donations 
          INNER JOIN users ON donations.user_id = users.id 
          ORDER BY donations.amount DESC 
          LIMIT 3";
$result = mysqli_query($conn, $query);

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Custom styles for leaderboard */
        .diamond {
            border: 2px solid #39CCCC; /* Cyan */
        }
        .gold {
            border: 2px solid #FFD700; /* Gold */
        }
        .silver {
            border: 2px solid #C0C0C0; /* Silver */
        }
        .card {
            width: 100%; /* Full width on mobile */
            margin: 20px auto;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            
        }
        .card-content {
            text-align: center;
            padding: 15px;
        }
        .rank {
            text-align: center;
            margin-top: 10px;
        }
        .leaderboard-container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }
        h1 {
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 2.5rem;
            color: #fff; /* Dark text color */
        }
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.7);
        }
        .card.diamond {
            width: 90%; /* Adjusted width for smaller screens */
        }
        .card.gold {
            width: 90%; /* Adjusted width for smaller screens */
        }
        .card.silver {
            width: 90%; /* Adjusted width for smaller screens */
        }
        .card.diamond img,
        .card.gold img,
        .card.silver img {
            width: 50px; /* Size of the icon images */
            margin-bottom: 10px;
        }
        .message {
            margin-top: 10px;
            font-style: italic;
            color: white; /* Gray text color */
        }

        .card-content h2{
            margin-bottom:12px;
        }
        
        /* Responsive styles */
        @media screen and (max-width: 768px) {
            .card {
                width: 90%; /* Full width on smaller screens */
            }
        }
        @media screen and (max-width: 480px) {
            .card {
                width: 100%; /* Full width on extra small screens */
                margin: 10px auto;
                padding: 10px;
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
                    <li><a href="donate.php">Donate Now</a></li>
                    <li class='active'><a href="leaderboard.php">View Leaderboard</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                <?php else: ?>
                    <li><a href="login.php">Sign In</a></li>
                    <li><a href="signup.php">Join TeamTree</a></li>
                    <li><a href="donate.php">Donate Now</a></li>
                    <li class='active'><a href="leaderboard.php">View Leaderboard</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div id="main-content">
        <!-- Background Image -->
        <div class="background-image">
            <div class="leaderboard-container">
                <h1>Top Donators</h1>
                <div class="cards-container">
                    <?php
                    $rank = 1; // Initialize rank
                    while ($row = mysqli_fetch_assoc($result)):
                        $username = htmlspecialchars($row['username']);
                        $amount = number_format($row['amount'], 2);
                        $message = htmlspecialchars($row['message']);
                        
                        // Determine card class based on rank
                        $card_class = '';
                        switch ($rank) {
                            case 1:
                                $card_class = 'diamond';
                                $icon = 'diamond.png'; // Replace with actual diamond icon
                                break;
                            case 2:
                                $card_class = 'gold';
                                $icon = 'gold.png'; // Replace with actual gold icon
                                break;
                            case 3:
                                $card_class = 'silver';
                                $icon = 'silver.png'; // Replace with actual silver icon
                                break;
                            default:
                                $card_class = 'normal';
                                break;
                        }
                    ?>
                    <div class="card <?php echo $card_class; ?>">
                        <div class="card-content">
                            <img src="assets/images/<?php echo $icon; ?>" alt="<?php echo $card_class; ?> icon">
                            <h2><?php echo $username; ?></h2>
                            <p>$<?php echo $amount; ?></p>
                            <div class="message">
                                <?php echo $message; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $rank++; // Increment rank
                    endwhile;
                    ?>
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

<?php
// Include the database connection file
include_once '../../includes/db.php';
include_once '../../session.php';

// Display session message if set
if (isset($_SESSION['message'])) {
    echo "<p>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']);
}

// Query to fetch donations with user information
$query = "
    SELECT 
        user_id, amount, message 
    FROM 
        donations;
";
$result = mysqli_query($conn, $query);

// Check if there are any donations
if (mysqli_num_rows($result) > 0) {
    // Output the data in a table
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Donations List</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
        <style>
            /* Global styles */
            body {
                font-family: "Poppins", sans-serif;
                margin: 0;
                padding: 0;
            }

            /* Navbar styles */
            .navbar {
                background-color: #191924;
                font-family: "Poppins", sans-serif;
                overflow: hidden;
                padding: 10px 0;
            }

            .navbar a {
                float: left;
                display: block;
                color: white;
                text-align: center;
                padding: 14px 20px;
                text-decoration: none;
                font-size: 18px;
            }

            /* Sidebar styles */
            .content {
                max-width: 1300px;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin-left: 270px; /* Adjust sidebar width + some extra space */
                margin-right: 20px; /* Adjust as needed */
            }

            .sidebar {
                height: 100%;
                width: 250px;
                position: fixed;
                z-index: 1;
                top: 62px;
                left: 0;
                background-color: #090917;
                padding-top: 20px;
                margin-top: 10px;
                float: left; /* Float the sidebar to the left */
            }

            .sidebar a {
                display: block;
                color: white;
                padding: 16px;
                text-decoration: none;
                font-size: 18px;
            }

            .sidebar a:hover {
                background-color: #ddd;
                color: #333;
            }

            #active {
                background-color: #ddd;
                color: #333;
            }

            /* Content styles */
            h2 {
                color: #333;
                text-align: center;
                font-size: 32px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th,
            td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #090917;
                color: white;
                font-size: 16px;
            }

            tr:hover {
                background-color: #f5f5f5;
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <div class="navbar">
            <a href="#">TeamTree - Admin Panel</a>
            <a href="../../logout.php" style="float: right;">Logout</a>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <a href="all_users_listing.php">View All Users</a>
            <a href="add_user.php">Add New User</a>
            <a href="all_donation_listing.php" id="active">View Donations</a>
        </div>

        <div class="content">
            <h2>All Donations Listing</h2>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Amount</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>';

    // Loop through the data and output it into the table
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
                    <tr>
                        <td>' . $row['user_id'] . '</td>
                        <td>' . $row['amount'] . ' $</td>
                        <td>' . $row['message'] . '</td>
                    </tr>';
    }

    echo '
                </tbody>
            </table>
        </div>
    </body>
    </html>';

    // Free result set
    mysqli_free_result($result);
} else {
    echo "<p>No donations found.</p>";
}

// Close connection
mysqli_close($conn);
?>

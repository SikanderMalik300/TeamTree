<?php
include_once '../includes/db.php';
include_once '../session.php';

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Tree - Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <style>
        /* Global styles */
        body {
            font-family: 'Poppins', sans-serif; /* Use Poppins font */
            margin: 0;
            padding: 0;
        }

        /* Navbar styles */
        .navbar {
            background-color: #191924;
            font-family: 'Poppins', sans-serif;
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

h3 {
    color: #333;
    text-align: center;
    font-size: 32px;
}

form {
    margin-bottom: 20px;
    display: flex;
    flex-wrap: wrap;
}

input[type="text"] {
    flex: 2;
    width: auto;
    padding: 10px 10px; /* Adjusted padding */
    margin-right: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    font-size:16px;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #101725;
    color: white;
    padding: 10px 8px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
    flex: 1;
    height: 40px; /* Set the height */
}

input[type="submit"]:hover {
    background-color: #191924;
}


    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #090917;
        color: white;
        font-size:16px;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    .book-btn {
        display: inline-block;
        padding: 8px 16px;
        background-color: #101725;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }
    .book-btn:hover {
        background-color: #191924;
    }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="#">TeamTree - Admin Panel</a>
        <a href="../logout.php" style="float: right;">Logout</a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="./ManageUsers/all_users_listing.php">View All Users</a>
        <a href="./ManageUsers/add_user.php">Add New User</a>
        <a href="./ManageUsers/view_donation_listing.php">View Donations</a>
    </div>

    <div class="content">
    
 
    </div>
</body>
</html>

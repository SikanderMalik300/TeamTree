<?php
// Include the database connection file
include_once '../../includes/db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Insert the new user into the database
    $query = "INSERT INTO users (email, phoneno, username, password) VALUES ('$email', '$phoneno', '$username', '$password')";

    if (mysqli_query($conn, $query)) {
        echo "New user added successfully.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);

    // Redirect to the all users listing page
    header("Location: all_users_listing.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
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

        form {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
        }

        input[type="text"], input[type="password"] {
            flex: 2;
            width: auto;
            padding: 10px 10px; /* Adjusted padding */
            margin-right: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            font-size: 16px;
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
        <a href="../ManageUsers/all_users_listing.php">View All Users</a>
        <a href="add_user.php" id="active">Add New User</a>
        <a href="../ManageUsers/all_donation_listing.php">View Donations</a>
    </div>

    <div class="content">
        <h2>Add New User</h2>
        <form action="add_user.php" method="POST">
            <input type="text" name="email" placeholder="Email" required>
            <input type="text" name="phoneno" placeholder="Phone Number" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Add User">
        </form>
    </div>
</body>
</html>

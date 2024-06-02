<?php
// Include the database connection file
include_once '../../includes/db.php';
include_once '../../session.php';

// Display session message if set
if (isset($_SESSION['message'])) {
    echo "<p>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']);
}

// Query to fetch all users
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Check if there are any users
if (mysqli_num_rows($result) > 0) {
    // Output the data in a table
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Users List</title>
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

            label {
                margin-bottom: 8px;
                display: block;
            }

            input[type="text"], input[type="password"] {
                flex: 1 1 100%;
                padding: 10px;
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

            .book-btn {
                display: inline-block;
                padding: 8px 16px;
                background-color: #101725;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                cursor: pointer;
                margin-right: 5px;
            }

            .book-btn:hover {
                background-color: #191924;
            }

            /* Modal styles */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }

            .modal-content {
                background-color: #fefefe;
                margin: 10% auto; /* 10% from the top and centered */
                padding: 20px;
                border: 1px solid #888;
                width: 80%; /* Could be more or less, depending on screen size */
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                max-width: 600px;
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
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
            <a href="all_users_listing.php" id="active">View All Users</a>
            <a href="add_user.php">Add New User</a>
            <a href="all_donation_listing.php">View Donations</a>
        </div>

        <div class="content">
            <h2>All User Listing</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';

    // Loop through the data and output it into the table
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
                    <tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['phoneno'] . '</td>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['role'] . '</td>
                        <td>
                            <a href="javascript:void(0);" onclick="openUpdateModal(' . $row['id'] . ', \'' . $row['email'] . '\', \'' . $row['phoneno'] . '\', \'' . $row['username'] . '\', \'' . $row['role'] . '\')" class="book-btn">Update</a>
                            <a href="delete_user.php?id=' . $row['id'] . '" class="book-btn">Delete</a>
                        </td>
                    </tr>';
    }

    echo '
                </tbody>
            </table>
        </div>

        <!-- Update User Modal -->
        <div id="updateUserModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeUpdateModal()">&times;</span>
                <h2>Update User</h2>
                <form id="updateUserForm" action="update_user_process.php" method="post">
                    <input type="hidden" name="id" id="updateUserId" value="">
                    <div>
                        <label for="updateEmail">Email:</label>
                        <input type="text" id="updateEmail" name="email" value="" required>
                    </div>
                    <div>
                        <label for="updatePhoneno">Phone Number:</label>
                        <input type="text" id="updatePhoneno" name="phoneno" value="" required>
                    </div>
                    <div>
                        <label for="updateUsername">Username:</label>
                        <input type="text" id="updateUsername" name="username" value="" required>
                    </div>
                    <div>
                        <label for="updateRole">Role:</label>
                        <input type="text" id="updateRole" name="role" value="" required>
                    </div><br/>
                    <div>
                        <input type="submit" value="Update User">
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Function to open the update modal
            function openUpdateModal(id, email, phoneno, username, role) {
                document.getElementById("updateUserId").value = id;
                document.getElementById("updateEmail").value = email;
                document.getElementById("updatePhoneno").value = phoneno;
                document.getElementById("updateUsername").value = username;
                document.getElementById("updateRole").value = role;
                document.getElementById("updateUserModal").style.display = "block";
            }

            // Function to close the update modal
            function closeUpdateModal() {
                document.getElementById("updateUserModal").style.display = "none";
            }

            // Close modal when clicking outside of it
            window.onclick = function(event) {
                var modal = document.getElementById("updateUserModal");
                if (event.target == modal) {
                    closeUpdateModal();
                }
            };
        </script>
    </body>
    </html>';

// Free result set
mysqli_free_result($result);

} else {
    echo "<p>No users found.</p>";
}

// Close connection
mysqli_close($conn);
?>

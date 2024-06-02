\<?php
// Include the database connection file
include_once '../../includes/db.php';
include_once '../../session.php';

// Check if all required fields are set
if (isset($_POST['id'], $_POST['email'], $_POST['phoneno'], $_POST['username'], $_POST['role'])) {
    // Get input data
    $id = intval($_POST['id']);
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Prepare the UPDATE statement
    $query = "UPDATE users SET email = ?, phoneno = ?, username = ?, role = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssi", $email, $phoneno, $username, $role, $id);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Set a session message for success
            header("Location: all_users_listing.php");
        } else {
            // Set a session message for failure
           header("Location: all_users_listing.php");
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Set a session message for preparation failure
        $_SESSION['message'] = "Error preparing update query: " . mysqli_error($conn);
    }
} else {
    // Set a session message for missing fields
    $_SESSION['message'] = "All fields are required.";
}

// Redirect back to the listing page
header("Location: all_users_listing.php");
exit();
?>

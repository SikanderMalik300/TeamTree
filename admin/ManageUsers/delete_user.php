<?php
// Include the database connection file
include_once '../../includes/db.php';
include_once '../../session.php';

// Check if the id parameter is set in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Get the user ID and ensure it is an integer

    // Prepare the DELETE statement
    $query = "DELETE FROM users WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind the user ID parameter to the statement
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Close the statement
        mysqli_stmt_close($stmt);
    }
}

// Close the database connection
mysqli_close($conn);

// Redirect back to the users listing page
header("Location: all_users_listing.php");
exit;
?>

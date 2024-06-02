<?php
// session.php
session_start();

// Function to check if a user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to get the current user's ID
function getCurrentUserId() {
    return $_SESSION['user_id'] ?? null;
}

// Function to get the current user's role
function getCurrentUserRole() {
    return $_SESSION['role'] ?? null;
}
?>

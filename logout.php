<?php
// logout.php
include_once 'session.php';
session_start();
session_destroy();
header("Location: index.php");
exit();
?>

<?php
session_start(); // Start the session


$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to  login page
header("Location: ../templates/login_view.php");
exit();
?>

<?php
session_start();

// If the user is logged in, redirect to  home page
if (isset($_SESSION['teacher_id'])) {
    header("Location: templates/home.php");
    exit();
} else {
    //  redirect to the login page
    header("Location: templates/register.html");
    exit();
}
?>

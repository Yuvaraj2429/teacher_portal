<?php
session_start();
require_once('../config/db.php');

// Display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

   
    // echo "<pre>";
    // echo "Received POST data: ";
    // print_r($_POST);
    // echo "</pre>";

    // Execute the statement to fetch the user
    $stmt = $conn->prepare("SELECT * FROM teachers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $teacher = $result->fetch_assoc();

    // Check if the user exists and verify the password
    if ($teacher) {
        // Debugging: Print fetched user data
        // echo "<pre>";
        // echo "Fetched user data: ";
        // print_r($teacher);
        // echo "</pre>";

        if (password_verify($password, $teacher['password'])) {
            // Store user id in session
            $_SESSION['teacher_id'] = $teacher['id'];
            echo "Logged in successfully. Session ID: " . session_id(); // Debugging
            header("Location: ../templates/home.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }
    exit();
} else {
    // If accessed, redirect to the login page
    header("Location: ../templates/login_view.php");
    exit();
}
?>

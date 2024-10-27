<?php
session_start();
require_once('../config/db.php');

// Display errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT * FROM teachers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
     
        echo "Username already taken. Please choose another one.";
    } else {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO teachers (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashedPassword);

        if ($stmt->execute()) {
            // Registration successful
            $_SESSION['login_message'] = "Registration successful! You can now log in.";
            header("Location: ../templates/login_view.php");
            exit();
        } else {
            
            echo "Error: " . $stmt->error;
        }
    }
} else {
  
    header("Location: ../templates/register.html");
    exit();
}
?>

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/proxima-nova-condensed" rel="stylesheet">
                
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Login Success</title>
</head>
<body>
    <h1>Login Successful!</h1>
    <p>Welcome, you have logged in successfully.</p>
    <a href="home.php">Go to Home Page</a> 
    
    <?php
    // Display error message 
    if (isset($_SESSION['error_message'])) {
        echo "<p style='color: red;'>" . $_SESSION['error_message'] . "</p>";
        unset($_SESSION['error_message']); 
    }
    ?>
</body>
</html>

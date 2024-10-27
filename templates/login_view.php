<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;700&display=swap" rel="stylesheet">

    <title>Teacher Login</title>
</head>

<body class="login_register">
    <form action="../controllers/login.php" method="POST" class="login">
        <h1 class="register">Login</h1>
        <?php if (!empty($error_message)): ?>
        <p style='color: red;'><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php
   if (isset($_SESSION['login_message'])) {
    echo "<p style='color: green;'>" . $_SESSION['login_message'] . "</p>";
    unset($_SESSION['login_message']); // Clear the message after displaying
}
    // if (isset($_SESSION['error_message'])) {
    //     echo "<p style='color: red;'>" . $_SESSION['error_message'] . "</p>";
    //     unset($_SESSION['error_message']); 
    // }
    
    ?>

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Login</button>
        <p class="register">New User? <a href="register.html">Click here to create account</a></p>

    </form>

</body>

</html>
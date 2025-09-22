<?php

if (array_key_exists('action', $_GET)) {
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";

    $dbname = "snakeIo";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email = $conn->real_escape_string($_POST["email"]);
    $pass = $_POST["password"];
    $sql = "SELECT email, password FROM user WHERE email = '$email' AND password = '$pass'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        // Session start and set user as logged in
        session_start();
        $_SESSION["user_id"] = $email;
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <form action="login.php?action=login" method="POST" class="form-container">
        <h2>Login</h2>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p>We don't have an account? <a href="signup.php">Sign Up here</a></p>
    </form>
</body>
</html>
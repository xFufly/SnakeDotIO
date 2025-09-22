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
    $user = $_POST["name"];
    $first_name = $_POST["first_name"];
    $pass = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $sql = "INSERT INTO user (name, first_name, email, password) VALUES ('$user', '$first_name', '$email', '$pass')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <form action="signup.php?action=signup" method="POST" class="form-container">
        <h2>Sign Up</h2>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign Up</button>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</body>
</html>
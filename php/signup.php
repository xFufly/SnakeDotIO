<?php

if ($_POST["username"] && $_POST["password"] && $_POST["email"]) {
    // Database configuration
    $servername = "localhost";
    $username = "admin";
    $password = "";

    $dbname = "snakeIo";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email = $conn->real_escape_string($_POST["email"]);
    $user = $_POST["username"];
    $pass = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username, password, email) VALUES ('$user', '$pass', '$email')";
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
    <form action="signup.php" method="POST" class="form-container">
        <h2>Sign Up</h2>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign Up</button>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</body>
</html>
<?php

    header('Content-type: image/jpeg');
    // The user does not need to be logged in to view the ranking
    
    // Database configuration
    $servername = "localhost";
    $username = "admin";
    $password = "";

    $dbname = "snakeIo";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Display top 10 users by score
    $sql = "SELECT username, score FROM users ORDER BY score DESC LIMIT 10";

    $result = $conn->query($sql);

    // Put results in array
    $data = [];
    $maxScore = 0;
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
        if ($row['score'] > $maxScore) {
            $maxScore = $row['score'];
        }
    }

    $conn->close();

    // Create image
    $width = 400;
    $height = 30 + count($data) * 30;
    $im = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($im,255,255,255);
?>
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
    $sql = "SELECT name, nbr_point FROM user ORDER BY nbr_point DESC LIMIT 10";

    $result = $conn->query($sql);

    // Put results in array
    $data = [];
    $maxScore = 0;
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
        if ($row['nbr_point'] > $maxScore) {
            $maxScore = $row['nbr_point'];
        }
    }

    $conn->close();

    // Create image
    $width = 400;
    $height = 30 + count($data) * 30;
    $im = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($im,255,255,255);
    $black  = imagecolorallocate($im, 0, 0, 0);
    $blue   = imagecolorallocate($im, 30, 144, 255);
    $grey   = imagecolorallocate($im, 200, 200, 200);
    imagefilledrectangle($im, 0, 0, $width, $height, $white);
    imagestring($im, 5, 10, 10, "Top 10 users", $black);

    //Displaying scores
    $y = 40;
    $barMaxWidth = $width - 200; // largeur max pour la barre

    foreach ($data as $index => $row) {
        $name  = $row['name'];
        $score = $row['nbr_point'];

        // Upright position
        $yPos = $y + ($index * 30);

        // Display name and score
        imagestring($im, 4, 10, $yPos, ($index+1) . ". " . $name, $black);
        imagestring($im, 4, $width - 70, $yPos, $score, $black);

        // Display bar
        $barLength = ($maxScore > 0) ? intval(($score / $maxScore) * $barMaxWidth) : 0;
        imagefilledrectangle($im, 150, $yPos, 150 + $barLength, $yPos + 20, $blue);
        imagerectangle($im, 150, $yPos, 150 + $barMaxWidth, $yPos + 20, $grey);
    }

    // Output image
    imagejpeg($im, NULL, 100);
    imagedestroy($im);

?>
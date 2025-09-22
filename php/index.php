<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <body>
        <header>
            <h1>Welcome to Snake.io, <?php echo htmlspecialchars($_SESSION["user_id"]); ?>!</h1>
            <nav>
                <ul>
                    <li><a href="ranking.php">Ranking</a></li>
                </ul>
            </nav>
    </body>
</html>
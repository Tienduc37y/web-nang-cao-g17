<?php
session_start();
if($_SESSION['isLogin'] === false){
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="welcome">
        <h1>Welcome <?php echo $_SESSION['username'];?> !</h1>
        <a href="logout.php">Log Out</a>
    </div>
</body>
</html>
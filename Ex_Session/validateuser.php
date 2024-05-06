<?php
session_start();
$db_host = "localhost";
$db_name = "root";
$db_pass = "";
$database = "user";

$conn = new mysqli($db_host, $db_name, $db_pass, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];
$sha1pass = sha1($password);

$sql = "SELECT * 
        FROM users
        WHERE username = '$username' AND password = '$sha1pass'; ";
$data = mysqli_query($conn, $sql);
if (mysqli_num_rows($data) > 0) {
    $_SESSION['isLogin'] = true;
    $_SESSION['username'] = $username;
    header("Location: home.php ");
}
else {
    echo "<div style='font-size:40px'>User account or password incorrect</div>";
    print "<a href='index.html' style='font-size:30px;color:white;background:#000;text-decoration: none;'>" .'Login'."</a>";
}



?>
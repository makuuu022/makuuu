<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'endor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finalproject";

$conn =new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

function displayError($error) {
    echo "<div class='error'>$error</div>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['verification_code'])) {
        $verification_code = $conn->real_escape_string($_POST['verification_code']);

        $stmt = $conn->prepare("SELECT * FROM userlogin WHERE verification_code=? AND verification_expires > NOW()");
        $stmt->bind_param("s", $verification_code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            header('Location: change_password.php');
            exit;
        } else {
            $error = "Invalid verification code or code has expired.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="verify.css">
</head>
<body>

<div class="menu">
    <h1>Verify Email</h1>
    <?php if (isset($error)):?>
        <?php displayError($error);?>
    <?php endif;?>
    <form method="POST" action="">
        <div class="input-container">
            <input type="text" class="button-container" id="verification_code" name="verification_code" placeholder="Enter verification code" required>
        </div>
        <div class="button-container">
            <button type="submit" name="submit" class="btn">Verify</button>
        </div>
    </form>
</div>

<div class="content">
    <div class="image-container">
        <img src="logo.png" alt="Logo">
    </div>
</div>

<script src="user.js"></script>
</body>
</html>
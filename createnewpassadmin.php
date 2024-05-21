<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finalproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function displayMessage($message, $type = 'error') {
    $class = $type == 'success' ? 'success' : 'error';
    echo "<div class='alert alert-$class' role='alert'>$message</div>";
}

// Retrieve the token from the URL
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['password']) && isset($_POST['confirm_password']) && !empty($token)) {
        $password = $conn->real_escape_string($_POST['password']);
        $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

        if (empty($password) || empty($confirm_password)) {
            $error = "All fields are required.";
        } elseif ($password != $confirm_password) {
            $error = "Passwords do not match.";
        } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password)) {
            $error = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("UPDATE admins SET password=?, reset_token=NULL, reset_expires=NULL WHERE reset_token=?");
            $stmt->bind_param("ss", $hashed_password, $token);

            if ($stmt->execute()) {
                $success = "Password changed successfully.";
                unset($_SESSION['reset_token']);
                
                // Add a JavaScript block for redirection
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'homepage.php';
                    }, 1000); // Redirect after 1 second
                </script>";
            } else {
                $error = "An error occurred while updating the password.";
            }
            $stmt->close();
        }
    } else {
        $error = "Invalid password reset token.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="createnewpass.css">
</head>
<body>

<div class="menu">
    <h1>Create New Password</h1>
    <?php if (isset($error)): ?>
        <?php displayMessage($error, 'error'); ?>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <?php displayMessage($success, 'success'); ?>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="input-container">
           <input type="password" id="password" name="password" placeholder="Enter new password" required>
        </div>
        <div class="input-container">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required>
        </div>
        <div class="button-container">
            <button type="submit" name="submit" class="btn">Enter New Password</button>
        </div>
    </form>
</div>

<div class="content">
    <div class="image-container">
        <img src="logo.png" alt="Logo">
    </div>
</div>

<script src="useradmin.js"></script>

</body>
</html>
